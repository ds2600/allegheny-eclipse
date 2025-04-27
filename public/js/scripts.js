/**
 * scripts.js
 * Handles interactivity for Allegheny Eclipse website:
 * - Hamburger menu toggle for mobile navigation
 * - Smooth scrolling for navbar links
 * - Basic client-side form validation
 */

// Hamburger Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const heroLogo = document.querySelector('.hero-logo');
    const origZIndex = getComputedStyle(heroLogo).zIndex;

    navToggle.addEventListener('click', () => {
        navToggle.classList.toggle('active');
        navMenu.classList.toggle('active');

        if (navMenu.classList.contains('active')) {
            heroLogo.style.zIndex = 100; 
        } else {
            heroLogo.style.zIndex = origZIndex; 
        }
    });

    // Close menu when a link is clicked (mobile)
    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            heroLogo.style.zIndex = origZIndex; 
        });
    });
});

// Smooth Scrolling for Navbar Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 60, // Adjust for fixed navbar height
                behavior: 'smooth'
            });
        }
    });
});

// Contact Form Validation
document.querySelector('.contact-form').addEventListener('submit', function (e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const comments = document.getElementById('comments').value.trim();
    let isValid = true;

    // Basic validation
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
        e.preventDefault(); // Prevent form submission if validation fails
    }
});
