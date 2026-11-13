<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use App\Models\CollectiveRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Throwable;

class RegistrationController extends Controller
{
    public const AGE_GROUPS = [
        '3-4',
        '5-6',
        '7-8',
        '9-10',
        '11-12',
        '13-14'
    ];

    public const RACE_CATEGORIES = [
        'Watersafety',
        '15m Kaki Gaya Bebas',
        '30m Kaki Gaya Bebas',
        '15m Gaya Bebas',
        '30m Gaya Bebas',
        '15m Gaya Dada',
        '30m Gaya Dada',
    ];

    public function rules()
    {
        return view('registrations.rules');
    }

    public function create(Request $request)
{
    $collectiveRegistration = null;

    if ($request->filled('collective_id')) {
        $collectiveRegistration = CollectiveRegistration::withCount('registrants')
            ->findOrFail($request->query('collective_id'));
    }

    return view('registrations.create', [
        'ageGroups' => self::AGE_GROUPS,
        'raceCategories' => self::RACE_CATEGORIES,
        'collectiveRegistration' => $collectiveRegistration,
    ]);
}

    public function store(Request $request)
    {
        // 1. Validasi data peserta
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'ku' => ['required', 'in:' . implode(',', self::AGE_GROUPS)],
            'tgl_lahir' => ['required', 'date'],
            'jk' => ['required', 'in:Laki-laki,Perempuan'],
            'email_orangtua' => ['required', 'email', 'max:255'],
            'no_hp_orangtua' => ['required', 'string', 'max:20'],
            'asal_swimschool' => ['required', 'string', 'max:255'],
            'kategori_lomba' => ['required', 'array', 'min:1'],
            'kategori_lomba.*' => [
                'required',
                'in:' . implode(',', self::RACE_CATEGORIES)
            ],

            'foto' => ['nullable', 'image', 'max:2048'],
            'bukti_pembayaran' => ['nullable', 'image', 'max:2048'],

            'konfirmasi_kuota' => ['sometimes', 'accepted'],
            'persetujuan_biaya' => ['sometimes', 'accepted'],
        ]);

        // 2. Menggabungkan kategori lomba
        $validated['kategori_lomba'] = implode(
            ', ',
            $validated['kategori_lomba']
        );

        unset(
            $validated['konfirmasi_kuota'],
            $validated['persetujuan_biaya']
        );

        // 3. Menyimpan foto peserta
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $filename = now()->format('YmdHis')
                . '_' . Str::slug(
                    pathinfo(
                        $file->getClientOriginalName(),
                        PATHINFO_FILENAME
                    )
                )
                . '.' . $file->getClientOriginalExtension();

            File::ensureDirectoryExists(public_path('uploads'));

            $file->move(public_path('uploads'), $filename);

            $validated['foto'] = 'uploads/' . $filename;
        }

        // 4. Menyimpan bukti pembayaran jika diunggah
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');

            $filename = now()->format('YmdHis')
                . '_bukti_' . Str::slug(
                    pathinfo(
                        $file->getClientOriginalName(),
                        PATHINFO_FILENAME
                    )
                )
                . '.' . $file->getClientOriginalExtension();

            File::ensureDirectoryExists(
                public_path('uploads/pembayaran')
            );

            $file->move(
                public_path('uploads/pembayaran'),
                $filename
            );

            $validated['bukti_pembayaran'] =
                'uploads/pembayaran/' . $filename;
        } else {
            // Kolom database tetap dipertahankan.
            $validated['bukti_pembayaran'] = '';
        }

        // 5. Menyimpan data peserta ke database
        Registrant::create($validated);

        // 6. Menampilkan halaman daftar peserta
        return redirect()
    ->route('registrations.success')
    ->with('success', 'Pendaftaran berhasil dikirim!');
    }


    public function storeCollective(Request $request)
    {
        // 1. Validasi identitas pelatih dan dokumen
        $request->validate([
            'nama_pelatih' => ['required', 'string', 'max:255'],
            'nama_swimschool' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:20'],

            'file_excel' => ['required', 'file', 'mimes:xlsx,xls', 'max:10240'],
            'akte_pdf' => ['required', 'file', 'mimes:pdf', 'max:20480'],

            'persetujuan_data' => ['accepted'],
        ]);

        // 2. Membaca file Excel
        try {
            $spreadsheet = IOFactory::load(
                $request->file('file_excel')->getRealPath()
            );

            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, false);

        } catch (Throwable $e) {
            throw ValidationException::withMessages([
                'file_excel' => 'File Excel tidak dapat dibaca. Pastikan formatnya benar.',
            ]);
        }

        if (count($rows) < 2) {
            throw ValidationException::withMessages([
                'file_excel' => 'File Excel belum memiliki data peserta.',
            ]);
        }

        
        // 3. Membaca judul kolom Excel secara fleksibel
        $normalizeHeader = function ($value) {
            return preg_replace(
                '/[^a-z0-9]/',
                '',
                strtolower(trim((string) $value))
            );
        };

        // Berbagai variasi nama kolom yang dapat dikenali
        $headerAliases = [
            'nama_lengkap' => [
                'namalengkap',
                'namalengkapatlet',
                'namapeserta',
                'namaatlet',
                'namaanak',
            ],

            'ku' => [
                'ku',
                'kelompokusia',
                'kelompokumur',
                'kategoriusia',
            ],

            'tgl_lahir' => [
                'tanggallahir',
                'tgllahir',
                'dateofbirth',
                'dob',
            ],

            'jk' => [
                'jeniskelamin',
                'jk',
                'gender',
                'lp',
            ],

            'email_orangtua' => [
                'emailorangtua',
                'emailortu',
                'emailwali',
                'emailorangtuawali',
                'email',
            ],

            'no_hp_orangtua' => [
                'nowhatsapporangtua',
                'nohporangtua',
                'nomorwhatsapporangtua',
                'nomorwaorangtua',
                'nowaorangtua',
                'nowa',
                'whatsapp',
                'nomorwhatsapp',
                'nohp',
                'phone',
            ],

            'asal_swimschool' => [
                'asalswimschool',
                'namaswimschool',
                'swimschool',
                'asalclub',
                'namaclub',
                'club',
                'klub',
            ],

            'kategori_lomba' => [
                'nomorlomba',
                'kategorilomba',
                'nomorperlombaan',
                'cabanglomba',
                'jenislomba',
                'event',
                'race',
            ],
        ];

        // Mencari baris judul kolom pada 10 baris pertama
        $headerRowIndex = null;
        $columnIndexes = [];
        $bestIndexes = [];

        foreach (array_slice($rows, 0, 10, true) as $rowIndex => $candidateRow) {
            $headers = array_map($normalizeHeader, $candidateRow);
            $candidateIndexes = [];

            foreach ($headerAliases as $field => $aliases) {
                foreach ($aliases as $alias) {
                    $index = array_search($alias, $headers, true);

                    if ($index !== false) {
                        $candidateIndexes[$field] = $index;
                        break;
                    }
                }
            }

            if (count($candidateIndexes) > count($bestIndexes)) {
                $bestIndexes = $candidateIndexes;
                $headerRowIndex = $rowIndex;
            }

            // Jika semua kolom ditemukan, hentikan pencarian
            if (count($candidateIndexes) === count($headerAliases)) {
                $columnIndexes = $candidateIndexes;
                $headerRowIndex = $rowIndex;
                break;
            }
        }

        // Gunakan hasil pencarian terbaik
        if (empty($columnIndexes)) {
            $columnIndexes = $bestIndexes;
        }

        // Memeriksa kolom wajib
        $missingHeaders = array_diff(
            array_keys($headerAliases),
            array_keys($columnIndexes)
        );

        if (!empty($missingHeaders)) {
            $fieldLabels = [
                'nama_lengkap' => 'Nama Lengkap',
                'ku' => 'KU',
                'tgl_lahir' => 'Tanggal Lahir',
                'jk' => 'Jenis Kelamin',
                'email_orangtua' => 'Email Orang Tua',
                'no_hp_orangtua' => 'Nomor WhatsApp Orang Tua',
                'asal_swimschool' => 'Asal Swimschool',
                'kategori_lomba' => 'Nomor Lomba',
            ];

            $missingLabels = array_map(
                fn ($field) => $fieldLabels[$field],
                $missingHeaders
            );

            throw ValidationException::withMessages([
                'file_excel' => 'Kolom berikut belum ditemukan: ' .
                    implode(', ', $missingLabels) .
                    '. Silakan lengkapi informasi tersebut pada file Excel.',
            ]);
        }

        // Menyiapkan baris peserta setelah judul kolom
        $dataRows = array_slice($rows, $headerRowIndex + 1);


        // 4. Memeriksa dan menyiapkan data atlet
        $athletes = [];

        foreach ($dataRows as $rowIndex => $row) {
    $excelRow = $headerRowIndex + $rowIndex + 2;

            // Lewati baris yang benar-benar kosong
            $filledCells = array_filter($row, function ($value) {
                return trim((string) $value) !== '';
            });

            if (empty($filledCells)) {
                continue;
            }

            $getValue = function ($field) use ($row, $columnIndexes) {
                return trim((string) ($row[$columnIndexes[$field]] ?? ''));
            };

            $rawDate = $row[$columnIndexes['tgl_lahir']] ?? null;

            try {
                $tanggalLahir = $this->normalizeExcelDate($rawDate);
            } catch (Throwable $e) {
                throw ValidationException::withMessages([
                    'file_excel' => "Tanggal lahir pada baris {$excelRow} tidak valid.",
                ]);
            }

            $ku = preg_replace(
                '/^KU\s*/i',
                '',
                $getValue('ku')
            );

            $categories = preg_split(
                '/[,;\r\n]+/',
                $getValue('kategori_lomba'),
                -1,
                PREG_SPLIT_NO_EMPTY
            );

            $jkRaw = strtoupper($getValue('jk'));

$jk = match ($jkRaw) {
    'L', 'LAKI-LAKI', 'LAKI LAKI' => 'Laki-laki',
    'P', 'PEREMPUAN' => 'Perempuan',
    default => $getValue('jk'),
};

            $student = [
                'nama_lengkap' => $getValue('nama_lengkap'),
                'ku' => $ku,
                'tgl_lahir' => $tanggalLahir,
                'jk' => $jk,
                'email_orangtua' => $getValue('email_orangtua'),
                'no_hp_orangtua' => $getValue('no_hp_orangtua'),
                'asal_swimschool' => $getValue('asal_swimschool'),
                'kategori_lomba' => array_map('trim', $categories),
            ];

            $validator = Validator::make($student, [
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'ku' => ['required', 'in:' . implode(',', self::AGE_GROUPS)],
                'tgl_lahir' => ['required', 'date_format:Y-m-d'],
                'jk' => ['required', 'in:Laki-laki,Perempuan'],
                'email_orangtua' => ['required', 'email', 'max:255'],
                'no_hp_orangtua' => ['required', 'string', 'max:20'],
                'asal_swimschool' => ['required', 'string', 'max:255'],
                'kategori_lomba' => ['required', 'array', 'min:1'],
                'kategori_lomba.*' => [
                    'required',
                    'in:' . implode(',', self::RACE_CATEGORIES)
                ],
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages([
                    'file_excel' => 'Kesalahan pada baris Excel ' .
                        $excelRow . ': ' .
                        implode(' ', $validator->errors()->all()),
                ]);
            }

            $athletes[] = $student;
        }

        // 5. Memastikan minimal 10 atlet
        if (count($athletes) < 10) {
            throw ValidationException::withMessages([
                'file_excel' => 'Pendaftaran kolektif wajib berisi minimal 10 atlet. Data saat ini: ' .
                    count($athletes) . ' atlet.',
            ]);
        }

        // 6. Menyimpan file Excel dan PDF
        $excelPath = null;
        $aktePath = null;

        try {
            $excelDirectory = public_path('uploads/kolektif/excel');
            $akteDirectory = public_path('uploads/kolektif/akte');

            File::ensureDirectoryExists($excelDirectory);
            File::ensureDirectoryExists($akteDirectory);

            $excelName = Str::uuid() . '.' .
                $request->file('file_excel')->getClientOriginalExtension();

            $akteName = Str::uuid() . '.pdf';

            $request->file('file_excel')->move(
                $excelDirectory,
                $excelName
            );

            $excelPath = 'uploads/kolektif/excel/' . $excelName;

            $request->file('akte_pdf')->move(
                $akteDirectory,
                $akteName
            );

            $aktePath = 'uploads/kolektif/akte/' . $akteName;

            // 7. Menyimpan identitas pelatih dan seluruh atlet
            $collectiveRegistration = DB::transaction(function () use (
                $request,
                $athletes,
                $excelPath,
                $aktePath
            ) {
                $collective = CollectiveRegistration::create([
                    'nama_pelatih' => $request->nama_pelatih,
                    'nama_swimschool' => $request->nama_swimschool,
                    'email' => $request->email,
                    'whatsapp' => $request->whatsapp,
                    'file_excel' => $excelPath,
                    'file_akte' => $aktePath,
                    'jumlah_peserta' => count($athletes),
                    'status' => 'menunggu_pembayaran',
                ]);

                foreach ($athletes as $athlete) {
                    Registrant::create([
                        'nama_lengkap' => $athlete['nama_lengkap'],
                        'ku' => $athlete['ku'],
                        'tgl_lahir' => $athlete['tgl_lahir'],
                        'jk' => $athlete['jk'],
                        'email_orangtua' => $athlete['email_orangtua'],
                        'no_hp_orangtua' => $athlete['no_hp_orangtua'],
                        'asal_swimschool' => $athlete['asal_swimschool'],
                        'kategori_lomba' => implode(
                            ', ',
                            $athlete['kategori_lomba']
                        ),
                        'foto' => null,
                        'bukti_pembayaran' => '',
                        'collective_registration_id' => $collective->id,
                    ]);
                }

                return $collective;
            });

        } catch (Throwable $e) {
            if ($excelPath) {
                File::delete(public_path($excelPath));
            }

            if ($aktePath) {
                File::delete(public_path($aktePath));
            }

            throw $e;
        }

        // 8. Menuju halaman pembayaran yang sudah ada
        return redirect()
            ->route('registrations.create', [
                'collective_id' => $collectiveRegistration->id,
                'payment' => 1,
            ])
            ->with('success', 'Data kolektif berhasil disimpan. Silakan lanjutkan pembayaran.');
    }

    // Mengubah tanggal Excel menjadi format database
    
