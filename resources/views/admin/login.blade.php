<!DOCTYPE html>
<html class="light" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Create Administrator Account | Hanah Admin</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
        <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&amp;family=Geist:wght@400;600&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
        <script src="https://cdn.tailwindcss.com"></script>
        <script id="tailwind-config">
            tailwind.config = {
              darkMode: "class",
              theme: {
                extend: {
                  "colors": {
                          "surface-tint": "#516072",
                          "on-error": "#ffffff",
                          "outline-variant": "#c4c6cc",
                          "on-tertiary-fixed": "#001f24",
                          "on-secondary-fixed": "#390c00",
                          "surface-dim": "#d4dbda",
                          "secondary-container": "#fe6a34",
                          "primary-fixed-dim": "#b8c8dd",
                          "tertiary-fixed": "#9eefff",
                          "error": "#ba1a1a",
                          "on-secondary-container": "#5d1900",
                          "background": "#f4fbf9",
                          "on-secondary": "#ffffff",
                          "surface-container-low": "#eef5f3",
                          "on-tertiary-container": "#3da0b0",
                          "on-primary-fixed": "#0d1d2c",
                          "on-primary": "#ffffff",
                          "outline": "#74777d",
                          "inverse-primary": "#b8c8dd",
                          "surface-container": "#e8efed",
                          "on-error-container": "#93000a",
                          "secondary-fixed-dim": "#ffb59d",
                          "surface-bright": "#f4fbf9",
                          "surface-container-highest": "#dde4e2",
                          "primary-fixed": "#d4e4f9",
                          "primary-container": "#1e2d3d",
                          "primary": "#081828",
                          "on-primary-container": "#8594a8",
                          "on-primary-fixed-variant": "#394859",
                          "on-tertiary-fixed-variant": "#004e59",
                          "on-background": "#161d1c",
                          "on-secondary-fixed-variant": "#832600",
                          "tertiary-container": "#003138",
                          "on-surface": "#161d1c",
                          "tertiary": "#001b1f",
                          "surface": "#f4fbf9",
                          "surface-container-lowest": "#ffffff",
                          "on-tertiary": "#ffffff",
                          "surface-container-high": "#e3eae8",
                          "secondary-fixed": "#ffdbd0",
                          "error-container": "#ffdad6",
                          "inverse-surface": "#2b3231",
                          "tertiary-fixed-dim": "#77d4e5",
                          "secondary": "#ab3500",
                          "inverse-on-surface": "#ebf2f0",
                          "surface-variant": "#dde4e2"
                  },
                  "borderRadius": {
                          "DEFAULT": "0.25rem",
                          "lg": "0.5rem",
                          "xl": "0.75rem",
                          "full": "9999px"
                  },
                  "spacing": {
                          "base": "8px",
                          "margin-desktop": "48px",
                          "margin-mobile": "16px",
                          "section-gap": "80px",
                          "gutter": "24px",
                          "container-max": "1440px"
                  },
                  "fontFamily": {
                          "title-md": ["Hanken Grotesk"],
                          "label-caps": ["Geist"],
                          "headline-lg": ["Hanken Grotesk"],
                          "display-lg": ["Hanken Grotesk"],
                          "body-lg": ["Hanken Grotesk"],
                          "body-sm": ["Hanken Grotesk"],
                          "mono-label": ["Geist"],
                          "headline-lg-mobile": ["Hanken Grotesk"]
                  },
                  "fontSize": {
                          "title-md": ["20px", {"lineHeight": "1.4", "letterSpacing": "-0.01em", "fontWeight": "500"}],
                          "label-caps": ["12px", {"lineHeight": "1", "letterSpacing": "0.1em", "fontWeight": "600"}],
                          "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                          "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "600"}],
                          "body-lg": ["16px", {"lineHeight": "1.6", "letterSpacing": "0em", "fontWeight": "400"}],
                          "body-sm": ["14px", {"lineHeight": "1.5", "letterSpacing": "0em", "fontWeight": "400"}],
                          "mono-label": ["13px", {"lineHeight": "1", "letterSpacing": "0em", "fontWeight": "400"}],
                          "headline-lg-mobile": ["24px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}]
                  }
                },
              },
            }
        </script>
        <style>
            .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            }
            .premium-shadow {
            box-shadow: 0 4px 20px rgba(30, 45, 61, 0.04);
            }
            .auth-card-shadow {
            box-shadow: 0 12px 40px rgba(30, 45, 61, 0.08);
            }
            .glass-overlay {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(8, 24, 40, 0.05);
            }
            input:focus, select:focus {
            outline: none !important;
            border-color: #3da0b0 !important;
            box-shadow: 0 0 0 4px rgba(61, 160, 176, 0.2) !important;
            }
            .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c4c6cc;
            border-radius: 10px;
            }
        </style>
    </head>
    <body class="bg-surface font-body-lg text-on-surface selection:bg-secondary-container/30">
        <main class="flex min-h-screen">
            <!-- Left Branding Panel (45%) -->
            <section class="hidden lg:flex w-[45%] bg-primary-container relative flex-col p-12 overflow-hidden justify-between">
                <!-- Background Atmospheric Effect -->
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <div class="absolute top-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-secondary-container blur-[120px]"></div>
                    <div class="absolute bottom-[-5%] left-[-5%] w-[40%] h-[40%] rounded-full bg-tertiary-fixed-dim blur-[100px]"></div>
                </div>
                <div class="relative z-10">
                    <img alt="Hanah Logo White" class="h-10 mb-20 object-contain" src="data:image/png;base64,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"/>
                    <h1 class="font-display-lg text-display-lg text-on-primary mb-6 max-w-md">
                        Orchestrate Luxury with Precision.
                    </h1>
                    <p class="font-body-lg text-body-lg text-on-primary-container max-w-md leading-relaxed">
                        Access the sovereign control center for Hanah. Manage global assets, inventory, and security protocols with enterprise-grade refinement.
                    </p>
                </div>
                <div class="relative z-10 grid gap-6">
                    <!-- Feature Cards -->
                    <div class="glass-overlay p-6 rounded-xl flex items-start gap-4 transition-transform duration-300 hover:scale-[1.02]">
                        <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">security</span>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-primary mb-1">Encrypted Security</h3>
                            <p class="font-body-sm text-body-sm text-on-primary-container/80">Military-grade protection for every administrative action.</p>
                        </div>
                    </div>
                    <div class="glass-overlay p-6 rounded-xl flex items-start gap-4 transition-transform duration-300 hover:scale-[1.02]">
                        <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">analytics</span>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-primary mb-1">Real-time Analytics</h3>
                            <p class="font-body-sm text-body-sm text-on-primary-container/80">Instant insights into brand performance and inventory flow.</p>
                        </div>
                    </div>
                    <div class="glass-overlay p-6 rounded-xl flex items-start gap-4 transition-transform duration-300 hover:scale-[1.02]">
                        <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">diamond</span>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-primary mb-1">Asset Management</h3>
                            <p class="font-body-sm text-body-sm text-on-primary-container/80">Seamlessly curate and deploy high-fidelity brand assets.</p>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 text-on-primary-container/60 font-label-caps text-label-caps">
                    © 2024 HANAH ENTERPRISE • AUTHENTICATED ACCESS
                </div>
            </section>
            <!-- Right Auth Panel -->
            <section class="flex-1 flex flex-col justify-between bg-surface py-12 px-margin-mobile md:px-margin-desktop overflow-y-auto">
                <div class="flex-1 flex flex-col justify-center items-center py-8">
                    <div class="w-full max-w-[460px] space-y-8">
                        <div class="bg-white p-10 rounded-[24px] auth-card-shadow border border-outline-variant/20 animate-fade-in-up">
                            <div class="space-y-2 mb-8">
                                <h2 class="font-headline-lg text-headline-lg text-primary">Welcome Back</h2>
                                <p class="font-body-sm text-on-surface-variant">Sign in to continue to the Hanah Administration Dashboard.</p>
                            </div>

                            @if(session('error_message'))
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg flex items-center justify-between" role="alert">
                                    <span>{{ session('error_message') }}</span>
                                    
                                    <button type="button" 
                                            onclick="this.parentElement.remove();" 
                                            class="ml-4 text-red-700 hover:text-red-900 transition-colors font-bold">
                                        ✕
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('admin.login.request')}}" method="post" class="space-y-6">@csrf
                                <div class="space-y-2">
                                    <label class="font-label-caps text-label-caps text-on-surface-variant block" for="email">EMAIL ADDRESS</label>
                                    <div class="relative">
                                        <input class="w-full px-4 py-3 bg-white border border-outline-variant rounded-[12px] focus:outline-none focus:border-on-tertiary-container input-focus-glow transition-all" id="email" name="email" placeholder="Email" type="email"
                                       />
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="font-label-caps text-label-caps text-on-surface-variant block" for="password">PASSWORD</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="material-symbols-outlined text-outline text-[20px]">lock</span>
                                        </div>
                                        <input class="w-full pl-10 pr-10 py-3 bg-white border border-outline-variant rounded-[12px] focus:outline-none focus:border-on-tertiary-container input-focus-glow transition-all" id="password" name="password" placeholder="Password" type="password" autocomplete="current-password" required
                                        />
                                        <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-primary transition-colors" onclick="togglePassword()" type="button">
                                        <span class="material-symbols-outlined text-[20px]" id="password-toggle-icon">visibility</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input class="w-4 h-4 text-secondary border-outline-variant rounded focus:ring-secondary/20" id="remember" name="remember" type="checkbox" value="1"
                                        />
                                        <label class="ml-2 font-body-sm text-on-surface-variant cursor-pointer" for="remember">Remember Me</label>
                                    </div>
                                    <a class="font-body-sm text-secondary hover:underline transition-all" href="#">Forgot Password?</a>
                                </div>
                                <button class="w-full bg-[#FF6B35] text-white font-title-md py-4 rounded-[12px] hover:shadow-lg hover:shadow-secondary/20 active:scale-95 transition-all duration-200" type="submit">
                                Sign In
                                </button>
                            </form>
                            <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
                                <p class="font-body-sm text-on-surface-variant">
                                    Don't have an administrator account? 
                                    <a class="text-secondary font-bold hover:underline" href="#">Create Account</a>
                                </p>
                            </div>
                        </div>
                        <div class="bg-surface-container p-6 rounded-[24px] border border-outline-variant/30 flex items-start space-x-4">
                            <div class="p-2 bg-primary/5 rounded-full">
                                <span class="material-symbols-outlined text-primary text-[24px]" data-weight="fill">shield</span>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-title-md text-primary text-[16px]">Security Notice</h4>
                                <p class="font-body-sm text-on-surface-variant text-[13px] leading-relaxed">
                                    Administrator accounts have elevated privileges. Ensure you are on a private network and have Multi-Factor Authentication enabled before accessing core business data.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="w-full py-6 flex flex-col md:flex-row justify-between items-center text-on-surface-variant/60 font-body-sm px-4">
                    <p>© 2026 Hanah Luxury Fragrance | Luxury E-Commerce Administration System</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                        <a class="hover:text-primary transition-colors" href="#">Security Architecture</a>
                    </div>
                </footer>
            </section>
        </main>
        <!-- Global Footer -->
        <script>
            // Simple Micro-interactions
            document.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('focus', () => {
                    element.closest('div').classList.add('premium-focus');
                });
                element.addEventListener('blur', () => {
                    element.closest('div').classList.remove('premium-focus');
                });
            });
            
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kita parsing data cookie PHP langsung ke variabel JavaScript saat halaman selesai dimuat
            @if(isset($_COOKIE['email']))
                document.getElementById('email').value = "{{ $_COOKIE['email'] }}";
                document.getElementById('remember').checked = true;
            @endif

            @if(isset($_COOKIE['password']))
                document.getElementById('password').value = "{{ $_COOKIE['password'] }}";
            @endif
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }
</script>
    </body>
</html>