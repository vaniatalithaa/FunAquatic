@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - Fun Aquatic')

@section('content')
<main class="registration-page">
    <div class="registration-container form-width">
        <div class="registration-heading">
            <p class="registration-kicker">Fun Aquatic Competition Series II</p>
            <h1 class="registration-title">Formulir Pendaftaran</h1>
            <p class="registration-copy">Isi data peserta dengan teliti. Setelah berhasil, nama peserta akan langsung masuk ke daftar pendaftaran.</p>
        </div>

        <form class="registration-card registration-form" action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="error-alert">
                    Data belum lengkap atau belum sesuai. Silakan cek kembali formulir.
                </div>
            @endif

            <p class="form-section-title">Data Peserta</p>

            <label class="form-field">Nama Anak Lengkap
                <input class="form-control" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" autocomplete="name" required>
                @error('nama_lengkap') <small>{{ $message }}</small> @enderror
            </label>

            <div class="form-grid">
                <label class="form-field">Kelompok Usia
                    <select class="form-control" name="ku" required>
                        <option value="">-- Pilih KU --</option>
                        @foreach ($ageGroups as $ageGroup)
                            <option value="{{ $ageGroup }}" @selected(old('ku') === $ageGroup)>KU {{ $ageGroup }} Tahun</option>
                        @endforeach
                    </select>
                    @error('ku') <small>{{ $message }}</small> @enderror
                </label>

                <label class="form-field">Tanggal Lahir
                    <input class="form-control" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                    @error('tgl_lahir') <small>{{ $message }}</small> @enderror
                </label>
            </div>

            <fieldset class="form-field">
                <legend>Jenis Kelamin</legend>
                <div class="choice-grid">
                    <label class="choice-card">
                        <input type="radio" name="jk" value="Laki-laki" @checked(old('jk') === 'Laki-laki') required>
                        Laki-laki
                    </label>
                    <label class="choice-card">
                        <input type="radio" name="jk" value="Perempuan" @checked(old('jk') === 'Perempuan') required>
                        Perempuan
                    </label>
                </div>
                @error('jk') <small>{{ $message }}</small> @enderror
            </fieldset>

            <label class="form-field">Asal Swimschool
                <input class="form-control" type="text" name="asal_swimschool" value="{{ old('asal_swimschool') }}" placeholder="Contoh: Fun Aquatic Swimschool" required>
                @error('asal_swimschool') <small>{{ $message }}</small> @enderror
            </label>

            <p class="form-section-title">Kategori Lomba</p>

            <fieldset class="form-field">

    <legend style="
        font-size:16px;
        font-weight:600;
        margin-bottom:18px;
        color:#0f172a;
    ">
        Nomor Lomba yang Diikuti
    </legend>

    <div style="
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:16px;
    ">

        @foreach ($raceCategories as $raceCategory)

            <label style="
                display:flex;
                align-items:center;
                gap:14px;
                padding:20px;
                border:1.5px solid #dbe2ea;
                border-radius:14px;
                background:white;
                cursor:pointer;
                font-size:16px;
                font-weight:600;
                color:#1e293b;
                transition:0.2s;
            ">

                <input
                    type="checkbox"
                    name="kategori_lomba[]"
                    value="{{ $raceCategory }}"
                    @checked(in_array($raceCategory, old('kategori_lomba', []), true))

                    style="
                        width:20px;
                        height:20px;
                        cursor:pointer;
                    "
                >

                {{ $raceCategory }}

            </label>

        @endforeach

    </div>

    @error('kategori_lomba')
        <small>{{ $message }}</small>
    @enderror

</fieldset>

            <label class="form-field">Upload Foto Akte
                <input class="form-control file-control" type="file" name="foto" accept="image/*">
                <span class="text-sm font-semibold text-slate-500">Opsional. Upload foto akte yang jelas, maksimal 2MB.</span>
                @error('foto') <small>{{ $message }}</small> @enderror
            </label>

            <button class="primary-button w-full" type="submit">Daftar Sekarang</button>

            <div class="border-t border-slate-200 pt-5 text-center text-sm text-slate-500">
                <span class="font-semibold">Khusus Admin:</span>
                <a class="font-extrabold text-cyan-800 hover:text-cyan-900" href="{{ route('admin.login') }}">Login Admin & Cek Data</a>
            </div>
        </form>
    </div>
</main>
@endsection