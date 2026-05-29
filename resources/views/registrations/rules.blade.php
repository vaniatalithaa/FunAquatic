@extends('layouts.app')

@section('title', 'Ketentuan Lomba - Fun Aquatic')

@section('content')
<main class="registration-page">
    <div class="registration-container">
        <div class="registration-heading">
            <p class="registration-kicker">Pendaftaran</p>
            <h1 class="registration-title">Ketentuan Lomba</h1>
            <p class="registration-copy">Baca juknis terlebih dahulu agar kategori lomba, usia, dan data peserta yang dikirim sudah sesuai.</p>
        </div>

        <div class="rules-layout">
            <aside class="registration-card rules-aside">
                <p class="form-section-title">Sebelum Daftar</p>
                <ul class="rules-list">
                    <li>Pastikan kelompok usia peserta sudah sesuai dengan tanggal lahir.</li>
                    <li>Pilih nomor lomba yang benar sebelum mengirim formulir.</li>
                    <li>Siapkan data swimschool dan foto peserta jika ingin dilampirkan.</li>
                </ul>

                <label class="agreement-box">
                    <input type="checkbox" id="syaratCheck">
                    <span>Saya telah membaca seluruh ketentuan perlombaan dan menyatakan peserta memenuhi seluruh syarat yang berlaku untuk mengikuti Fun Aquatic Competition Series II.</span>
                </label>
                <label class="agreement-box">
                    <input type="checkbox" id="syaratCheck">
                    <span>Saya menyatakan bahwa seluruh data yang diisi sudah benar dan menjadi tanggung jawab pribadi peserta.</span>
                </label>

                <a href="{{ route('registrations.create') }}" id="btnDaftar" class="primary-button pointer-events-none mt-4 w-full opacity-45">Lanjut ke Formulir Pendaftaran</a>
            </aside>

            <section class="registration-card pdf-panel" aria-label="Dokumen ketentuan lomba">
                <iframe src="{{ asset('juknis.pdf') }}" title="Ketentuan Lomba"></iframe>
            </section>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const checkBox = document.getElementById('syaratCheck');
    const btnDaftar = document.getElementById('btnDaftar');

    checkBox.addEventListener('change', () => {
        btnDaftar.classList.toggle('pointer-events-none', !checkBox.checked);
        btnDaftar.classList.toggle('opacity-45', !checkBox.checked);
    });
</script>
@endpush
