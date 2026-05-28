<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrantController extends Controller
{
    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $this->renderTable();
        }, 'Laporan_Pendaftar_Fun_Aquatic.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    private function renderTable(): void
    {
        $registrants = Registrant::latest()->get();

        echo '<html><head><meta charset="UTF-8"></head><body>';
        echo '<table border="1" style="border-collapse:collapse;">';
        echo '<tr>';
        echo '<th>No</th><th>Nama Lengkap</th><th>KU</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Asal Swimschool</th><th>Nomor Lomba</th><th>Foto Akte</th>';
        echo '</tr>';

        foreach ($registrants as $index => $registrant) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . e($registrant->nama_lengkap) . '</td>';
            echo '<td>KU ' . e($registrant->ku) . '</td>';
            echo '<td>' . e($registrant->tgl_lahir->format('Y-m-d')) . '</td>';
            echo '<td>' . e($registrant->jk) . '</td>';
            echo '<td>' . e($registrant->asal_swimschool) . '</td>';
            echo '<td>' . e($registrant->kategori_lomba) . '</td>';
            echo '<td style="min-width:140px;height:110px;text-align:center;">' . $this->renderImage($registrant->foto) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</body></html>';
    }

    private function renderImage(?string $path): string
    {
        if (! $path) {
            return '-';
        }

        $fullPath = public_path($path);

        if (! is_file($fullPath)) {
            return e($path);
        }

        $mime = mime_content_type($fullPath) ?: 'image/jpeg';
        $data = base64_encode(file_get_contents($fullPath));

        return '<img src="data:' . e($mime) . ';base64,' . $data . '" width="120" style="max-height:100px;object-fit:cover;">';
    }
}