private function normalizeExcelDate($value): string
{
    if ($value instanceof \DateTimeInterface) {
        return $value->format('Y-m-d');
    }

    if (is_numeric($value)) {
        return ExcelDate::excelToDateTimeObject((float) $value)
            ->format('Y-m-d');
    }

    $value = trim((string) $value);

    // Mendukung nama bulan dalam bahasa Indonesia
    $months = [
        'januari' => '01',
        'februari' => '02',
        'maret' => '03',
        'april' => '04',
        'mei' => '05',
        'juni' => '06',
        'juli' => '07',
        'agustus' => '08',
        'september' => '09',
        'oktober' => '10',
        'november' => '11',
        'desember' => '12',
    ];

    $normalized = mb_strtolower($value, 'UTF-8');

    // Contoh: 22 Juli 2021 menjadi 22-07-2021
    if (
        preg_match(
            '/^(\d{1,2})\s+([a-z]+)\s+(\d{4})$/u',
            $normalized,
            $matches
        )
    ) {
        $month = $months[$matches[2]] ?? null;

        if ($month !== null) {
            $date = \DateTime::createFromFormat(
                '!d-m-Y',
                sprintf('%02d-%s-%s', $matches[1], $month, $matches[3])
            );

            $errors = \DateTime::getLastErrors();

            if (
                $date &&
                (
                    $errors === false ||
                    (
                        $errors['warning_count'] === 0 &&
                        $errors['error_count'] === 0
                    )
                )
            ) {
                return $date->format('Y-m-d');
            }
        }
    }

    // Mendukung format tanggal angka
    $formats = [
        'd/m/Y',
        'd-m-Y',
        'Y-m-d',
        'm/d/Y',
        'd/m/y',
    ];

    foreach ($formats as $format) {
        $date = \DateTime::createFromFormat('!' . $format, $value);
        $errors = \DateTime::getLastErrors();

        if (
            $date &&
            (
                $errors === false ||
                (
                    $errors['warning_count'] === 0 &&
                    $errors['error_count'] === 0
                )
            )
        ) {
            return $date->format('Y-m-d');
        }
    }

    throw new \InvalidArgumentException('Tanggal tidak valid.');
}


