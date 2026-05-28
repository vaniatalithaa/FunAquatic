@extends('layouts.app')

@section('title', 'About - Fun Aquatic')

@section('content')
<main class="page-band">
    <div class="container">
        <div class="section-heading">
            <h1>About <span></span></h1>
        </div>

        <div class="info-grid">
            <article class="panel panel-red">
                <h2><span class="panel-icon">~</span>Fun Aquatic ⁠Swimschool</h2>
                <p>Fun Aquatic adalah tempat les renang yang berfokus pada pengenalan <em>water safety</em> sejak dini serta membantu anak mengatasi rasa takut terhadap air. Dengan pendekatan yang menggabungkan teknik dan aspek psikologis, kami menciptakan metode pembelajaran yang aman, menyenangkan, dan sesuai dengan kebutuhan setiap anak.</p>
                <p>Melalui lingkungan belajar yang suportif, Fun Aquatic berkomitmen membangun rasa percaya diri anak di dalam air sebagai fondasi untuk mengembangkan kemampuan berenang secara optimal.</p>
            </article>

            <article class="panel panel-blue">
                <h2><span class="panel-icon">#</span>The Competition</h2>
                <p>Fun Aquatic Competition: Series II merupakan acara yang diselenggarakan oleh Fun Aquatic Swim School bekerja sama dengan Pakuwon Golf & Family Club.</p>
                <p>Acara ini merupakan kompetisi renang rekreasi antar klub dan komunitas renang se-Surabaya dengan hadiah berupa piala, medali finisher, dan gips acrylic. Selain menjadi ajang unjuk prestasi, kegiatan ini juga dirancang untuk melatih mental, sportivitas, dan rasa percaya diri peserta.</p>
            </article>
        </div>

        <div class="about-quote">
            <p>"Acara ini telah sukses dilaksanakan setiap tahunnya sejak 2024 dan telah memberikan dampak positif bagi banyak peserta."</p>
        </div>

        <section class="moments">
            <div class="section-heading compact">
                <h2>FAC <span>Series 1</span></h2>
            </div>
            <div class="preview-video">
    <video controls width="100%" autoplay muted loop preload="metadata">
        
        <source src="{{ asset('assets/videos/preview-event.mp4') }}" type="video/mp4">

        Browser Anda tidak mendukung pemutar video.
    </video>
</div>
            </div>
        </section>
    </div>
</main>
@endsection
