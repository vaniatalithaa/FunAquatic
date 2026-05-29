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
            <<td>

    @if($registrant->foto)

        <div style="
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:8px;
        ">

            <img
                class="mx-auto h-20 w-24 rounded-lg border border-slate-200 object-cover"
                src="{{ asset($registrant->foto) }}"
                alt="Foto {{ $registrant->nama_lengkap }}"
            >

            <a
                href="{{ asset($registrant->foto) }}"
                download
                style="
                    background:#dc2626;
                    color:white;
                    padding:6px 12px;
                    border-radius:8px;
                    text-decoration:none;
                    font-size:12px;
                    font-weight:600;
                "
            >
                Download
            </a>

        </div>

    @else

        <span class="text-sm font-semibold text-slate-400">-</span>

    @endif

</td>
        @endauth
    </tr>
@empty
    <tr>
        <td colspan="@auth 8 @else 7 @endauth" class="px-6 py-12 text-center text-slate-500">Belum ada data pendaftar masuk.</td>
    </tr>
@endforelse
