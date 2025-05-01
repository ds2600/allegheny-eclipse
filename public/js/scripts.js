/**
 * scripts.js
 * Handles interactivity for Allegheny Eclipse website:
 * - Hamburger menu toggle for mobile navigation
 * - Smooth scrolling for navbar links
 * - Basic client-side form validation
 * - Dropdown menu toggle for mobile
 */

document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const heroLogo = document.querySelector('.hero-logo');
    const origZIndex = heroLogo ? getComputedStyle(heroLogo).zIndex : null;

    navToggle.addEventListener('click', () => {
        navToggle.classList.toggle('active');
        navMenu.classList.toggle('active');

        if (heroLogo) {
            if (navMenu.classList.contains('active')) {
                heroLogo.style.zIndex = 100;
            } else {
                heroLogo.style.zIndex = origZIndex;
            }
        }
    });

    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            if (heroLogo) {
                heroLogo.style.zIndex = origZIndex;
            }
        });
    });

    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const parent = toggle.parentElement;
                const isActive = parent.classList.contains('active');
                
                document.querySelectorAll('.dropdown').forEach(d => {
                    d.classList.remove('active');
                });
                
                if (!isActive) {
                    parent.classList.add('active');
                }
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(e.target) && !e.target.closest('.nav-toggle')) {
                    dropdown.classList.remove('active');
                }
            });
        }
    });
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 60,
                behavior: 'smooth'
            });
        }
    });
});

document.querySelector('.contact-form')?.addEventListener('submit', function (e) {
    const name = document.getElementById('name')?.value.trim();
    const email = document.getElementById('email')?.value.trim();
    const comments = document.getElementById('comments')?.value.trim();
    let isValid = true;

    if (!name) {
        isValid = false;
        alert('Please enter your name.');
    }

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        isValid = false;
        alert('Please enter a valid email address.');
    }

    if (!comments) {
        isValid = false;
        alert('Please enter your comments.');
    }

    if (!isValid) {
        e.preventDefault();
    }
});
