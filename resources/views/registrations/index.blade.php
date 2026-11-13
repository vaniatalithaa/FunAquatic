@extends('layouts.app')

@section('title', 'Daftar Peserta - Fun Aquatic')

@section('content')
<main class="registration-page">
    <div class="registration-container">
        <div class="registration-card table-card">
            <div class="registration-heading !mb-6">
                <p class="registration-kicker">Live Data</p>
                <h1 class="mt-2 text-3xl font-black uppercase leading-tight text-slate-950 sm:text-5xl">Daftar Peserta Berhasil</h1>
                <p class="mt-3 text-base leading-7 text-slate-600">Silakan screenshot halaman ini sebagai bukti pendaftaran.</p>
            </div>

            @if (session('success'))
                <div class="success-alert">{{ session('success') }}</div>
            @endif

            <div class="table-toolbar">
                <a class="secondary-button" href="{{ route('registrations.rules') }}">Tambah Pendaftaran Baru</a>

                @auth
                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                        <a class="primary-button" href="{{ route('admin.registrants.export') }}">Download Excel + Bukti</a>
                    </div>
                @endauth
            </div>

            <div class="table-scroll">
                <table class="participants-table">
                    
<thead>
    <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>KU</th>
        <th>Tgl Lahir</th>
        <th>L/P</th>
        <th>Asal Swimschool</th>
        <th>Data Pelatih / Perwakilan</th>
        <th>Nomor Lomba</th>

        @auth
            <th>Email Orang Tua</th>
            <th>No. WhatsApp Orang Tua</th>
            <th>Foto Akte Mandiri</th>
            <th>PDF Akta Kolektif</th>
            <th>Bukti Pembayaran</th>
        @endauth
    </tr>
</thead>

                    <tbody id="data-peserta"></tbody>
                </table>
            </div>

            @auth
                <form class="mt-6 text-right" method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="danger-button w-full sm:w-auto" type="submit">Logout Admin</button>
                </form>
            @endauth
        </div>
    </div>
</main>

@if (session('show_success_popup'))
    <div class="success-modal" id="successModal" role="dialog" aria-modal="true" aria-labelledby="successModalTitle">
        <div class="success-modal-card">
            <p class="success-modal-kicker">Pendaftaran Berhasil</p>
            <h2 id="successModalTitle">Selamat, peserta telah terdaftar!</h2>
            <p>Silakan screenshot tampilan daftar pendaftaran ini sebagai bukti pendaftaran.</p>
            
<button
    class="primary-button w-full"
    type="button"
    onclick="document.getElementById('successModal').remove();">
    MENGERTI
</button>

    </div>
@endif
@endsection

@push('scripts')

<script>
    async function loadData() {
        try {
            const response = await fetch(@json(route('registrations.data')), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data peserta');
            }

            const html = await response.text();

            document.getElementById('data-peserta').innerHTML = html;

        } catch (error) {
            console.error('Kesalahan mengambil data:', error);
        }
    }

    loadData();
    setInterval(loadData, 3000);

    document.getElementById('successModalClose')?.addEventListener('click', () => {
        document.getElementById('successModal')?.remove();
    });
</script>

@endpush
