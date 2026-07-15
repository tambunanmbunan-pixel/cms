<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Hanah Admin Dashboard</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- start script -->
        @include('admin.layout.scripts')
        <!-- end script -->
         <!-- start style -->
        @include('admin.layout.styles')
        <!-- end style -->
    </head>
    <body class="bg-background font-body-md text-on-surface">
        <!-- SideNavBar -->
        @include('admin.layout.sidebar')
        <!-- header -->
        @include('admin.layout.header')
        <!-- Main Canvas -->
        @yield('content')
        <!-- footer -->
        @include('admin.layout.footer')
        <script>
            // Micro-interactions and interactive elements
            document.querySelectorAll('.elevation-1').forEach(card => {
              card.addEventListener('mouseenter', () => {
                card.style.boxShadow = '0px 12px 32px rgba(30, 45, 61, 0.12)';
              });
              card.addEventListener('mouseleave', () => {
                card.style.boxShadow = '0px 4px 20px rgba(30, 45, 61, 0.05)';
              });
            });
            
            // Mock search interaction
            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener('focus', () => {
              searchInput.parentElement.parentElement.classList.add('scale-[1.02]');
              searchInput.parentElement.parentElement.classList.add('transition-transform');
            });
            searchInput.addEventListener('blur', () => {
              searchInput.parentElement.parentElement.classList.remove('scale-[1.02]');
            });
        </script>
        <script>
            const profileBtn = document.getElementById('profileBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');

            // Toggle dropdown saat tombol profil diklik
            profileBtn.addEventListener('click', () => {
                dropdownMenu.classList.toggle('hidden');
            });

            // Menutup dropdown jika klik di luar area
            window.addEventListener('click', (e) => {
                if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        </script>
    </body>
</html>