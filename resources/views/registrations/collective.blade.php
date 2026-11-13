
@extends('layouts.app')

@section('title', 'Pendaftaran Kolektif - Fun Aquatic')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/collective.css') }}">
@endpush

@section('content')
<main class="collective-page">

    <div class="collective-heading">
        <p class="collective-kicker">FUN AQUATIC COMPETITION SERIES III</p>
        <h1>PENDAFTARAN KOLEKTIF</h1>
        <p>
            Daftarkan beberapa atlet sekaligus melalui satu formulir
            dengan mengunggah data peserta menggunakan Excel.
        </p>
    </div>

    <div class="collective-container">

        <div class="collective-info">
            <div class="info-icon">👥</div>
            <h2>Pendaftaran Satu Pelatih</h2>
            <p>
                Pendaftaran kolektif ditujukan untuk pelatih atau
                perwakilan swimschool yang ingin mendaftarkan
                beberapa atlet sekaligus.
            </p>

            <div class="minimum-box">
                <span>MINIMAL PENDAFTARAN</span>
                <strong>10 Atlet</strong>
                <small>Dalam satu kali pengiriman Excel</small>
            </div>

            <ul>
                <li>Diisi oleh satu pelatih atau perwakilan.</li>
                <li>Data setiap atlet tetap tercatat secara individual.</li>
                <li>Data peserta dikirim melalui template Excel.</li>
                <li>Pastikan seluruh data sudah benar sebelum dikirim.</li>
            </ul>
        </div>

        <div class="collective-form-card">
            <h2>Data Pelatih / Perwakilan</h2>
            <p class="form-description">
                Lengkapi identitas penanggung jawab pendaftaran.
            </p>

            <form
    action="{{ route('registrations.collective.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
                @csrf

                <div class="collective-field">
                    <label>Nama Pelatih / Perwakilan</label>
                    <input type="text" name="nama_pelatih"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="collective-field">
                    <label>Nama Swimschool</label>
                    <input type="text" name="nama_swimschool"
                        placeholder="Masukkan nama swimschool" required>
                </div>

                <div class="collective-grid">
                    <div class="collective-field">
                        <label>Email</label>
                        <input type="email" name="email"
                            placeholder="nama@email.com" required>
                    </div>

                    <div class="collective-field">
                        <label>Nomor WhatsApp</label>
                        <input type="tel" name="whatsapp"
                            placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                
                {{-- PESAN ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="error-alert">
                        <strong>Pendaftaran belum berhasil:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- UPLOAD DATA PESERTA EXCEL --}}
                <div class="excel-section">
                    <h3>Upload Data Peserta</h3>
                    <p>
                        Gunakan template Excel Fun Aquatic dan
                        masukkan minimal 10 data atlet.
                    </p>

                    <div class="template-box">
                        <div class="excel-icon">XLS</div>

                        <div>
                            <strong>Template Pendaftaran Kolektif</strong>
                            <small>Format file Excel (.xlsx)</small>
                        </div>

                        <a
                            href="{{ asset('templates/template-pendaftaran-kolektif-fun-aquatic.xlsx') }}"
                            class="template-status"
                            download
                        >
                            Download Template
                        </a>
                    </div>

                    <div class="upload-area">
                        <div class="upload-icon">↑</div>

                        <strong>Pilih File Excel</strong>
                        <p>Unggah file pendaftaran peserta di sini</p>

                        <input
                            type="file"
                            name="file_excel"
                            id="fileExcel"
                            accept=".xlsx,.xls"
                            required
                            hidden
                        >

                        <label for="fileExcel" class="upload-button">
                            PILIH FILE
                        </label>

                        <div id="fileName" class="file-name">
                            Belum ada file yang dipilih
                        </div>
                    </div>
                </div>

                {{-- UPLOAD AKTA KELAHIRAN PDF --}}
                <div class="upload-section">
                    <h3>Upload Akta Kelahiran Peserta</h3>

                    <p>
                        Gabungkan seluruh akta kelahiran peserta ke dalam
                        satu file PDF. Minimal 10 akta kelahiran.
                    </p>

                    <div class="upload-document-box">
                        <div class="upload-icon">📄</div>

                        <h4>Upload Akta Kelahiran</h4>

                        <p>
                            Unggah satu file PDF yang berisi minimal
                            10 akta kelahiran peserta.
                        </p>

                        <input
                            type="file"
                            id="akte_pdf"
                            name="akte_pdf"
                            accept=".pdf,application/pdf"
                            required
                            hidden
                        >

                        <label for="akte_pdf" class="upload-document-button">
                            PILIH FILE PDF
                        </label>

                        <div id="akteFileName" class="upload-file-name">
                            Belum ada file yang dipilih
                        </div>

                        <small>Format PDF. Maksimal 20 MB.</small>
                    </div>
                </div>

                {{-- PERSETUJUAN DATA --}}
                <label class="collective-agreement">
                    <input
                        type="checkbox"
                        name="persetujuan_data"
                        value="1"
                        required
                    >

                    <span>
                        Saya menyatakan bahwa data peserta yang
                        diunggah sudah benar dan sesuai dengan
                        ketentuan perlombaan.
                    </span>
                </label>

                {{-- TOMBOL SUBMIT --}}
                <button type="submit" class="collective-submit">
                    LANJUTKAN PENDAFTARAN →
                </button>

                <a
                    href="{{ route('registrations.choose') }}"
                    class="collective-back"
                >
                    Kembali Memilih Jenis Pendaftaran
                </a>

            </form>
        </div>

    </div>

</main>
@endsection

@push('scripts')
<script>
    const fileInput = document.getElementById('fileExcel');
    const fileName = document.getElementById('fileName');

    const akteInput = document.getElementById('akte_pdf');
    const akteFileName = document.getElementById('akteFileName');

    fileInput?.addEventListener('change', function () {
        fileName.textContent = this.files.length
            ? 'File dipilih: ' + this.files[0].name
            : 'Belum ada file yang dipilih';
    });

    akteInput?.addEventListener('change', function () {
        akteFileName.textContent = this.files.length
            ? 'File dipilih: ' + this.files[0].name
            : 'Belum ada file yang dipilih';
    });
</script>
@endpush
