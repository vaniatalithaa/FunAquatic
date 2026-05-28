<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public const AGE_GROUPS = ['3-4', '5-6', '7-8', '9-10', '11-12', '13-14'];

    public const RACE_CATEGORIES = [
        '15m Kaki Gaya Bebas',
        '30m Kaki Gaya Bebas',
        '15m Gaya Bebas',
        '15m Gaya Dada',
        '30m Gaya Bebas',
        '30m Gaya Dada',
    ];

    public function rules()
    {
        return view('registrations.rules');
    }

    public function create()
    {
        return view('registrations.create', [
            'ageGroups' => self::AGE_GROUPS,
            'raceCategories' => self::RACE_CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'ku' => ['required', 'in:' . implode(',', self::AGE_GROUPS)],
            'tgl_lahir' => ['required', 'date'],
            'jk' => ['required', 'in:Laki-laki,Perempuan'],
            'asal_swimschool' => ['required', 'string', 'max:255'],
            'kategori_lomba' => ['required', 'in:' . implode(',', self::RACE_CATEGORIES)],
        ]);

        $fotoPath = null;

if ($request->hasFile('foto')) {

    $file = $request->file('foto');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('uploads'), $filename);

    $fotoPath = 'uploads/' . $filename;
}

$validated['foto'] = $fotoPath;

        Registrant::create($validated);

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Data pendaftaran berhasil disimpan.');
    }

    public function index()
    {
        return view('registrations.index');
    }

    public function data()
    {
        $registrants = Registrant::latest()->get();

        return view('registrations.partials.rows', compact('registrants'));
    }
}
