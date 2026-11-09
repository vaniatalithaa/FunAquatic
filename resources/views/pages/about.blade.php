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

    <p>Fun Aquatic Competition Series 3 merupakan ajang kompetisi renang yang diselenggarakan oleh Fun Aquatic sebagai wadah bagi para perenang untuk mengembangkan kemampuan, meningkatkan kepercayaan diri, serta membangun semangat sportivitas dan kebersamaan. Melanjutkan semangat dari series sebelumnya, Fun Aquatic Competition Series 3 tidak hanya berfokus pada kompetisi olahraga, tetapi juga membawa misi sosial melalui kampanye Breast Cancer Awareness.</p>

    <p>Fun Aquatic Competition Series 3 mengajak seluruh peserta dan masyarakat untuk meningkatkan kesadaran akan pentingnya menjaga kesehatan, mengenali risiko kanker payudara, serta mendukung pentingnya deteksi dini. Melalui perpaduan antara olahraga dan kepedulian sosial, acara ini diharapkan dapat menjadi ruang bagi komunitas untuk berkompetisi, saling mendukung, dan menyebarkan pesan positif yang bermakna.</p>

    <p>Dengan semangat <em>"Every Stroke Makes a Difference"</em>, setiap kayuhan dalam kompetisi ini menjadi simbol bahwa olahraga dapat menjadi lebih dari sekadar pencapaian prestasi, tetapi juga sarana untuk menumbuhkan kepedulian dan memberikan dampak positif bagi sesama.</p>
</article>

            </div>

            <div class="about-quote-panel">
                <p>"Acara ini telah sukses dilaksanakan setiap tahunnya sejak 2024 dan telah memberikan dampak positif bagi banyak peserta."</p>
            </div>
        </section>

        <section class="about-video-section">
            <h2>FAC <span>Series 2</span></h2>
            <div class="about-video-frame">
                <video controls autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/videos/priview-event.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>
        </section>
    </div>
</main>
@endsection
