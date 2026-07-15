<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#081828",
                    "surface-container-highest": "#dde4e2",
                    "on-tertiary-fixed": "#001f24",
                    "outline-variant": "#c4c6cc",
                    "surface-container-low": "#eef5f3",
                    "on-tertiary-fixed-variant": "#004e59",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed": "#ffdbd0",
                    "on-primary": "#ffffff",
                    "surface-tint": "#516072",
                    "surface-container": "#e8efed",
                    "tertiary-fixed": "#9eefff",
                    "tertiary-container": "#003138",
                    "on-surface": "#161d1c",
                    "on-primary-container": "#8594a8",
                    "secondary-fixed-dim": "#ffb59d",
                    "secondary": "#ab3500",
                    "error": "#ba1a1a",
                    "on-error-container": "#93000a",
                    "surface": "#f4fbf9",
                    "surface-variant": "#dde4e2",
                    "on-secondary-fixed": "#390c00",
                    "on-secondary-container": "#5d1900",
                    "on-surface-variant": "#44474c",
                    "on-tertiary-container": "#3da0b0",
                    "primary-fixed-dim": "#b8c8dd",
                    "primary-fixed": "#d4e4f9",
                    "surface-container-lowest": "#ffffff",
                    "on-secondary": "#ffffff",
                    "inverse-primary": "#b8c8dd",
                    "secondary-container": "#fe6a34",
                    "inverse-on-surface": "#ebf2f0",
                    "surface-container-high": "#e3eae8",
                    "on-error": "#ffffff",
                    "on-secondary-fixed-variant": "#832600",
                    "background": "#f4fbf9",
                    "inverse-surface": "#2b3231",
                    "on-primary-fixed": "#0d1d2c",
                    "surface-dim": "#d4dbda",
                    "tertiary": "#001b1f",
                    "outline": "#74777d",
                    "primary-container": "#1e2d3d",
                    "surface-bright": "#f4fbf9",
                    "on-primary-fixed-variant": "#394859",
                    "on-background": "#161d1c",
                    "error-container": "#ffdad6",
                    "tertiary-fixed-dim": "#77d4e5"
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                spacing: {
                    "section-gap": "64px",
                    "gutter": "24px",
                    "stack-sm": "8px",
                    "unit": "4px",
                    "stack-lg": "32px",
                    "container-padding": "32px",
                    "stack-md": "16px"
                },
                fontFamily: {
                    "headline-lg": ["Manrope"],
                    "body-sm": ["Inter"],
                    "headline-md": ["Manrope"],
                    "display-lg": ["Manrope"],
                    "label-caps": ["JetBrains Mono"],
                    "body-lg": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-lg-mobile": ["Manrope"]
                },
                fontSize: {
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "500"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["28px", {"lineHeight": "36px", "fontWeight": "600"}]
                }
            } // Tutup objek extend dengan benar di sini
        }
    };
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="{{ asset('admin/js/custom.js') }}"></script>

<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #D1DBDB;
        border-radius: 10px;
    }
    .glass-nav {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.8);
    }
    .elevation-1 {
        box-shadow: 0px 4px 20px rgba(30, 45, 61, 0.05);
    }
</style>