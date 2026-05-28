<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fun Aquatic')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
    <header class="fa-header">
        <div class="fa-nav-wrap">
            <button class="fa-menu-button" type="button" aria-controls="site-menu" aria-expanded="false" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="site-menu" class="fa-nav">
                <ul class="fa-nav-list">
                    <li><a class="fa-nav-link" href="{{ route('home') }}">Home</a></li>
                    <li><a class="fa-nav-link" href="{{ route('about') }}">About</a></li>
                    <li><a class="fa-nav-link" href="{{ route('registrations.rules') }}">Pendaftaran</a></li>
                    <li><a class="fa-nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer class="bg-slate-950 px-6 py-7 text-center text-sm font-semibold text-white">
        <p>&copy; {{ date('Y') }} Fun Aquatic</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.fa-menu-button');
        const siteNav = document.querySelector('.fa-nav');

        menuToggle?.addEventListener('click', () => {
            const isOpen = !siteNav.classList.contains('is-open');
            siteNav.classList.toggle('is-open', isOpen);
            menuToggle.classList.toggle('is-open', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            menuToggle.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        });
    </script>
    @stack('scripts')
</body>
</html>
