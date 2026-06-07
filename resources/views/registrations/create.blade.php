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

            <section class="form-step is-active" data-form-step="1">
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

            <button class="primary-button w-full" type="button" id="nextPaymentStep">Pendaftaran Sekarang</button>
            </section>

            <section class="form-step" data-form-step="2" aria-hidden="true">
                <p class="form-section-title">Pembayaran FAC Series II</p>

                <div class="payment-info-card">
                    <h2>Harga Perlombaan <strong>Early Bird</strong> <span>(Berlaku 28 Mei-11 Juni)</span></h2>
                    <p>1 Nomor Perlombaan (Rp 175.000)</p>
                    <p>2 Nomor Perlombaan (Rp 300.000)</p>
                    <p>3 Nomor Perlombaan (Rp 375.000)</p>
                </div>

                <div class="payment-info-card">
                    <h2>Harga Perlombaan <strong>Normal</strong> <span>(Berlaku 12 Juni-12 Juli)</span></h2>
                    <p>1 Nomor Perlombaan (Rp 205.000)</p>
                    <p>2 Nomor Perlombaan (Rp 330.000)</p>
                    <p>3 Nomor Perlombaan (Rp 405.000)</p>
                </div>

                <div class="payment-info-card payment-bank-card">
                    <h2>Silakan melakukan pembayaran sesuai kategori yang dipilih ke rekening berikut:</h2>
                    <dl>
                        <div>
                            <dt>Bank</dt>
                            <dd>: BCA</dd>
                        </div>
                        <div>
                            <dt>No. Rekening</dt>
                            <dd>: 8620596940</dd>
                        </div>
                        <div>
                            <dt>Atas Nama</dt>
                            <dd>: Hananda Widadputri Asri</dd>
                        </div>
                    </dl>

                    <p>Setelah melakukan pembayaran, mohon upload bukti pembayaran pada kolom di bawah ini.</p>
                    <p>Format catatan pembayaran: (Nama peserta/ nama swim school atau nama pelatih/ jumlah peserta)</p>
                    <p>Contoh: (Budi dermawan/ coach Adi/ 3 peserta)</p>
                    <p><strong>Catatan:</strong> Mohon pastikan nominal transfer, data peserta, dan bukti pembayaran yang diunggah sudah sesuai untuk mempercepat proses verifikasi.</p>
                </div>

                <label class="form-field">Upload Bukti Pembayaran
                    <input class="form-control file-control" type="file" name="bukti_pembayaran" accept="image/*" required>
                    <span class="text-sm font-semibold text-slate-500">Wajib. Upload bukti transfer yang jelas, maksimal 2MB.</span>
                    @error('bukti_pembayaran') <small>{{ $message }}</small> @enderror
                </label>

                <label class="agreement-box">
                    <input type="checkbox" name="konfirmasi_kuota" value="1" @checked(old('konfirmasi_kuota')) required>
                    <span>Saya memahami bahwa kuota peserta hanya dapat diamankan setelah pembayaran dilakukan.</span>
                </label>
                @error('konfirmasi_kuota') <small>{{ $message }}</small> @enderror

                <label class="agreement-box">
                    <input type="checkbox" name="persetujuan_biaya" value="1" @checked(old('persetujuan_biaya')) required>
                    <span>Dengan menyetujui formulir ini saya memahami dan menyetujui bahwa biaya pendaftaran yang telah dibayarkan tidak dapat dikembalikan apabila data yang dikirim sudah masuk proses verifikasi.</span>
                </label>
                @error('persetujuan_biaya') <small>{{ $message }}</small> @enderror

                <div class="form-actions">
                    <button class="secondary-button" type="button" id="backParticipantStep">Kembali</button>
                    <button class="primary-button" type="submit">Daftar Sekarang</button>
                </div>
            </section>

            <div class="border-t border-slate-200 pt-5 text-center text-sm text-slate-500">
                <span class="font-semibold">Khusus Admin:</span>
                <a class="font-extrabold text-cyan-800 hover:text-cyan-900" href="{{ route('admin.login') }}">Login Admin & Cek Data</a>
            </div>
        </form>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const participantStep = document.querySelector('[data-form-step="1"]');
    const paymentStep = document.querySelector('[data-form-step="2"]');
    const nextPaymentStep = document.getElementById('nextPaymentStep');
    const backParticipantStep = document.getElementById('backParticipantStep');
    const registrationForm = document.querySelector('.registration-form');

    function setStep(step) {
        const isPaymentStep = step === 2;

        participantStep?.classList.toggle('is-active', !isPaymentStep);
        paymentStep?.classList.toggle('is-active', isPaymentStep);
        participantStep?.setAttribute('aria-hidden', isPaymentStep ? 'true' : 'false');
        paymentStep?.setAttribute('aria-hidden', isPaymentStep ? 'false' : 'true');

        registrationForm?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    nextPaymentStep?.addEventListener('click', () => {
        const firstStepFields = participantStep?.querySelectorAll('input, select, textarea') ?? [];
        const invalidField = Array.from(firstStepFields).find((field) => !field.checkValidity());

        if (invalidField) {
            invalidField.reportValidity();
            return;
        }

        setStep(2);
    });

    backParticipantStep?.addEventListener('click', () => setStep(1));

    @if ($errors->has('bukti_pembayaran') || $errors->has('konfirmasi_kuota') || $errors->has('persetujuan_biaya'))
        setStep(2);
    @endif
</script>
@endpush
