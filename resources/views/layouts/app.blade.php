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
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrapper">
            <button class="menu-toggle" type="button" aria-controls="site-menu" aria-expanded="false" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav id="site-menu" class="site-nav">
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('registrations.rules') }}">Pendaftaran</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content')

    <footer>
        <p>&copy; {{ date('Y') }} Fun Aquatic</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const siteNav = document.querySelector('.site-nav');

        menuToggle?.addEventListener('click', () => {
            const isOpen = siteNav.classList.toggle('is-open');
            menuToggle.classList.toggle('is-open', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            menuToggle.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
        });
    </script>
    @stack('scripts')
</body>
</html>
