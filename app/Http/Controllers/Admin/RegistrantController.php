<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Illuminate\Support\Facades\URL;
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

    public function liveQuery(): StreamedResponse
    {
        $url = URL::temporarySignedRoute('admin.registrants.live-data', now()->addYears(5));

        return response()->streamDownload(function () use ($url) {
            echo "WEB\n";
            echo "1\n";
            echo $url . "\n\n";
            echo "Selection=AllTables\n";
            echo "Formatting=None\n";
            echo "PreFormattedTextToColumns=True\n";
            echo "ConsecutiveDelimitersAsOne=True\n";
            echo "SingleBlockTextImport=False\n";
            echo "DisableDateRecognition=False\n";
            echo "DisableRedirections=False\n";
        }, 'Laporan_Pendaftar_Fun_Aquatic_Live.iqy', [
            'Content-Type' => 'text/x-ms-iqy; charset=UTF-8',
        ]);
    }

    public function liveData(): StreamedResponse
    {
        return response()->stream(function () {
            $this->renderTable();
        }, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
        ]);
    }

    private function renderTable(): void
    {
        $registrants = Registrant::latest()->get();

        echo '<table border="1">';
        echo '<tr><th>No</th><th>Nama Lengkap</th><th>KU</th><th>Tanggal Lahir</th><th>Jenis Kelamin</th><th>Asal Swimschool</th><th>Nomor Lomba</th><th>Foto</th></tr>';

        foreach ($registrants as $index => $registrant) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . e($registrant->nama_lengkap) . '</td>';
            echo '<td>KU ' . e($registrant->ku) . '</td>';
            echo '<td>' . e($registrant->tgl_lahir->format('Y-m-d')) . '</td>';
            echo '<td>' . e($registrant->jk) . '</td>';
            echo '<td>' . e($registrant->asal_swimschool) . '</td>';
            echo '<td>' . e($registrant->kategori_lomba) . '</td>';
            echo '<td><img src="' . asset($registrant->foto) . '" width="100"></td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}
