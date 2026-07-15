<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Authentication | Hanah Luxury Fragrance</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "surface-container": "#e8efed",
                        "on-secondary-fixed-variant": "#832600",
                        "surface-dim": "#d4dbda",
                        "surface": "#f4fbf9",
                        "on-primary-fixed-variant": "#394859",
                        "on-error-container": "#93000a",
                        "on-background": "#161d1c",
                        "primary-fixed-dim": "#b8c8dd",
                        "inverse-on-surface": "#ebf2f0",
                        "tertiary-container": "#003138",
                        "outline-variant": "#c4c6cc",
                        "surface-container-highest": "#dde4e2",
                        "primary-fixed": "#d4e4f9",
                        "primary": "#081828",
                        "on-primary": "#ffffff",
                        "secondary": "#ab3500",
                        "inverse-primary": "#b8c8dd",
                        "surface-bright": "#f4fbf9",
                        "surface-container-low": "#eef5f3",
                        "secondary-fixed": "#ffdbd0",
                        "on-secondary-container": "#5d1900",
                        "on-tertiary-fixed-variant": "#004e59",
                        "surface-container-high": "#e3eae8",
                        "on-secondary-fixed": "#390c00",
                        "error-container": "#ffdad6",
                        "on-primary-container": "#8594a8",
                        "inverse-surface": "#2b3231",
                        "primary-container": "#1e2d3d",
                        "background": "#f4fbf9",
                        "tertiary-fixed": "#9eefff",
                        "outline": "#74777d",
                        "on-surface-variant": "#44474c",
                        "on-primary-fixed": "#0d1d2c",
                        "tertiary-fixed-dim": "#77d4e5",
                        "tertiary": "#001b1f",
                        "surface-variant": "#dde4e2",
                        "surface-tint": "#516072",
                        "on-tertiary-container": "#3da0b0",
                        "secondary-fixed-dim": "#ffb59d",
                        "on-tertiary-fixed": "#001f24",
                        "on-surface": "#161d1c",
                        "on-secondary": "#ffffff",
                        "tangerine": "#FF6B35",
                        "mint-teal": "#028090",
                        "ice": "#EDF4F2",
                        "navy": "#1E2D3D"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "24px", "section-gap": "120px", "margin-mobile": "20px", "margin-desktop": "64px", "unit": "8px", "container-max": "1280px"
                    },
                    "fontFamily": {
                        "button": ["Hanken Grotesk"], "label-md": ["Hanken Grotesk"], "headline-lg-mobile": ["EB Garamond"], "headline-md": ["EB Garamond"], "body-lg": ["Hanken Grotesk"], "display-lg": ["EB Garamond"], "body-md": ["Hanken Grotesk"], "headline-lg": ["EB Garamond"]
                    },
                    "fontSize": {
                        "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "500"}],
                        "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "500"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "fontWeight": "500"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        input:focus { outline: none; border-color: #028090 !important; box-shadow: 0 0 0 2px rgba(2, 128, 144, 0.1); }
        .bg-mesh {
            background-color: #EDF4F2;
            background-image: 
                radial-gradient(at 0% 0%, hsla(192, 15%, 85%, 1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(184, 18%, 88%, 1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(200, 10%, 82%, 1) 0, transparent 50%);
        }
        .transition-soft { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-ice font-body-md text-navy antialiased selection:bg-mint-teal/20">

<main class="min-h-screen flex items-center justify-center relative overflow-hidden bg-mesh p-4 md:p-8 lg:p-margin-desktop">
    <div class="relative z-10 w-full max-w-container-max flex flex-col md:flex-row bg-surface-container-lowest shadow-[0px_32px_80px_rgba(30,45,61,0.08)] rounded-[2rem] overflow-hidden min-h-[870px]">
        
        <div class="w-full md:w-1/2 relative min-h-[300px] md:min-h-full overflow-hidden">
            <div class="absolute inset-0 scale-105 transition-transform duration-[2000ms] hover:scale-100">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBc6TgjW3DDIjC0sNZrZwj_ErDlZjU5fiz-GBDGVJO4gHGyfk_uxhS7t-oBJgFttK4zDVTxN4Ywazv-GsvnCxSGqxkp0uZ6R6zK3v5cQ9A6mFfoKZzycZ8SI3Onvc7yhTUpmulFLh88qo2jtp-w5bXIi1qerbezt3XiSpcXnS38rakYIPxiZSuxDtzwEiMCvGhvWBQsjl6fgDMCM-NNiQBx4QzPz-qCASY6tCfv6ISoYpFD-QBgZ_-awbpototTteX__cv5hfqm4UU" alt="Hanah Fragrance"/>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-navy/60 via-navy/20 to-transparent flex flex-col justify-end p-12 lg:p-16">
                <div class="max-w-md space-y-6">
                    <div class="font-headline-lg text-headline-lg text-ice tracking-tight">Hanah</div>
                    <h2 class="font-headline-md text-headline-md text-ice leading-tight" id="left-title">Welcome Back.</h2>
                    <p class="font-body-lg text-body-lg text-ice/80 max-w-xs" id="left-desc">Sign in to access your curated collection and personalized olfactory profile.</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex flex-col justify-center p-8 lg:p-16 xl:p-24 bg-surface-container-lowest">
            <div class="w-full max-w-md mx-auto">
                
                <div class="flex border-b border-navy/10 mb-10 gap-8 justify-center md:justify-start">
                    <button id="tab-login" onclick="switchTab('login')" class="pb-3 text-lg font-semibold border-b-2 border-mint-teal text-navy transition-all duration-300 focus:outline-none cursor-pointer">
                        Sign In
                    </button>
                    <button id="tab-register" onclick="switchTab('register')" class="pb-3 text-lg font-semibold border-b-2 border-transparent text-navy/40 hover:text-navy transition-all duration-300 focus:outline-none cursor-pointer">
                        Create Account
                    </button>
                </div>

                <div id="form-login-wrapper" class="transition-all duration-300">
                    <div class="mb-6">
                        <h1 class="font-headline-lg text-3xl text-navy mb-2">Sign In to Your Account</h1>
                        <p class="font-body-md text-sm text-on-surface-variant">Enter your credentials to re-enter the world of Hanah.</p>
                    </div>

                    @if (session('success_register'))
                        <div class="p-4 mb-4 text-xs text-emerald-800 bg-emerald-50 border border-emerald-500/20 rounded-xl flex items-center gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-base text-emerald-600">check_circle</span>
                            <span>{{ session('success_register') }}</span>
                        </div>
                    @endif

                    @if ($errors->has('login_error'))
                        <div class="p-4 mb-4 text-xs text-error bg-error-container/30 border border-error/20 rounded-xl flex items-start gap-2 shadow-sm">
                            <span class="material-symbols-outlined text-base text-error shrink-0">error</span>
                            <span>{{ $errors->first('login_error') }}</span>
                        </div>
                    @endif

                    <form class="space-y-5" action="{{ route('login.submit') }}" method="POST" onsubmit="clearAuthHistory()">
                        @csrf
                        <div class="space-y-1">
                            <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="login_email">Email Address</label>
                            <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft" id="login_email" name="email" value="{{ old('email') }}" type="email" required placeholder="name@example.com"/>
                            @error('email')
                                <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between items-center">
                                <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="login_password">Password</label>
                                <a href="#" class="text-xs text-navy/50 hover:text-mint-teal transition-colors">Forgot?</a>
                            </div>
                            <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft" id="login_password" name="password" type="password" required placeholder="••••••••"/>
                            @error('password')
                                <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-navy/20 text-mint-teal focus:ring-mint-teal/30 bg-surface-container-low cursor-pointer"/>
                            <label for="remember" class="ml-2 text-sm text-navy/70 select-none cursor-pointer">Remember my preferences</label>
                        </div>

                        <button class="w-full h-14 bg-tangerine hover:bg-[#ff7b4d] text-ice rounded-xl font-button shadow-lg shadow-tangerine/20 transition-soft transform active:scale-[0.98] mt-2 cursor-pointer font-bold uppercase tracking-wider text-xs" type="submit">
                            Sign In
                        </button>
                    </form>
                </div>

                <div id="form-register-wrapper" class="hidden transition-all duration-300">
                    <div class="mb-6">
                        <h1 class="font-headline-lg text-3xl text-navy mb-2">Create Your Account</h1>
                        <p class="font-body-md text-sm text-on-surface-variant">Join our inner circle for exclusive releases and scent discovery.</p>
                    </div>

                    <form class="space-y-5" action="{{ route('front.register.submit') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-1">
                            <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="reg_name">Full Name</label>
                            <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft @error('name') border border-error/40 @enderror" id="reg_name" name="name" value="{{ old('name') }}" type="text" required placeholder="Farhan Tambunan"/>
                            @error('name')
                                <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="reg_email">Email Address</label>
                            <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft @error('email') border border-error/40 @enderror" id="reg_email" name="email" value="{{ old('email') }}" type="email" required placeholder="elias@example.com"/>
                            @error('email')
                                <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="reg_password">Password</label>
                                <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft @error('password') border border-error/40 @enderror" id="reg_password" name="password" type="password" required placeholder="••••••••"/>
                                @error('password')
                                    <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="font-label-md text-xs uppercase tracking-wider text-navy/60 transition-soft block" for="reg_confirm">Confirm Password</label>
                                <input class="w-full h-14 bg-surface-container-low border-none rounded-xl px-5 text-navy focus:ring-0 transition-soft @error('confirm_password') border border-error/40 @enderror" id="reg_confirm" name="confirm_password" type="password" required placeholder="••••••••"/>
                                @error('confirm_password')
                                    <p class="text-[11px] text-error mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button class="w-full h-14 bg-tangerine hover:bg-[#ff7b4d] text-ice rounded-xl font-button shadow-lg shadow-tangerine/20 transition-soft transform active:scale-[0.98] mt-2 cursor-pointer font-bold uppercase tracking-wider text-xs" type="submit">
                            Create Account
                        </button>
                    </form>
                </div>

                <div class="mt-6">
                    <div class="relative py-3">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-navy/10"></div></div>
                        <div class="relative flex justify-center text-xs uppercase tracking-widest"><span class="bg-surface-container-lowest px-4 text-navy/40">Or continue with</span></div>
                    </div>
                    <button class="group w-full h-14 flex items-center justify-center gap-3 bg-surface-container-low hover:bg-surface-container-highest border border-navy/5 rounded-xl transition-soft cursor-pointer" type="button">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" viewbox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                        </svg>
                        <span class="font-button text-navy text-xs font-bold uppercase tracking-wider">Google Account</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>

<div class="fixed top-12 left-12 pointer-events-none z-50">
    <div class="font-headline-md text-navy/10 select-none">HANAH</div>
</div>

<script>
    function switchTab(target) {
        const formLogin = document.getElementById('form-login-wrapper');
        const formRegister = document.getElementById('form-register-wrapper');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');
        const leftTitle = document.getElementById('left-title');
        const leftDesc = document.getElementById('left-desc');

        if (target === 'login') {
            if(formLogin) formLogin.classList.remove('hidden');
            if(formRegister) formRegister.classList.add('hidden');
            if(tabLogin) tabLogin.className = "pb-3 text-lg font-semibold border-b-2 border-mint-teal text-navy transition-all duration-300 focus:outline-none cursor-pointer";
            if(tabRegister) tabRegister.className = "pb-3 text-lg font-semibold border-b-2 border-transparent text-navy/40 hover:text-navy transition-all duration-300 focus:outline-none cursor-pointer";
            if(leftTitle) leftTitle.innerText = "Welcome Back.";
            if(leftDesc) leftDesc.innerText = "Sign in to access your curated collection and personalized olfactory profile.";
        } else {
            if(formLogin) formLogin.classList.add('hidden');
            if(formRegister) formRegister.classList.remove('hidden');
            if(tabLogin) tabLogin.className = "pb-3 text-lg font-semibold border-b-2 border-transparent text-navy/40 hover:text-navy transition-all duration-300 focus:outline-none cursor-pointer";
            if(tabRegister) tabRegister.className = "pb-3 text-lg font-semibold border-b-2 border-mint-teal text-navy transition-all duration-300 focus:outline-none cursor-pointer";
            if(leftTitle) leftTitle.innerText = "Join the Circle.";
            if(leftDesc) leftDesc.innerText = "Experience the essence of artisanal craftsmanship and personalized scent discovery.";
        }
    }

    const inputs = document.querySelectorAll('input[type="email"], input[type="password"], input[type="text"]');
    inputs.forEach(input => {
        if(input.value !== '') {
            const label = input.parentElement.querySelector('label');
            if(label) { label.style.color = '#028090'; label.style.opacity = '1'; }
        }

        input.addEventListener('focus', () => {
            const label = input.parentElement.querySelector('label');
            if(label) { label.style.color = '#028090'; label.style.opacity = '1'; }
        });
        input.addEventListener('blur', () => {
            if(input.value === '') {
                const label = input.parentElement.querySelector('label');
                if(label) { label.style.color = ''; label.style.opacity = '0.6'; }
            }
        });
    });

    // 🏛️ Mengunci status tab aktif berdasarkan kiriman flash session 'active_tab' secara presisi
    @if(session('active_tab') === 'register')
        switchTab('register');
    @else
        switchTab('login');
    @endif

    function clearAuthHistory() {
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, document.title, document.referrer);
        }
    }

    window.addEventListener('pageshow', function (event) {
        if (event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2)) {
            window.location.reload();
        }
    });
</script>
</body>
</html>