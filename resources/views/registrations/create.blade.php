@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - Fun Aquatic')

@section('content')
<main class="page-band">
    <div class="container narrow">
        <div class="section-heading">
            <h1>Formulir Pendaftaran</h1>
            <p>Silakan isi data diri anak untuk mengikuti kompetisi renang 2026.</p>
        </div>

        <form class="form-card" action="{{ route('registrations.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-error">
                    Data belum lengkap atau belum sesuai. Silakan cek kembali formulir.
                </div>
            @endif

            <label>Nama Anak Lengkap
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap') <small>{{ $message }}</small> @enderror
            </label>

            <div class="form-row">
                <label>Kelompok Usia
                    <select name="ku" required>
                        <option value="">-- Pilih KU --</option>
                        @foreach ($ageGroups as $ageGroup)
                            <option value="{{ $ageGroup }}" @selected(old('ku') === $ageGroup)>KU {{ $ageGroup }} Tahun</option>
                        @endforeach
                    </select>
                    @error('ku') <small>{{ $message }}</small> @enderror
                </label>

                <label>Tanggal Lahir
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                    @error('tgl_lahir') <small>{{ $message }}</small> @enderror
                </label>
            </div>

            <fieldset>
                <legend>Jenis Kelamin</legend>
                <label class="radio"><input type="radio" name="jk" value="Laki-laki" @checked(old('jk') === 'Laki-laki') required> Laki-laki</label>
                <label class="radio"><input type="radio" name="jk" value="Perempuan" @checked(old('jk') === 'Perempuan') required> Perempuan</label>
                @error('jk') <small>{{ $message }}</small> @enderror
            </fieldset>

            <label>Asal Swimschool
                <input type="text" name="asal_swimschool" value="{{ old('asal_swimschool') }}" placeholder="Tulis asal swimschool" required>
                @error('asal_swimschool') <small>{{ $message }}</small> @enderror
            </label>

            <label>Nomor Lomba yang Diikuti
                <select name="kategori_lomba" required>
                    <option value="">-- Pilih Nomor Lomba --</option>
                    @foreach ($raceCategories as $raceCategory)
                        <option value="{{ $raceCategory }}" @selected(old('kategori_lomba') === $raceCategory)>{{ $raceCategory }}</option>
                    @endforeach
                </select>
                @error('kategori_lomba') <small>{{ $message }}</small> @enderror
            </label>

            <button class="button button-primary full" type="submit">Daftar Sekarang</button>

            <div class="admin-link">
                <span>Khusus Admin:</span>
                <a href="{{ route('admin.login') }}">Login Admin & Cek Data</a>
            </div>
        </form>
    </div>
</main>
@endsection
