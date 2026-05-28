@extends('layouts.app')

@section('title', 'Daftar Peserta - Fun Aquatic')

@section('content')
<main class="page-band">
    <div class="container wide">
        <div class="table-shell">
            <div class="section-heading compact">
                <h1>Daftar Peserta Berhasil</h1>
                <p>Data peserta kompetisi renang 2026 diperbarui otomatis.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-actions">
                <a href="{{ route('registrations.rules') }}">Tambah Pendaftaran Baru</a>

                @auth
                    <div class="download-actions">
                        <a class="button button-success" href="{{ route('admin.registrants.export') }}">Download Excel</a>
                        <a class="button button-primary" href="{{ route('admin.registrants.live-query') }}">Excel Live</a>
                    </div>
                @endauth
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>KU</th>
                            <th>Tgl Lahir</th>
                            <th>L/P</th>
                            <th>Asal Swimschool</th>
                            <th>Nomor Lomba</th>
                           @auth
    <th>Foto</th>
@endauth
                        </tr>
                    </thead>
                    <tbody id="data-peserta"></tbody>
                </table>
            </div>

            @auth
                <form class="logout-form" method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="button button-danger" type="submit">Logout Admin</button>
                </form>
            @endauth
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    async function loadData() {
        const response = await fetch('{{ route('registrations.data') }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        document.getElementById('data-peserta').innerHTML = await response.text();
    }

    loadData();
    setInterval(loadData, 3000);
</script>
@endpush
