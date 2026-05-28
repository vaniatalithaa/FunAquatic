@extends('layouts.app')

@section('title', 'About - Fun Aquatic')

@section('content')
<main class="about-page">
    <div class="about-container">
        <section class="about-intro">
            <h1>About</h1>

            <div class="about-grid">
                <article class="about-panel about-panel-red">
                    <h2><span>~</span> Fun Aquatic Swimschool</h2>
                    <p>Fun Aquatic adalah tempat les renang yang berfokus pada pengenalan <em>water safety</em> sejak dini serta membantu anak mengatasi rasa takut terhadap air.</p>
                    <p>Dengan pendekatan yang menggabungkan teknik dan aspek psikologis, kami menciptakan metode pembelajaran yang aman, menyenangkan, dan sesuai dengan kebutuhan setiap anak.</p>
                    <p>Melalui lingkungan belajar yang suportif, Fun Aquatic berkomitmen membangun rasa percaya diri anak di dalam air sebagai fondasi untuk mengembangkan kemampuan berenang secara optimal.</p>
                </article>

                <article class="about-panel about-panel-purple">
                    <h2><span>#</span> The Competition</h2>
                    <p>Fun Aquatic Competition Series II merupakan acara yang diselenggarakan oleh Fun Aquatic Swim School bekerja sama dengan Pakuwon Golf & Family Club.</p>
                    <p>Acara ini merupakan kompetisi renang rekreasi antar klub dan komunitas renang se-Surabaya dengan hadiah berupa piala, medali finisher, dan gips acrylic.</p>
                    <p>Selain menjadi ajang unjuk prestasi, kegiatan ini juga dirancang untuk melatih mental, sportivitas, dan rasa percaya diri peserta.</p>
                </article>
            </div>

            <div class="about-quote-panel">
                <p>"Acara ini telah sukses dilaksanakan setiap tahunnya sejak 2024 dan telah memberikan dampak positif bagi banyak peserta."</p>
            </div>
        </section>

        <section class="about-video-section">
            <h2>FAC <span>Series 1</span></h2>
            <div class="about-video-frame">
                <video controls autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/videos/preview-event.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>
        </section>
    </div>
</main>
@endsection
