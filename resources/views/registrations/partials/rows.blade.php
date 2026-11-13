
@forelse ($registrants as $registrant)

    @php
        $collective = $registrant->collectiveRegistration;

        // Mengambil bukti pembayaran dari data atlet atau data kolektif.
        $paymentPath = $registrant->bukti_pembayaran
            ?: ($collective?->bukti_pembayaran);
    @endphp

    <tr>
        {{-- 1. NOMOR --}}
        <td>{{ $loop->iteration }}</td>

        {{-- 2. NAMA PESERTA --}}
        <td>{{ Str::title($registrant->nama_lengkap) }}</td>

        {{-- 3. KELOMPOK UMUR --}}
        <td>KU {{ $registrant->ku }}</td>

        {{-- 4. TANGGAL LAHIR --}}
        <td> {{ $registrant->tgl_lahir->locale('id')->translatedFormat('d F Y') }} </td>

        {{-- 5. JENIS KELAMIN --}}
        <td>{{ $registrant->jk }}</td>

        {{-- 6. ASAL SWIMSCHOOL --}}
        <td>{{ Str::upper($registrant->asal_swimschool) }}</td>

        {{-- 7. DATA PELATIH / PERWAKILAN --}}
<td>
    @if ($collective)
        <div style="
            display:flex;
            flex-direction:column;
            gap:5px;
            min-width:180px;
            text-align:left;
        ">
            <strong>
                {{ $collective->nama_pelatih }}
            </strong>

            <span style="font-size:12px; color:#64748b;">
                {{ $collective->email }}
            </span>

            <span style="font-size:12px; color:#64748b;">
                {{ $collective->whatsapp }}
            </span>

            <span style="
                font-size:10px;
                font-weight:800;
                color:#db2777;
            ">
                PENDAFTARAN KOLEKTIF
            </span>
        </div>
    @else
        <span style="color:#64748b;">
            Pendaftaran Mandiri
        </span>
    @endif
</td>

        {{-- 7. NOMOR LOMBA --}}
        <td>{{ $registrant->kategori_lomba }}</td>

        @auth

            {{-- 8. EMAIL ORANG TUA --}}
            <td>
                {{ $registrant->email_orangtua ?? '-' }}
            </td>

            {{-- 9. NOMOR WHATSAPP ORANG TUA --}}
            <td>
                {{ $registrant->no_hp_orangtua ?? '-' }}
            </td>

            {{-- 10. FOTO AKTE MANDIRI --}}
            <td>
                @if ($registrant->foto)

                    @include('registrations.partials.upload-preview', [
                        'path' => $registrant->foto,
                        'label' => 'Foto Akte ' . $registrant->nama_lengkap,
                    ])

                @else
                    <span>-</span>
                @endif
            </td>

            {{-- 11. PDF AKTA KOLEKTIF --}}
            <td>
                @if ($collective && $collective->file_akte)

                    <div style="
                        display:flex;
                        flex-direction:column;
                        align-items:center;
                        justify-content:center;
                        gap:8px;
                    ">

                        {{-- LIHAT PDF --}}
                        <a
                            href="{{ asset($collective->file_akte) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            style="
                                display:inline-block;
                                background:#2563eb;
                                color:#ffffff;
                                padding:8px 14px;
                                border-radius:8px;
                                font-size:12px;
                                font-weight:800;
                                text-decoration:none;
                                white-space:nowrap;
                            "
                        >
                            LIHAT PDF
                        </a>

                        {{-- UNDUH PDF --}}
                        <a
                            href="{{ asset($collective->file_akte) }}"
                            download
                            style="
                                display:inline-block;
                                background:#dc2626;
                                color:#ffffff;
                                padding:8px 14px;
                                border-radius:8px;
                                font-size:12px;
                                font-weight:800;
                                text-decoration:none;
                                white-space:nowrap;
                            "
                        >
                            UNDUH PDF
                        </a>

                    </div>

                @else
                    <span>-</span>
                @endif
            </td>

            {{-- 12. BUKTI PEMBAYARAN (SATU KOLOM SAJA) --}}
            <td>
                @if ($paymentPath)

                    @include('registrations.partials.upload-preview', [
                        'path' => $paymentPath,
                        'label' => 'Bukti Pembayaran ' . $registrant->nama_lengkap,
                    ])

                @else
                    <span>-</span>
                @endif
            </td>

        @endauth
    </tr>

@empty

    <tr>
        <td
            colspan="@auth 13 @else 7 @endauth"
            class="px-6 py-12 text-center text-slate-500"
        >
            Belum ada data pendaftar masuk.
        </td>
    </tr>

@endforelse
