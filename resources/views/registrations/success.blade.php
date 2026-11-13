
@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - Fun Aquatic')

@section('content')

<main class="registration-page">

    <div style="
        max-width: 850px;
        margin: 80px auto;
        padding: 20px;
    ">

        <section style="
            background: white;
            padding: 55px 35px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        ">

            <div style="
                width: 85px;
                height: 85px;
                margin: 0 auto 25px;
                border-radius: 50%;
                background: #e8f8ef;
                color: #159653;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 48px;
                font-weight: bold;
            ">
                ✓
            </div>

            <p style="
                color: #f06292;
                font-weight: 800;
                letter-spacing: 3px;
                margin-bottom: 12px;
            ">
                FUN AQUATIC COMPETITION SERIES III
            </p>

            <h1 style="
                color: #10233f;
                font-size: clamp(28px, 5vw, 42px);
                font-weight: 900;
                margin-bottom: 18px;
            ">
                PENDAFTARAN BERHASIL!
            </h1>

            <p style="
                color: #64748b;
                font-size: 17px;
                line-height: 1.8;
                max-width: 650px;
                margin: 0 auto 18px;
            ">
                Terima kasih telah mendaftar di Fun Aquatic Competition Series III.
                Data peserta dan bukti pembayaran Anda berhasil dikirim.
            </p>

            <p style="
                color: #64748b;
                font-size: 15px;
                line-height: 1.8;
                margin-bottom: 32px;
            ">
                Selanjutnya, panitia Fun Aquatic akan melakukan pemeriksaan
                dan verifikasi data pendaftaran Anda.
                Mohon simpan bukti pembayaran sebagai konfirmasi.
            </p>

            <a href="{{ route('home') }}" style="
                display: inline-block;
                width: 100%;
                max-width: 400px;
                padding: 18px 25px;
                border-radius: 12px;
                background: linear-gradient(110deg, #ed4f9a, #247bd7);
                color: white;
                text-decoration: none;
                font-weight: 800;
                text-align: center;
            ">
                KEMBALI KE BERANDA →
            </a>

        </section>

    </div>

</main>

@endsection
