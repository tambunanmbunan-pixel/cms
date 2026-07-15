<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&amp;family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">

<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    // TEMA WARNA BASE / HOME
                    "primary-home": "#25394d",
                    "primary-container-home": "#25394d",

                    // TEMA WARNA COKLAT/ORANGE & KUSTOM UMUM
                    "secondary-container": "#fe6a34",
                    "on-tertiary-fixed-variant": "#004e59",
                    "surface-container-lowest": "#ffffff",
                    "error": "#ba1a1a",
                    "on-surface": "#161d1c",
                    "on-background": "#161d1c",
                    "surface-container-high": "#e3eae8",
                    "surface-container": "#e8efed",
                    "error-container": "#ffdad6",
                    "on-secondary-fixed-variant": "#832600",
                    "on-error-container": "#93000a",
                    "surface-container-highest": "#dde4e2",
                    "surface-tint": "#516072",
                    "tertiary-fixed-dim": "#77d4e5",
                    "surface-container-low": "#eef5f3",
                    "secondary-fixed-dim": "#ffb59d",
                    "secondary": "#ab3500",
                    "tertiary-fixed": "#9eefff",
                    "surface-variant": "#dde4e2",
                    "primary-fixed-dim": "#b8c8dd",
                    "inverse-on-surface": "#ebf2f0",
                    "on-error": "#ffffff",
                    "on-tertiary": "#ffffff",
                    "outline": "#74777d",
                    "surface": "#f4fbf9",
                    "tertiary-container": "#003138",
                    "on-primary-fixed": "#0d1d2c",
                    "surface-dim": "#d4dbda",
                    "on-secondary-container": "#5d1900",
                    "primary-fixed": "#d4e4f9",
                    "secondary-fixed": "#ffdbd0",
                    "on-primary": "#ffffff",
                    "on-tertiary-container": "#3da0b0",
                    "inverse-primary": "#b8c8dd",
                    "inverse-surface": "#2b3231",
                    "on-tertiary-fixed": "#001f24",
                    "on-primary-fixed-variant": "#394859",
                    "on-primary-container": "#8594a8",
                    "outline-variant": "#c4c6cc",
                    "surface-bright": "#f4fbf9",
                    "background": "#f4fbf9",
                    "on-surface-variant": "#44474c",
                    "on-secondary-fixed": "#390c00",
                    "tertiary": "#001b1f",
                    "on-secondary": "#ffffff",

                    // TOKEN WARNA KHUSUS HALAMAN DETIL
                    "fresh-ice": "#EDF4F2",
                    "ocean-navy": "#1E2D3D",

                    // SEBAGAI TEMA UTAMA GLOBAL (MILIK SHOP / KATALOG)
                    "primary-container": "#1e2d3d", 
                    "primary": "#081828" 
                },
                "borderRadius": {
                    "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"
                },
                "spacing": {
                    "margin-desktop": "64px", "margin-mobile": "20px", "gutter": "24px", "unit": "8px", "section-gap": "120px", "container-max": "1280px"
                },
                "fontFamily": {
                    "label-md": ["Hanken Grotesk"], "button": ["Hanken Grotesk"], "display-lg": ["EB Garamond"], "body-lg": ["Hanken Grotesk"], "headline-lg": ["EB Garamond"], "headline-md": ["EB Garamond"], "headline-lg-mobile": ["EB Garamond"], "body-md": ["Hanken Grotesk"]
                },
                "fontSize": {
                    "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                    "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "500"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "headline-lg": ["48px", {"lineHeight": "1.2", "fontWeight": "500"}],
                    "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "500"}],
                    "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
                }
            },
        },
    }
</script>