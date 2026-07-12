<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'PMB RA AN-NUUR - Islamic Kindergarten')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .silk-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
        .bento-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .bento-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0px 10px 32px rgba(0, 0, 0, 0.05);
        }
        .step-active-halo {
            box-shadow: 0 0 0 4px rgba(252, 223, 70, 0.4);
        }
        .step-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        input:focus {
            box-shadow: 0 0 0 3px rgba(0, 107, 44, 0.15);
        }
        @yield('styles')
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f7f9fb",
                        "inverse-primary": "#62df7d",
                        "inverse-surface": "#2d3133",
                        "tertiary": "#515c71",
                        "on-tertiary-fixed": "#111c2d",
                        "surface-bright": "#f7f9fb",
                        "on-primary": "#ffffff",
                        "primary-fixed-dim": "#62df7d",
                        "primary": "#006b2c",
                        "surface-variant": "#e0e3e5",
                        "on-surface-variant": "#3e4a3d",
                        "inverse-on-surface": "#eff1f3",
                        "tertiary-fixed-dim": "#bcc7de",
                        "on-background": "#191c1e",
                        "on-surface": "#191c1e",
                        "on-tertiary": "#ffffff",
                        "outline-variant": "#bdcaba",
                        "surface-tint": "#006e2d",
                        "on-primary-fixed": "#002109",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "primary-container": "#00873a",
                        "on-error-container": "#93000a",
                        "on-secondary-container": "#726200",
                        "secondary-container": "#fcdf46",
                        "surface-container-low": "#f2f4f6",
                        "secondary-fixed-dim": "#e2c62d",
                        "surface-dim": "#d8dadc",
                        "tertiary-fixed": "#d8e3fb",
                        "on-secondary-fixed-variant": "#524600",
                        "primary-fixed": "#7ffc97",
                        "outline": "#6e7b6c",
                        "secondary-fixed": "#ffe24c",
                        "on-secondary-fixed": "#211b00",
                        "surface-container": "#eceef0",
                        "secondary": "#6d5e00",
                        "on-primary-container": "#f7fff2",
                        "on-tertiary-container": "#fefcff",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "error": "#ba1a1a",
                        "surface": "#f7f9fb",
                        "on-primary-fixed-variant": "#005320",
                        "tertiary-container": "#6a758a",
                        "on-tertiary-fixed-variant": "#3c475a",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1280px",
                        "md": "16px",
                        "base": "8px",
                        "xs": "4px",
                        "lg": "24px",
                        "xl": "32px",
                        "sm": "12px",
                        "gutter": "24px",
                        "stack-lg": "32px",
                        "stack-md": "16px",
                        "stack-sm": "8px",
                        "margin-desktop": "48px",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "headline-sm": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "label-md": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-sm": ["Inter"],
                        "body-lg": ["Inter"],
                        "status-badge": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "headline-sm": ["20px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg-mobile": ["30px", {"lineHeight": "36px", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "60px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "status-badge": ["12px", {"lineHeight": "16px", "fontWeight": "700"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    @yield('scripts')
</body>
</html>
