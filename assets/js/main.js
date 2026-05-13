// main.js — Gold Pe Cash

document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    // ── Mobile Menu Toggle ─────────────────────────────
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', function () {
            this.classList.toggle('active');
            navLinks.classList.toggle('active');
            // Prevent body scroll when menu is open
            document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
        });

        // Close menu on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992 && navLinks.classList.contains('active')) {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Close menu when clicking a link
    const mobileNavItems = document.querySelectorAll('.nav-links > li > a:not(.dropdown-toggle)');
    mobileNavItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 992 && hamburger && navLinks) {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // ── FAQ Accordion ──────────────────────────────────
    document.querySelectorAll('.faq-question').forEach(function (question) {
        question.addEventListener('click', function () {
            const item = this.parentElement;
            document.querySelectorAll('.faq-item').forEach(function (el) {
                if (el !== item) el.classList.remove('active');
            });
            item.classList.toggle('active');
        });
    });

    // ── Header scroll effect — transparent → solid ────
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
