
@extends('layouts.app')

@section('title', 'Pilih Jenis Pendaftaran - Fun Aquatic')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/registration-choice.css') }}">
@endpush

@section('content')
<main class="choice-page">

    <div class="choice-container">

        <div class="choice-heading">
            <span class="choice-label">FUN AQUATIC COMPETITION SERIES III</span>

            <h1>PILIH JENIS PENDAFTARAN</h1>

            <p>
                Silakan pilih metode pendaftaran yang sesuai dengan kebutuhan Anda.
                Pastikan memilih jenis pendaftaran sebelum melanjutkan.
            </p>
        </div>

        <div class="choice-cards">

            <!-- PENDAFTARAN MANDIRI -->
            <div class="choice-card individual-card">

                <div class="choice-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <span class="choice-badge">1 PESERTA</span>

                <h2>Pendaftaran Mandiri</h2>

                <p>
                    Pendaftaran untuk orang tua atau peserta
                    yang ingin mendaftarkan satu atlet secara langsung.
                </p>

                <ul>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Mengisi formulir secara mandiri
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Mengisi data satu peserta
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Mengunggah dokumen peserta
                    </li>
                </ul>

                <a href="{{ route('registrations.create') }}"
                   class="choice-button individual-button">
                    PILIH MANDIRI
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>


            <!-- PENDAFTARAN KOLEKTIF -->
            <div class="choice-card collective-card">

                <div class="choice-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <span class="choice-badge">MINIMAL 10 PESERTA</span>

                <h2>Pendaftaran Kolektif</h2>

                <p>
                    Pendaftaran untuk pelatih atau perwakilan
                    swimschool yang ingin mendaftarkan beberapa atlet sekaligus.
                </p>

                <ul>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Diisi oleh satu orang pelatih
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Upload data peserta melalui Excel
                    </li>
                    <li>
                        <i class="fa-solid fa-check"></i>
                        Minimal 10 atlet dalam satu pendaftaran
                    </li>
                </ul>
                <a href="{{ route('registrations.collective') }}"
   class="choose-button collective-button">
    PILIH KOLEKTIF <span>→</span>
</a>
            </div>

        </div>

        <div class="choice-footer">
            <i class="fa-solid fa-circle-info"></i>
            Pastikan jenis pendaftaran yang Anda pilih sudah sesuai.
        </div>
        <div class="choose-admin-access">
    <span>Khusus Admin?</span>
    <a href="{{ route('admin.login') }}" class="choose-admin-link">
        Login Admin →
    </a>
</div>

        <a href="{{ route('registrations.rules') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Ketentuan Lomba
        </a>

    </div>

</main>
@endsection
