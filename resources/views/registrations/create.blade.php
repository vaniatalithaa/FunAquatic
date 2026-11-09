@extends('layouts.app')

@section('title', 'Formulir Pendaftaran - Fun Aquatic')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/ticket.css') }}">
@endpush

@section('content')
<main class="registration-page">
    <div class="registration-container form-width">
        <div class="registration-heading">
            <p class="registration-kicker">Fun Aquatic Competition Series III</p>
            <h1 class="registration-title">Formulir Pendaftaran</h1>
            <p class="registration-copy">Isi data peserta dengan teliti. Setelah berhasil, nama peserta akan langsung masuk ke daftar pendaftaran.</p>
        </div>

        <form class="registration-card registration-form" action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

           @if ($errors->any())
    <div class="error-alert">
        <strong>Pendaftaran belum berhasil. Berikut penyebabnya:</strong>

        <ul style="margin-top: 10px; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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

            
<!-- EMAIL DAN NOMOR WHATSAPP ORANG TUA -->
<div class="form-grid">

    <label class="form-field">
        Email Orang Tua
        <input
            class="form-control"
            type="email"
            name="email_orangtua"
            value="{{ old('email_orangtua') }}"
            placeholder="Contoh: nama@email.com"
            autocomplete="email"
            required
        >
        @error('email_orangtua')
            <small>{{ $message }}</small>
        @enderror
    </label>

    <label class="form-field">
        Nomor WhatsApp Orang Tua
        <input
            class="form-control"
            type="tel"
            name="no_hp_orangtua"
            value="{{ old('no_hp_orangtua') }}"
            placeholder="Contoh: 081234567890"
            autocomplete="tel"
            required
        >
        @error('no_hp_orangtua')
            <small>{{ $message }}</small>
        @enderror
    </label>

</div>


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

    <div class="ticket-page">

        <p class="ticket-section-title">PEMBAYARAN FAC SERIES II</p>

        <!-- JUDUL PEMBELIAN TIKET -->
        <div class="ticket-heading">

            <div class="ticket-cart-icon">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
            </div>

            <div class="ticket-heading-text">
                <h2>Pembelian Tiket Lomba</h2>
                <p>
                    Pendaftaran telah berhasil! Silakan lanjutkan pembelian
                    tiket lomba melalui salah satu pilihan berikut.
                </p>
            </div>

        </div>

        <!-- EARLY BIRD -->
        <div class="ticket-card ticket-early">

            <div class="ticket-symbol">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2a3 3 0 0 0 0 8v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2a3 3 0 0 0 0-8Z"/>
                    <path d="m12 8 1.2 2.4 2.8.4-2 2 .5 2.8-2.5-1.3-2.5 1.3.5-2.8-2-2 2.8-.4L12 8Z"/>
                </svg>
            </div>

            <div class="ticket-information">

                <div class="ticket-title-row">
                    <h3>Early Bird</h3>
                    <span class="ticket-label">Harga Spesial</span>
                </div>

                <p class="ticket-period">
                    ▦ Berlaku 5 November – 24 November
                </p>

                <ul>
                    <li>1 Nomor Perlombaan <span>: Rp 180.000</span></li>
                    <li>2 Nomor Perlombaan <span>: Rp 305.000</span></li>
                    <li>3 Nomor Perlombaan <span>: Rp 380.000</span></li>
                </ul>

            </div>

            <div class="ticket-checkout">
    <a href="https://lynk.id/funaquaticswimschool/1r1ozwl86zv8/checkout"
   target="_blank"
   rel="noopener noreferrer"
   class="ticket-checkout-button">
    <span>↗</span>
    Daftar Sekarang
    <span>→</span>
</a>
</div>

        </div>

        <!-- NORMAL -->
        <div class="ticket-card ticket-normal">

            <div class="ticket-symbol">
                <svg viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2a3 3 0 0 0 0 8v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2a3 3 0 0 0 0-8Z"/>
                    <path d="m12 8 1.2 2.4 2.8.4-2 2 .5 2.8-2.5-1.3-2.5 1.3.5-2.8-2-2 2.8-.4L12 8Z"/>
                </svg>
            </div>

            <div class="ticket-information">

                <div class="ticket-title-row">
                    <h3>Normal</h3>
                    <span class="ticket-label">Harga Reguler</span>
                </div>

                <p class="ticket-period">
                    ▦ Berlaku 25 November – 10 Januari
                </p>

                <ul>
                    <li>1 Nomor Perlombaan <span>: Rp 210.000</span></li>
                    <li>2 Nomor Perlombaan <span>: Rp 335.000</span></li>
                    <li>3 Nomor Perlombaan <span>: Rp 410.000</span></li>
                </ul>

            </div>

            <div class="ticket-checkout">
    <a href="https://lynk.id/funaquaticswimschool/m760nwppzwgl/checkout"
   target="_blank"
   rel="noopener noreferrer"
   class="ticket-checkout-button">
    <span>↗</span>
    Daftar Sekarang
    <span>→</span>
</a>
</div>

        </div>

        <!-- CATATAN -->
        <div class="ticket-information-note">

            <div class="note-icon">i</div>

            <div>
                <strong>Catatan:</strong>

                <ul>
                    <li>Pembayaran dilakukan melalui platform Lynk.id.</li>
                    <li>Pastikan Anda memilih kategori tiket yang sesuai.</li>
                    <li>Setelah pembayaran berhasil, simpan bukti transaksi sebagai konfirmasi.</li>
                </ul>
            </div>

        </div>

    </div>

    <!-- ==================================
         KODE LAMA - JANGAN DIHAPUS
         ================================== -->

    <label class="form-field">Upload Bukti Pendaftaran
        <input class="form-control file-control" type="file" name="bukti_pembayaran" accept="image/*" required>
        <span class="text-sm font-semibold text-slate-500">Wajib, maksimal 2MB.</span>
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
