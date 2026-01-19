/**
 * scripts.js
 * Handles interactivity for Allegheny Eclipse website:
 * - Hamburger menu toggle for mobile navigation
 * - Smooth scrolling for navbar links
 * - Basic client-side form validation
 * - Dropdown menu toggle for mobile
 * - Lightbox functionality for gallery images
 * - Asynchronous form submission with feedback
 */


function hideForm(form, message, durationSeconds = 10, formType) {
    const formWrapper = document.createElement('div');
    formWrapper.className = 'form-wrapper';

    if (!form.parentElement.classList.contains('form-wrapper')) {
        form.parentElement.insertBefore(formWrapper, form);
        formWrapper.appendChild(form);
    } else {
        formWrapper = form.parentElement;
    }
        
    if (formType === 'sign_up_list') {
    message = `
      Thank you for signing up! 
      <p>Please download and complete the below forms and email them to <a href="mailto:alleghenyeclipse2025@gmail.com">alleghenyeclipse2025@gmail.com</a>.</p>
      <p><a href="https://docs.google.com/document/d/1bfpoSzo1R7sSa-K5AkKA5yot0M7n6xq-1Lhvw4MrI5w/edit?usp=sharing" target="_blank" rel="noopener">Injury Policy</a></p>
      <p><a href="https://docs.google.com/document/d/1EbVtjESpyJDUIO1r5wyMuMvb-XW8pPqoL3o8ZeGOW30/edit?usp=sharing" target="_blank" rel="noopener">AE Guidelines</a></p>
    `;
    }

    const messageDiv = document.createElement('div');
    messageDiv.className = 'form-message';
    messageDiv.innerHTML = message;

    form.style.display = 'none';
    formWrapper.appendChild(messageDiv);
    
    if (formType !== 'sign_up_list') {
        setTimeout(() => {
            messageDiv.remove();
            form.style.display = '';
        }, durationSeconds * 1000);
    }
}


function handleAsyncForm(formSelector, formMessage) {
  document.querySelectorAll(formSelector).forEach(form => {
    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(form);
      const formType = formData.get('type');
      try {
        const res = await fetch(form.action, {
          method: 'POST',
          body: formData
        });
        console.log(formType);
        const elements = form.querySelectorAll('input, textarea, button, select');
        elements.forEach(el => el.disabled = true);

        const data = await res.json();
        if (data.success) {
            toastr.success(data.message || 'Success!');
            form.reset();
            elements.forEach(el => el.disabled = false);
            hideForm(form, formMessage, 10, formType);
        } else {
            toastr.error(data.message || 'Something went wrong.');
            elements.forEach(el => el.disabled = false);
        }

      } catch (err) {
          toastr.error('Network error.');
          elements.forEach(el => el.disabled = false);
      }
      if (typeof turnstile !== 'undefined') {
          turnstile.reset();
      }
    });
  });
}


document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const heroLogo = document.querySelector('.hero-logo');
    const origZIndex = heroLogo ? getComputedStyle(heroLogo).zIndex : null;

    navToggle.addEventListener('click', () => {
        navToggle.classList.toggle('active');
        navMenu.classList.toggle('active');

        if (heroLogo) {
              heroLogo.style.zIndex = navMenu.classList.contains('active') ? 100 : origZIndex;
        }
    });

    navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            if (heroLogo) heroLogo.style.zIndex = origZIndex;
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

    handleAsyncForm('form.contact-form', 'Thank you for your message! We will get back to you soon.');
    handleAsyncForm('form.register-form', 'Thank you for registering! We will reach out to you for confirmation soon!');
    handleAsyncForm('form.signup-form', 'Thank you for signing up!');
});

// document.querySelector('.contact-form')?.addEventListener('submit', function (e) {
//     const name = document.getElementById('name')?.value.trim();
//     const email = document.getElementById('email')?.value.trim();
//     const comments = document.getElementById('comments')?.value.trim();
//     let isValid = true;

//     if (!name) {
//         isValid = false;
//         alert('Please enter your name.');
//     }

//     if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
//         isValid = false;
//         alert('Please enter a valid email address.');
//     }

//     if (!comments) {
//         isValid = false;
//         alert('Please enter your comments.');
//     }

//     if (!isValid) {
//         e.preventDefault();
//     }
// });

// Lightbox Functionality
const galleryImages = document.querySelectorAll('.gallery-img');
const lightbox = document.createElement('div');
lightbox.className = 'lightbox';
document.body.appendChild(lightbox);

const lightboxImg = document.createElement('img');
lightboxImg.className = 'lightbox-img';
lightbox.appendChild(lightboxImg);

const lightboxClose = document.createElement('span');
lightboxClose.className = 'lightbox-close';
lightboxClose.innerHTML = '&times;';
lightbox.appendChild(lightboxClose);

galleryImages.forEach(img => {
    img.addEventListener('click', () => {
        lightboxImg.src = img.dataset.large || img.src;
        lightbox.style.display = 'flex';
    });
});

lightboxClose.addEventListener('click', () => {
    lightbox.style.display = 'none';
});

lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
        lightbox.style.display = 'none';
    }
});
