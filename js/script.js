document.addEventListener('DOMContentLoaded', function() {
    // Sticky navigation on scroll
    const nav = document.querySelector('.main-nav');
    const navOffset = nav.offsetTop;
    
    window.addEventListener('scroll', function() {
        if (window.scrollY >= navOffset) {
            nav.classList.add('sticky');
            document.body.style.paddingTop = nav.offsetHeight + 'px';
        } else {
            nav.classList.remove('sticky');
            document.body.style.paddingTop = 0;
        }
    });
    
    // Current date in the header
    const currentDate = document.querySelector('.date');
    if (currentDate) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        currentDate.textContent = now.toLocaleDateString('es-ES', options);
    }
    
    // Image gallery functionality
    const galleryItems = document.querySelectorAll('.gallery-icon');
    galleryItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const parentItem = this.closest('.multimedia-item');
            const link = parentItem.querySelector('a');
            if (link) {
                window.location.href = link.getAttribute('href');
            }
        });
    });
    
    // Video play functionality
    const videoItems = document.querySelectorAll('.play-icon');
    videoItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const parentItem = this.closest('.multimedia-item');
            const link = parentItem.querySelector('a');
            if (link) {
                window.location.href = link.getAttribute('href');
            }
        });
    });
    
    // Audio play functionality
    const audioItems = document.querySelectorAll('.audio-icon');
    audioItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const parentItem = this.closest('.multimedia-item');
            const link = parentItem.querySelector('a');
            if (link) {
                window.location.href = link.getAttribute('href');
            }
        });
    });
    
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav ul');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('show');
            this.classList.toggle('active');
        });
    }
    
    // Search form validation
    const searchForm = document.querySelector('.search-bar form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input');
            if (searchInput.value.trim() === '') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }
    
    // Newsletter form validation
    const newsletterForm = document.querySelector('.newsletter form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            const emailInput = this.querySelector('input[type="email"]');
            if (emailInput.value.trim() === '') {
                e.preventDefault();
                emailInput.focus();
            }
        });
    }
}); 