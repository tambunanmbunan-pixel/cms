<!DOCTYPE html>
<html class="scroll-smooth" lang="en" style="">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Hanah | Luxury Fragrance Ecosystem</title>
        @include('front.layout.scripts')
        @include('front.layout.styles')
    </head>
    <body class="font-body-md text-body-md selection:bg-secondary-container selection:text-white">
        <!-- Top Navigation Bar -->
        @include('front.layout.header')
        @yield('content')
        <!-- Footer -->
        @include('front.layout.footer')
    </body>
</html>