@forelse ($registrants as $registrant)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ Str::title($registrant->nama_lengkap) }}</td>
        <td>KU {{ $registrant->ku }}</td>
        <td>{{ $registrant->tgl_lahir->format('Y-m-d') }}</td>
        <td>{{ $registrant->jk }}</td>
        <td>{{ Str::upper($registrant->asal_swimschool) }}</td>
        <td>{{ $registrant->kategori_lomba }}</td>
        @auth
            <td>
                @include('registrations.partials.upload-preview', [
                    'path' => $registrant->foto,
                    'label' => 'Foto ' . $registrant->nama_lengkap,
                ])
            </td>
            <td>
                @include('registrations.partials.upload-preview', [
                    'path' => $registrant->bukti_pembayaran,
                    'label' => 'Bukti pembayaran ' . $registrant->nama_lengkap,
                ])
            </td>
        @endauth
    </tr>
@empty
    <tr>
        <td colspan="@auth 9 @else 7 @endauth" class="px-6 py-12 text-center text-slate-500">Belum ada data pendaftar masuk.</td>
    </tr>
@endforelse
