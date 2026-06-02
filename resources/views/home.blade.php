<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Hanah | Sensorial Excellence</title>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet">
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#1E2D3D", // Deep Ocean Navy
                    "secondary": "#FF6B35", // Vibrant Tangerine (CTA)
                    "tertiary": "#028090", // Cool Mint Teal
                    "background": "#EDF4F2", // Soft Fresh Ice
                    "on-surface": "#1E2D3D",
                    "on-surface-variant": "#394859",
                    "outline": "#1E2D3D",
                    "outline-variant": "rgba(30, 45, 61, 0.1)",
                    "surface": "#EDF4F2",
                    "surface-container": "#DDE7E4",
                    "surface-container-low": "#E5EEEC",
                    "surface-container-lowest": "#F2F8F6",
                    "on-primary": "#FFFFFF",
                    "on-secondary": "#FFFFFF",
                    "on-tertiary": "#FFFFFF"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "margin-mobile": "20px",
                    "container-max": "1280px",
                    "gutter": "24px",
                    "section-gap": "120px",
                    "element-gap": "32px",
                    "margin-desktop": "64px"
            },
            "fontFamily": {
                    "body-sm": ["DM Sans"],
                    "headline-sm": ["Playfair Display"],
                    "headline-lg": ["Playfair Display"],
                    "headline-md": ["Playfair Display"],
                    "display-lg": ["Playfair Display"],
                    "label-md": ["DM Sans"],
                    "display-lg-mobile": ["Playfair Display"],
                    "body-lg": ["DM Sans"],
                    "body-md": ["DM Sans"],
                    "headline-lg-mobile": ["Playfair Display"]
            },
            "fontSize": {
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "headline-sm": ["24px", {"lineHeight": "32px", "fontWeight": "500"}],
                    "headline-lg": ["40px", {"lineHeight": "48px", "fontWeight": "600"}],
                    "headline-md": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                    "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "display-lg-mobile": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .glass {
            background: rgba(237, 244, 242, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(30, 45, 61, 0.1);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        .hero-gradient {
            background: radial-gradient(circle at center, transparent 0%, #EDF4F2 100%);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #1E2D3D20; border-radius: 10px; }
        .parallax-target { transform: translateZ(0); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spin-slow 20s linear infinite; }
    </style>
</head>
<body class="bg-background text-primary font-body-md selection:bg-secondary selection:text-white">
<!-- TopNavBar -->
<header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-xl border-b border-primary/10 shadow-sm">
<nav class="flex justify-between items-center h-20 px-margin-desktop max-w-container-max mx-auto">
<div class="flex items-center gap-element-gap">
<a class="font-headline-md text-headline-md font-bold text-primary tracking-tight" href="#">Hanah</a>
<div class="hidden md:flex items-center gap-8">
<a class="text-secondary font-semibold border-b-2 border-secondary font-body-md text-body-md" href="#">Shop</a>
<a class="text-primary hover:text-secondary transition-colors font-body-md text-body-md" href="#">Bundles</a>
<a class="text-primary hover:text-secondary transition-colors font-body-md text-body-md" href="#">About</a>
<a class="text-primary hover:text-secondary transition-colors font-body-md text-body-md" href="#">Blog</a>
</div>
</div>
<div class="flex items-center gap-6">
<div class="relative hidden lg:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-primary/50">search</span>
<input class="bg-surface-container-low border-none rounded-full pl-10 pr-4 py-2 text-body-sm w-64 focus:ring-1 focus:ring-secondary/30 transition-all text-primary" placeholder="Search fragrances..." type="text">
</div>
<div class="flex items-center gap-4">
<button class="hover:bg-primary/5 transition-all duration-300 p-2 rounded-full scale-95 active:scale-100">
<span class="material-symbols-outlined text-primary">shopping_bag</span>
</button>
<button class="hover:bg-primary/5 transition-all duration-300 p-2 rounded-full scale-95 active:scale-100">
<span class="material-symbols-outlined text-primary">person</span>
</button>
</div>
</div>
</nav>
</header>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[921px] overflow-hidden flex items-center bg-background">
<div class="absolute inset-0 z-0">
<img alt="Hanah Luxury Fragrance" class="w-full h-full object-cover opacity-90 transition-transform duration-[10s] hover:scale-105" data-alt="A high-end luxury perfume bottle crafted from heavy faceted glass, resting on a cool marble surface with soft, fresh daylight streaming through a nearby window. The lighting is bright and ethereal, casting delicate prismatic reflections across a minimalist background of neutral tones. The scene is airy and sophisticated, echoing a modern light-mode editorial aesthetic with a palette of whites, soft greys, and clear glass." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA9rrkGBFcJp0iQB-HS47y2wRQ_Y6KWvKgusKgFV1xulbia-F17U5zNO2ZRkGiNW2DofcaSp4GQ70YWFE11L8NJCNKL5EwW5Y68U3e_RUkcn6SurZhTuwx8AyfmgDuPJrkM1WF1VQdrubn_jHlrmkPw6HQmxQODrAIzp_ODI-MitFnfDjjiBqhPuJ-bTVWujWjj4v0zL4pYQdNpEGSjL2xNTWabN11pJLgLLNUZW6Yo_ZPQF9kwVjiViPeFSvh7GvphwqicejHfdgQ5">
<div class="absolute inset-0 hero-gradient"></div>
</div>
<div class="container max-w-container-max mx-auto px-margin-desktop relative z-10">
<div class="max-w-2xl space-y-6">
<span class="font-label-md text-label-md text-tertiary tracking-widest uppercase block">L'Essence de la Joie</span>
<h1 class="font-display-lg text-display-lg text-primary leading-none">Happiness in Every Note</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg">
                        Discover a curated collection of scents designed to evoke memory, emotion, and the purest form of sensorial satisfaction.
                    </p>
<div class="flex gap-4 pt-4">
<button class="bg-secondary text-white px-8 py-4 rounded-full font-label-md text-label-md hover:shadow-lg hover:shadow-secondary/20 transition-all transform active:scale-95">Shop Now</button>
<button class="border border-primary text-primary px-8 py-4 rounded-full font-label-md text-label-md hover:bg-primary hover:text-white transition-all transform active:scale-95">Explore Collection</button>
</div>
</div>
</div>
</section>
<!-- Brand Services -->
<section class="py-16 bg-surface-container-lowest">
<div class="max-w-container-max mx-auto px-margin-desktop">
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter text-center">
<div class="flex flex-col items-center p-8 transition-transform hover:-translate-y-1">
<div class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-low mb-4">
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">local_shipping</span>
</div>
<h3 class="font-label-md text-label-md uppercase tracking-wider mb-2 text-primary">Fast Delivery</h3>
<p class="text-body-sm text-on-surface-variant">Global shipping with 48h express options.</p>
</div>
<div class="flex flex-col items-center p-8 transition-transform hover:-translate-y-1">
<div class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-low mb-4">
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
</div>
<h3 class="font-label-md text-label-md uppercase tracking-wider mb-2 text-primary">Secure Payment</h3>
<p class="text-body-sm text-on-surface-variant">Encrypted transactions for your peace of mind.</p>
</div>
<div class="flex flex-col items-center p-8 transition-transform hover:-translate-y-1">
<div class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-low mb-4">
<span class="material-symbols-outlined text-tertiary" style="font-variation-settings: 'FILL' 1;">featured_seasonal_and_gifts</span>
</div>
<h3 class="font-label-md text-label-md uppercase tracking-wider mb-2 text-primary">Premium Packaging</h3>
<p class="text-body-sm text-on-surface-variant">Signature gift wrap with every fragrance.</p>
</div>
</div>
</div>
</section>
<!-- Best Sellers -->
<section class="py-section-gap">
<div class="max-w-container-max mx-auto px-margin-desktop">
<div class="flex justify-between items-end mb-12">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary mb-2">The Classics</h2>
<p class="text-body-md text-on-surface-variant">Our most beloved signature scents.</p>
</div>
<a class="text-secondary font-label-md hover:underline" href="#">View All Best Sellers</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
<!-- Product Card 1 -->
<div class="group relative glass rounded-2xl p-4 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5">
<div class="aspect-[4/5] overflow-hidden rounded-xl mb-6 bg-surface relative">
<img alt="Azure Morning" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCN9_9HpndDOsgfSPe6CH037JiJdgKNjXhaP_0fK5GJodFLbEc7IBa55Spxcf8MJV1fyVok8P_AtB-UDjaEoPjroVRhN9fNOxHMdTSyzYXUVaE6wBGvIKiaUuwjsq7Q2PV3v6PyCtweEw4yWWIIu5DbXuR3Gna_I2Hnqcfs6SyROiQ9qw5A9UNjjXvVosMdgkRpb2215-RWvpFfYcg3zew3__Y_xfCXqajw31PSar11Rpku1qNeeJItV-PwlMsbyJwHxPqkiUq5vgay">
<button class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[85%] bg-white/90 backdrop-blur-md py-3 rounded-full font-label-md text-primary opacity-0 translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 active:scale-95 shadow-lg">Quick Add</button>
</div>
<div class="px-2">
<div class="flex gap-2 mb-2">
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Citrus</span>
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Oud</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-primary mb-1">Azure Morning</h3>
<p class="text-body-sm text-on-surface-variant mb-4">Bergamot, Patchouli, Sea Salt</p>
<p class="font-body-md font-bold text-secondary">$185.00</p>
</div>
</div>
<!-- Product Card 2 -->
<div class="group relative glass rounded-2xl p-4 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5">
<div class="aspect-[4/5] overflow-hidden rounded-xl mb-6 bg-surface relative">
<img alt="Fleur de Hanah" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBf1bsnrGBkJ9y0m-KKBkFouuIpR3Pr0ywqPwGrRzhLe85FBBfC2URXXlvw7z9bpeg6bzqfWMjvNgLb825iyOjIawAsWy4Vf1iyKdNLh4JUB-gr1n1RzSLkuvRu5WEhXGqPC6z2sjNwno7fzQyQHs9s9m1FkfQ23MmEi881CRDp1dt8FJqRn56591M8-Iftk3HdJDShTQMbtmyVs-v7QvaFFtS7C2WO-c-6R1__0E1tsX5ue7p1Aws9peuWc8tqjQjvLURy689UMUTe">
<button class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[85%] bg-white/90 backdrop-blur-md py-3 rounded-full font-label-md text-primary opacity-0 translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 active:scale-95 shadow-lg">Quick Add</button>
</div>
<div class="px-2">
<div class="flex gap-2 mb-2">
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Floral</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-primary mb-1">Fleur de Hanah</h3>
<p class="text-body-sm text-on-surface-variant mb-4">Jasmin, Rose, White Musk</p>
<p class="font-body-md font-bold text-secondary">$210.00</p>
</div>
</div>
<!-- Product Card 3 -->
<div class="group relative glass rounded-2xl p-4 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5">
<div class="aspect-[4/5] overflow-hidden rounded-xl mb-6 bg-surface relative">
<img alt="Midnight Velvet" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvzrgxRxucoPi7rrxq5Z9jyl381aFHh0DYVr7dscoFuEDLoJ9WVhI0sH4cnxhm6IzEW7zPQjpooOBxIH8CbGenIrSzCD4ztrRqEHOIelHdvo34unNgMKPFEUOuLauct9deZbM7tDA9x5tmwlYBnZ3R-TUJSEN04SGgezfd4m7Yo3ErD-LFlBaOL8MhuZPMZCkIIKNytvmJ9ffq2Gq65XVt-UIdVuYao0UGE6j-ZdfzziY_NUWjiTI8Cs4FAa4a2Ltt61LK1MyvXqkD">
<button class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[85%] bg-white/90 backdrop-blur-md py-3 rounded-full font-label-md text-primary opacity-0 translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 active:scale-95 shadow-lg">Quick Add</button>
</div>
<div class="px-2">
<div class="flex gap-2 mb-2">
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Woody</span>
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Spicy</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-primary mb-1">Midnight Velvet</h3>
<p class="text-body-sm text-on-surface-variant mb-4">Sandalwood, Cardamom, Tobacco</p>
<p class="font-body-md font-bold text-secondary">$245.00</p>
</div>
</div>
<!-- Product Card 4 -->
<div class="group relative glass rounded-2xl p-4 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5">
<div class="aspect-[4/5] overflow-hidden rounded-xl mb-6 bg-surface relative">
<img alt="Sands of Time" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6HATEKrOtKlcLx_ib9qa2LTtQ_-_R5MzaPFBGeOFmIatuTqhzpHY-PV8o8boZdH6IV8sMgkHoMvjA2aHK9JegUFgWwBzJoQuSfgz466ElMu-DF0hIGCA6xfIerPHr4oqtajxXqrdyPTKbbAySfwat3o7nrrrBdEUcxss3g616A_dbkfyfhqgTYLWlUqjjvsoiHWThDCRaPKv9sma7Qz0n_jsezUhjY7j7SIbKl7vtiqyHvYx5MxkbjqVyniAJNRlhu6BMfQGnzrrP">
<button class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[85%] bg-white/90 backdrop-blur-md py-3 rounded-full font-label-md text-primary opacity-0 translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 active:scale-95 shadow-lg">Quick Add</button>
</div>
<div class="px-2">
<div class="flex gap-2 mb-2">
<span class="px-2 py-0.5 bg-tertiary/10 text-tertiary rounded-full text-[10px] font-bold uppercase tracking-widest">Warm</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-primary mb-1">Sands of Time</h3>
<p class="text-body-sm text-on-surface-variant mb-4">Vanilla, Amber, Cedarwood</p>
<p class="font-body-md font-bold text-secondary">$195.00</p>
</div>
</div>
</div>
</div>
</section>
<!-- Fragrance Scanner -->
<section class="py-section-gap bg-primary text-white overflow-hidden">
<div class="max-w-container-max mx-auto px-margin-desktop grid grid-cols-1 lg:grid-cols-2 items-center gap-24">
<div class="relative">
<div class="w-full aspect-square rounded-full border border-white/10 p-12 animate-spin-slow">
<div class="w-full h-full rounded-full border border-white/20 p-12">
<div class="w-full h-full rounded-full border border-secondary p-4 relative overflow-hidden">
<img alt="Scent Scanner" class="w-full h-full object-cover rounded-full mix-blend-screen opacity-40" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDZxzdDY3xmz3NXM7QnVrBTH8YKnYmkG5zA07pfXSBi5VQG2ar5t_2H1OGQ2N3NcIZMeenttYN51SlRyCIJtck1mnVS1uwfaKFxMeIkNy2i0Xq4Iu2w3m6BvdgfsDZr_UUIyXroSq4kELxlndqHqI16k8oAD0qJ-LD8U6x7NhgWVP7ofb4wdzWfx8bvvymvPmYcdecOHnuqrWQn88DT_C67iGI7cjDooa3cdpy2bSkeD5tUIQ8pdytIzIV2KZXNvuZYCXdrQkR-d_Yb">
</div>
</div>
</div>
<div class="absolute inset-0 flex items-center justify-center">
<div class="glass p-8 rounded-full w-48 h-48 flex flex-col items-center justify-center text-center">
<span class="font-label-md text-primary tracking-tighter uppercase mb-1">Note: Top</span>
<span class="font-headline-sm text-secondary">Bergamot</span>
</div>
</div>
</div>
<div class="space-y-8">
<h2 class="font-headline-lg text-headline-lg text-white">Visualizing the Invisible</h2>
<p class="text-body-lg text-white/80">
                        Our Scent Scanner uses high-fidelity visualization to show you the complex interplay of ingredients in your favorite Hanah perfume. From the initial citrus spark to the lingering woody embrace.
                    </p>
<ul class="space-y-4">
<li class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary">check_circle</span>
<span class="text-body-md">Discover top, heart, and base notes.</span>
</li>
<li class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary">check_circle</span>
<span class="text-body-md">Visualize the molecular longevity.</span>
</li>
<li class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary">check_circle</span>
<span class="text-body-md">Expert curation based on your mood profile.</span>
</li>
</ul>
<button class="bg-secondary text-white px-10 py-4 rounded-full font-label-md hover:scale-105 transition-transform active:scale-95 shadow-lg shadow-secondary/30">Try the Scanner</button>
</div>
</div>
</section>
<!-- New Arrivals Carousel -->
<section class="py-section-gap overflow-hidden">
<div class="max-w-container-max mx-auto px-margin-desktop mb-12">
<h2 class="font-headline-lg text-headline-lg text-primary">New Arrivals</h2>
</div>
<div class="flex gap-gutter px-margin-desktop overflow-x-auto no-scrollbar snap-x snap-mandatory">
<div class="min-w-[400px] snap-center">
<div class="relative rounded-3xl overflow-hidden aspect-[4/5] group">
<img alt="Collection One" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpkHY-BZFFDZgp9bOi1XCby0aBJU1a80GS0rkJbhcdtr0fiDdrOmnszo_0t8VylfovTGfDOeB-kWwjYIexPQLIZ9DyejSB3tAj1_C8Rv9XL_mm9_7hgk_hDKjNMGCt530JNgf0Il_ddcg9KYNIKCE2B3tJFgXodEV82CVSiMVazJpZ2Yh9PLpLGxlQZyPYrIsCWduS34hSDvPuZjpUA2uzPdp-bblJYQ_9qaw4OvIedSkjp6jXMh5VHbsEVXzlb14GyUgOvtu152FE">
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex flex-col justify-end p-8 text-white">
<span class="font-label-md tracking-widest uppercase mb-2 text-secondary">Summer 2024</span>
<h3 class="font-headline-md mb-4">The Bloom Series</h3>
<button class="w-fit text-label-md border-b border-white pb-1 hover:text-secondary hover:border-secondary transition-colors">Explore</button>
</div>
</div>
</div>
<div class="min-w-[400px] snap-center">
<div class="relative rounded-3xl overflow-hidden aspect-[4/5] group">
<img alt="Collection Two" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBU7bi58lW-v74sC67rY1O9fN8qdXzd52WQjZyL05qmfw7F90L9caT6HSqs73eHDe8l8d2naWqsUpGJWIsqC_mGc9MQcN0J5rrCsGYZ2wH85vicUrGk7-IlNrlr4iwLp4_UidMrCQwKMI1rND3RIfViIbT_tJ18XN6QYS2geEzJCliTOcav3-J_jbkz9waQ9co8KSlL1SZOO30e9v-Wr625n3Byb9OQPtjg4MagB-B4ZZ61jDchXO4_bw1MX70WuSuHSI8-mw33QZMq">
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex flex-col justify-end p-8 text-white">
<span class="font-label-md tracking-widest uppercase mb-2 text-secondary">Limited Edition</span>
<h3 class="font-headline-md mb-4">Aqua Vibrance</h3>
<button class="w-fit text-label-md border-b border-white pb-1 hover:text-secondary hover:border-secondary transition-colors">Explore</button>
</div>
</div>
</div>
<div class="min-w-[400px] snap-center">
<div class="relative rounded-3xl overflow-hidden aspect-[4/5] group">
<img alt="Collection Three" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcjRNWRFMYcshpASBFlPGpecj9Z_XvKzNWrfstp4b7LJkmRhi9yd5bpPjc_1qXH1ScmYIOa_yjwUw5xgVCzxO6fhfi9e3juEOc54OLhr7vOXq4j4UxpCfgc6W5lz6FwQBPIP33yRaRzU3vt8L9Gv3vljYkCtxYJ7Vut3ygdVFHMTfOFdX6iuOXodsOpoy8bY1d8I5uQsIOIrA7f4vWmnfyWJSiomITIvvxQEzbtlx-4BtoZzAfNFik2PfKHtO6TVUQNopvmPxxQDw_">
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent flex flex-col justify-end p-8 text-white">
<span class="font-label-md tracking-widest uppercase mb-2 text-secondary">Heritage</span>
<h3 class="font-headline-md mb-4">Amber Roots</h3>
<button class="w-fit text-label-md border-b border-white pb-1 hover:text-secondary hover:border-secondary transition-colors">Explore</button>
</div>
</div>
</div>
</div>
</section>
<!-- Testimonials -->
<section class="py-section-gap bg-surface-container-low">
<div class="max-w-3xl mx-auto px-margin-mobile text-center">
<span class="material-symbols-outlined text-secondary text-5xl mb-8" style="font-variation-settings: 'FILL' 1;">format_quote</span>
<div class="space-y-12">
<div class="testimonial-slide active">
<h3 class="font-headline-md italic text-primary leading-relaxed">
                            "Hanah hasn't just created perfumes; they've bottled emotions. Every time I wear Midnight Velvet, I'm transported to a serene winter evening by the fire."
                        </h3>
<p class="font-label-md uppercase tracking-widest text-tertiary mt-6">— Elena R., Editorial Curator</p>
</div>
</div>
<div class="flex justify-center gap-2 mt-12">
<button class="w-2 h-2 rounded-full bg-secondary"></button>
<button class="w-2 h-2 rounded-full bg-primary/20"></button>
<button class="w-2 h-2 rounded-full bg-primary/20"></button>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full py-section-gap bg-primary text-white border-t border-white/5">
<div class="grid grid-cols-1 md:grid-cols-4 gap-gutter px-margin-desktop max-w-container-max mx-auto">
<div class="space-y-6">
<h2 class="font-headline-md text-headline-md text-white">Hanah</h2>
<p class="font-body-sm text-body-sm text-white/70">Elevating everyday rituals through the art of fine fragrance and sensorial design.</p>
<div class="flex gap-4">
<a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
<span class="material-symbols-outlined text-sm">share</span>
</a>
<a class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-secondary transition-colors" href="#">
<span class="material-symbols-outlined text-sm">favorite</span>
</a>
</div>
</div>
<div class="space-y-4">
<h4 class="font-label-md text-label-md uppercase tracking-widest text-secondary">Discover</h4>
<ul class="space-y-2">
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Shop All</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Best Sellers</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">New Arrivals</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Fragrance Finder</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-label-md text-label-md uppercase tracking-widest text-secondary">Company</h4>
<ul class="space-y-2">
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">About Us</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Sustainability</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Privacy Policy</a></li>
<li class=""><a class="text-white/70 hover:text-white transition-colors font-body-sm text-body-sm" href="#">Terms of Service</a></li>
</ul>
</div>
<div class="space-y-4">
<h4 class="font-label-md text-label-md uppercase tracking-widest text-secondary">Newsletter</h4>
<p class="text-body-sm text-white/70">Join our circle for exclusive early access and scent stories.</p>
<div class="relative mt-4">
<input class="w-full bg-transparent border-b border-white/20 py-2 text-body-sm focus:border-secondary focus:ring-0 transition-all placeholder:text-white/30 text-white" placeholder="Email address" type="email">
<button class="absolute right-0 bottom-2 text-secondary hover:translate-x-1 transition-transform">
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
</div>
<div class="max-w-container-max mx-auto px-margin-desktop mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="font-body-sm text-body-sm text-white/40">© 2024 Hanah. Sensorial Excellence.</p>
<div class="flex gap-6">



</div>
</div>
</footer>
<script>
        // Parallax-ish effect on scroll
        window.addEventListener('scroll', () => {
            const scroll = window.pageYOffset;
            const heroImage = document.querySelector('section img');
            if (heroImage) {
                heroImage.style.transform = `translateY(${scroll * 0.2}px)`;
            }
        });
    </script>


<div id="snapdom-sandbox" data-snapdom-sandbox="true" aria-hidden="true" style="position: absolute; left: -9999px; top: -9999px; width: 0px; height: 0px; overflow: hidden;"></div></body></html>