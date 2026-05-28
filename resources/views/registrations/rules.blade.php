@extends('layouts.app')

@section('title', 'Ketentuan Lomba - Fun Aquatic')

@section('content')
<main class="page-band">
    <div class="container wide">
        <div class="section-heading">
            <h1>Ketentuan Lomba</h1>
            <p>Silakan membaca petunjuk dan ketentuan perlombaan sebelum melakukan pendaftaran peserta.</p>
        </div>

        <div class="pdf-frame">
            <iframe src="{{ asset('juknis.pdf') }}" title="Ketentuan Lomba"></iframe>
        </div>

        <label class="agreement">
            <input type="checkbox" id="syaratCheck">
            <span>Saya telah membaca seluruh ketentuan perlombaan dan menyatakan peserta memenuhi seluruh syarat yang berlaku untuk mengikuti Fun Aquatic Competition Series II.</span>
        </label>

        <div class="center-actions">
            <a href="{{ route('registrations.create') }}" id="btnDaftar" class="button button-primary disabled-link">Lanjut ke Formulir Pendaftaran</a>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const checkBox = document.getElementById('syaratCheck');
    const btnDaftar = document.getElementById('btnDaftar');

    checkBox.addEventListener('change', () => {
        btnDaftar.classList.toggle('disabled-link', !checkBox.checked);
    });
</script>
@endpush
