document.addEventListener('DOMContentLoaded', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuToggle = document.getElementById('menu-toggle');

    function updateMenuVisibility() {
        if (window.innerWidth >= 1024) {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('max-h-40', 'max-h-0');
        } else {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('max-h-40', 'max-h-0');
        }
    }

    menuToggle.addEventListener('click', function() {
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('max-h-0');
                mobileMenu.classList.add('max-h-40');
            }, 10);
        } else {
            mobileMenu.classList.remove('max-h-40');
            mobileMenu.classList.add('max-h-0');
            mobileMenu.addEventListener('transitionend', () => {
                mobileMenu.classList.add('hidden');
            }, {
                once: true
            });
        }
    });

    window.addEventListener('resize', updateMenuVisibility);

    updateMenuVisibility();
});