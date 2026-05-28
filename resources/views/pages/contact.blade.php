@extends('layouts.app')

@section('title', 'Contact - Fun Aquatic')

@section('content')
<main class="page-band contact-wish-page">
    <div class="container narrow">
        <div class="wish-heading">
            <h1>Contact</h1>
            <p>Berikan pertanyaan untuk Fun Aquatic Competition.</p>
        </div>

        <section class="wish-board">
            <h2><span id="wishCount">0</span> Pesan</h2>

            <form class="wish-form" id="wishForm">
                <input type="text" id="wishName" name="name" placeholder="Nama" required>
                <textarea id="wishMessage" name="message" rows="4" placeholder="Pesan" required></textarea>
                <button class="button wish-submit" type="submit">Kirim</button>
            </form>

            <div class="wish-list" id="wishList" aria-live="polite"></div>

            <div class="wish-pagination" id="wishPagination"></div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const wishForm = document.getElementById('wishForm');
    const wishName = document.getElementById('wishName');
    const wishMessage = document.getElementById('wishMessage');
    const wishList = document.getElementById('wishList');
    const wishCount = document.getElementById('wishCount');
    const wishPagination = document.getElementById('wishPagination');
    const storageKey = 'funAquaticContactWishes';
    const pageSize = 2;
    let currentPage = 1;

    const defaultWishes = [
        {
            name: 'Admin Fun Aquatic',
            message: 'Halo, silakan tinggalkan pertanyaan mengenai pendaftaran, jadwal, atau informasi kompetisi.',
            createdAt: Date.now() - 1000 * 60 * 60 * 24,
        },
        {
            name: 'Arif',
            message: 'Semoga acaranya lancar dan seru.',
            createdAt: Date.now() - 1000 * 60 * 60 * 6,
        },
    ];

    function getWishes() {
        const stored = localStorage.getItem(storageKey);

        if (!stored) {
            localStorage.setItem(storageKey, JSON.stringify(defaultWishes));
            return defaultWishes;
        }

        return JSON.parse(stored);
    }

    function saveWishes(wishes) {
        localStorage.setItem(storageKey, JSON.stringify(wishes));
    }

    function formatTime(timestamp) {
        const diff = Math.max(1, Math.floor((Date.now() - timestamp) / 60000));

        if (diff < 60) {
            return `${diff} menit lalu`;
        }

        const hours = Math.floor(diff / 60);

        if (hours < 24) {
            return `${hours} jam lalu`;
        }

        return `${Math.floor(hours / 24)} hari lalu`;
    }

    function escapeHtml(value) {
        return value
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function renderWishes() {
        const wishes = getWishes();
        const totalPages = Math.max(1, Math.ceil(wishes.length / pageSize));
        currentPage = Math.min(currentPage, totalPages);
        const start = (currentPage - 1) * pageSize;
        const pageItems = wishes.slice(start, start + pageSize);

        wishCount.textContent = wishes.length;
        wishList.innerHTML = pageItems.map((wish) => `
            <article class="wish-item">
                <div class="wish-avatar">${escapeHtml(wish.name.charAt(0).toUpperCase())}</div>
                <div class="wish-content">
                    <h3>${escapeHtml(wish.name)}</h3>
                    <p>${escapeHtml(wish.message)}</p>
                    <div class="wish-meta">
                        <span>${formatTime(wish.createdAt)}</span>
                        <button type="button" data-reply="${escapeHtml(wish.name)}">Reply</button>
                    </div>
                </div>
            </article>
        `).join('');

        wishPagination.innerHTML = `
            <button type="button" ${currentPage === 1 ? 'disabled' : ''} data-page="${currentPage - 1}">Previous</button>
            ${Array.from({ length: totalPages }, (_, index) => {
                const page = index + 1;
                return `<button type="button" class="${page === currentPage ? 'active' : ''}" data-page="${page}">${page}</button>`;
            }).join('')}
            <button type="button" ${currentPage === totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Next</button>
        `;
    }

    wishForm?.addEventListener('submit', (event) => {
        event.preventDefault();

        const wishes = getWishes();
        wishes.unshift({
            name: wishName.value.trim(),
            message: wishMessage.value.trim(),
            createdAt: Date.now(),
        });

        saveWishes(wishes);
        wishForm.reset();
        currentPage = 1;
        renderWishes();
    });

    wishPagination?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-page]');

        if (!button || button.disabled) {
            return;
        }

        currentPage = Number(button.dataset.page);
        renderWishes();
    });

    wishList?.addEventListener('click', (event) => {
        const button = event.target.closest('button[data-reply]');

        if (!button) {
            return;
        }

        wishMessage.value = `@${button.dataset.reply} `;
        wishMessage.focus();
    });

    renderWishes();
</script>
@endpush
