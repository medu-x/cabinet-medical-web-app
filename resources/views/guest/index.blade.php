<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <!-- <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script> -->
     @vite('resources/css/app.css')
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed-dim": "#75d4e7",
                        "secondary-fixed": "#d5e3fc",
                        "secondary": "#515f74",
                        "primary-container": "#008394",
                        "tertiary-fixed": "#ffdcc5",
                        "on-background": "#191c1e",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-container": "#0c0300",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#ab662d",
                        "on-primary": "#ffffff",
                        "surface-container": "#eceef0",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-tertiary-fixed": "#301400",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#8d4e16",
                        "primary": "#006876",
                        "outline-variant": "#bdc8cb",
                        "on-primary-fixed-variant": "#004e59",
                        "secondary-fixed-dim": "#b9c7df",
                        "primary-fixed": "#a0efff",
                        "secondary-container": "#d5e3fc",
                        "error": "#ba1a1a",
                        "surface-container-low": "#f2f4f6",
                        "surface": "#f7f9fb",
                        "inverse-surface": "#2d3133",
                        "inverse-primary": "#75d4e7",
                        "outline": "#6e797c",
                        "on-secondary-container": "#57657a",
                        "surface-tint": "#006876",
                        "on-error-container": "#93000a",
                        "background": "#f7f9fb",
                        "tertiary-fixed-dim": "#ffb782",
                        "on-primary-container": "#000608",
                        "surface-variant": "#e0e3e5",
                        "on-surface-variant": "#3e494b",
                        "surface-dim": "#d8dadc",
                        "surface-bright": "#f7f9fb",
                        "on-surface": "#191c1e",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed": "#001f25",
                        "on-tertiary-fixed-variant": "#703800",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Inter"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .clinical-shadow {
            box-shadow: 0 4px 20px -2px rgba(0, 104, 118, 0.08), 0 10px 40px -5px rgba(0, 0, 0, 0.04);
        }

        .active-nav-border {
            border-bottom: 2px solid #006876;
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body">
    <!-- TopNavBar -->
    <nav class="bg-transparent docked full-width top-0 z-50">
        <div class="flex justify-between items-center w-full px-8 py-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-white shadow-md">
                    <span class="material-symbols-outlined text-[20px]">medical_services</span>
                </div>
                <span class="text-xl font-bold text-teal-800 dark:text-teal-300">Cabinet Médical</span>
            </div>
            <div class="hidden md:flex gap-8 items-center">
                <a class="font-['Inter'] font-semibold text-sm tracking-tight text-teal-700 dark:text-teal-400 border-b-2 border-teal-700 hover:text-teal-600 transition-colors" href="#">Accueil</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#services">Services</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#horaires">Horaires</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-medium text-teal-700 hover:text-teal-600 transition-colors">Mon espace</a>
                    <a href="{{ route('logout') }}" class="flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-red-600 hover:text-red-700 border border-red-200 rounded-xl hover:bg-red-50 transition-all">
                        <span class="material-symbols-outlined text-[16px]">logout</span>
                        Déconnexion
                    </a>
                @else
                    <a class="px-5 py-2 text-sm font-medium text-teal-700 hover:text-teal-600 transition-colors" href="{{ url('/login') }}">Se connecter</a>
                    <a class="bg-gradient-to-br from-primary to-primary-container text-white px-6 py-2.5 rounded-xl text-sm font-semibold clinical-shadow scale-95 active:duration-150 transition-all" href="{{ url('/register') }}">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <header class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-surface-container-low via-surface to-primary/5 -z-10"></div>
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">

                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-on-surface leading-[1.1]">
                    Votre santé, <br /><span class="text-primary">notre priorité</span>.
                </h1>
                <p class="text-lg text-on-surface-variant max-w-xl leading-relaxed">
                    Une approche éditoriale de la médecine moderne. Alliant expertise clinique de pointe et confort d'un environnement serein pour votre bien-être total.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a class="bg-gradient-to-br from-primary to-primary-container text-white px-8 py-4 rounded-xl font-bold clinical-shadow hover:opacity-90 transition-all" href="{{ url('/dashboard')}}">
                        Prendre rendez-vous
                    </a>
                    <a class="bg-white text-on-surface px-8 py-4 rounded-xl font-bold shadow-sm hover:bg-surface-container-low transition-all" href="#services">
                        Nos services
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square rounded-[3rem] overflow-hidden rotate-2 clinical-shadow">
                    <img class="w-full h-full object-cover" data-alt="professional modern medical consultation room with bright sunlight, clinical white furniture, and a high-tech patient monitor setup" src="https://lh3.googleusercontent.com/aida-public/AB6AXuASAYN1xgtCp7_U_R12TweeJEW5vKwdy_dAvPUy4BTAaOh2IkI-oz_AMk8NyfP9Yg7z82v71152SyyNf-v11jasnglRP2uS2_xYsf1G9T1s3zI5lSjkU8SaB917OGZGKUmSoUx7LWP4YjrxccLZGvPU3j7qAEVYmSoSxyP33K2cqCxtXusPEEfK5emhbYRuhSiTnEhexcgqQa740x2cVR-jfydJDe5TKz2khXDRNlnKOj7brmxoodPPkt0B5hFrJ11-HnWA1qTULIc" />
                </div>
                <!-- Floating Medical Badge -->
                <div class="absolute -bottom-6 -left-6 glass-card p-6 rounded-2xl clinical-shadow border border-white/20">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl" data-weight="fill">star</span>
                        </div>
                        <div>
                            <div class="text-xl font-bold">4.9/5</div>
                            <div class="text-xs text-on-surface-variant font-medium uppercase tracking-wider">Note de satisfaction</div>
                        </div>
                    </div>
                </div>
                <!-- Decorative element -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-200/30 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </header>
    <!-- Services Section -->
    <section class="py-24 bg-surface-container-low" id="services">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col items-center text-center mb-16 space-y-4">
                <h2 class="text-3xl font-extrabold text-on-surface">Nos Services Spécialisés</h2>
                <p class="text-on-surface-variant max-w-2xl">Des soins complets adaptés à vos besoins spécifiques, portés par une équipe d'experts dévoués.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Cards -->
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">medical_information</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Consultation</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Diagnostic approfondi et écoute attentive pour établir votre parcours de soin personnalisé.</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">biotech</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Diagnostic</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Analyses médicales de pointe utilisant les dernières technologies de dépistage.</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">prescriptions</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Ordonnances</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Gestion sécurisée de vos prescriptions et renouvellements en toute simplicité.</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">monitoring</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Suivi Médical</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Accompagnement continu pour les pathologies chroniques ou post-opératoires.</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">calendar_month</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">RDV en Ligne</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Planifiez vos visites instantanément via notre plateforme sécurisée 24h/24.</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-[1.5rem] clinical-shadow hover:-translate-y-1 transition-transform group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 transition-colors group-hover:bg-primary group-hover:text-white">
                        <span class="material-symbols-outlined text-3xl">emergency</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Urgences</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Une prise en charge prioritaire pour les situations médicales nécessitant une attention immédiate.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer / Horaires Section -->
    <footer class="bg-slate-900 text-slate-400 py-20 mt-auto" id="horaires">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div class="space-y-8">
                <div class="text-teal-500 font-bold text-2xl">Cabinet Médical</div>
                <p class="text-slate-500 max-w-sm">Excellence clinique et approche humaine au cœur de notre pratique quotidienne.</p>
                <div class="bg-slate-800/50 p-8 rounded-3xl border border-slate-700/50">
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-teal-400">schedule</span>
                        Horaires d'ouverture
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span>Lundi - Vendredi (matin)</span>
                            <span class="text-white font-medium">08:00 - 12:00</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span>Lundi - Vendredi (après-midi)</span>
                            <span class="text-white font-medium">14:00 - 18:00</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span>Samedi</span>
                            <span class="text-red-400 font-bold uppercase text-[10px]">Fermé</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Dimanche</span>
                            <span class="text-red-400 font-bold uppercase text-[10px]">Fermé</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-teal-500 hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined text-lg">share</span>
                    </a>
                    <a class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-teal-500 hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined text-lg">mail</span>
                    </a>
                </div>
            </div>
            <div class="space-y-8">
                <div class="bg-slate-800/50 p-8 rounded-3xl border border-slate-700/50">
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-teal-400">location_on</span>
                        Nous trouver
                    </h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-teal-400 text-[18px] mt-0.5">home</span>
                            <span>123 Rue de Hassan 2, Guéliz, Marrakech</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-teal-400 text-[18px]">call</span>
                            <span>+212 641 371 472</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-teal-400 text-[18px]">mail</span>
                            <span>contact@cabinet-medical.ma</span>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-800/50 p-8 rounded-3xl border border-slate-700/50">
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-teal-400">calendar_month</span>
                        Prendre rendez-vous
                    </h3>
                    <p class="text-slate-400 text-sm mb-6">Réservez votre consultation en ligne facilement et rapidement via notre plateforme sécurisée.</p>
                    <a href="{{ url('/login') }}" class="inline-flex items-center gap-2 bg-teal-500 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-teal-400 transition-all">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        Se connecter pour réserver
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-20 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
            <div>© 2026 Cabinet Médical. Excellence Clinique.</div>
            <div class="flex gap-8">
                <a class="hover:text-teal-400 transition-colors" href="#">Mentions Légales</a>
                <a class="hover:text-teal-400 transition-colors" href="#">Confidentialité</a>
                <a class="hover:text-teal-400 transition-colors" href="#">Aide</a>
            </div>
        </div>
    </footer>
</body>

</html>
