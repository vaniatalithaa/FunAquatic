@forelse ($registrants as $registrant)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ Str::title($registrant->nama_lengkap) }}</td>
        <td>KU {{ $registrant->ku }}</td>
        <td>{{ $registrant->tgl_lahir->format('Y-m-d') }}</td>
        <td>{{ $registrant->jk }}</td>
        <td>{{ Str::upper($registrant->asal_swimschool) }}</td>
        <td>{{ $registrant->kategori_lomba }}</td>
        <td>
    @auth
<td>
    @if($registrant->foto)
         <img src="{{ asset($registrant->foto) }}"
             width="120"
             style="
                border-radius:12px;
                object-fit:cover;
                border:2px solid #e5e7eb;
             ">
    @endif
</td>
@endauth
</td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="empty-row">Belum ada data pendaftar masuk.</td>
    </tr>
@endforelse
