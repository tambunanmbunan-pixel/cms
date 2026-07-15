<style>
    /* 1. Global Base Styles */
    body {
        background-color: #f4fbf9;
        color: #161d1c;
    }

    /* 2. Custom Layout Utilities */
    .glass-nav {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .luxury-shadow {
        box-shadow: 0px 4px 20px rgba(37, 57, 77, 0.05);
    }

    .transition-standard {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* 3. Material Icons (Gunakan ketebalan 300 yang seimbang untuk semua halaman) */
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }

    /* 4. Glassmorphism Kustom & Utilities Milik Halaman Detail */
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>