public function storeCollectivePayment(
    Request $request,
    CollectiveRegistration $collectiveRegistration
) {
    // Validasi bukti pembayaran dan persetujuan
    $request->validate([
        'bukti_pembayaran' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
        'konfirmasi_kuota' => ['accepted'],
        'persetujuan_biaya' => ['accepted'],
    ]);

    // Simpan file bukti pembayaran
    $file = $request->file('bukti_pembayaran');

    $filename = now()->format('YmdHis')
        . '_kolektif_'
        . Str::uuid()
        . '.'
        . $file->getClientOriginalExtension();

    $directory = public_path('uploads/pembayaran-kolektif');

    File::ensureDirectoryExists($directory);

    $file->move($directory, $filename);

    // Simpan lokasi bukti pembayaran ke pendaftaran pelatih
    $collectiveRegistration->bukti_pembayaran =
        'uploads/pembayaran-kolektif/' . $filename;

    // Ubah status menjadi menunggu pemeriksaan Admin
    $collectiveRegistration->status = 'menunggu_verifikasi';

    $collectiveRegistration->save();

    return redirect()
    ->route('registrations.success')
    ->with('success', 'Pendaftaran berhasil dikirim!');
}

    public function index()
    {
        return view('registrations.index');
    }

    public function data()
{
    $registrants = Registrant::with('collectiveRegistration')
        ->latest()
        ->get();

    return view(
        'registrations.partials.rows',
        compact('registrants')
    );
}
}
