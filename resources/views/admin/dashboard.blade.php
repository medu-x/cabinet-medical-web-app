<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tableau de Bord Analytique - Clinical Sanctuary</title>
     @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#008394",
                        "inverse-primary": "#75d4e7",
                        "inverse-on-surface": "#eff1f3",
                        "tertiary-fixed-dim": "#ffb782",
                        "error": "#ba1a1a",
                        "surface-tint": "#006876",
                        "tertiary": "#8d4e16",
                        "on-surface": "#191c1e",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-primary-fixed": "#001f25",
                        "on-background": "#191c1e",
                        "secondary-fixed-dim": "#b9c7df",
                        "secondary-container": "#d5e3fc",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-container": "#000608",
                        "surface-container-high": "#e6e8ea",
                        "primary-fixed-dim": "#75d4e7",
                        "tertiary-fixed": "#ffdcc5",
                        "on-tertiary-fixed-variant": "#703800",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-variant": "#e0e3e5",
                        "on-error": "#ffffff",
                        "background": "#f7f9fb",
                        "surface-dim": "#d8dadc",
                        "outline-variant": "#bdc8cb",
                        "on-secondary-container": "#57657a",
                        "on-surface-variant": "#3e494b",
                        "surface": "#f7f9fb",
                        "primary-fixed": "#a0efff",
                        "inverse-surface": "#2d3133",
                        "on-tertiary-fixed": "#301400",
                        "tertiary-container": "#ab662d",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "surface-bright": "#f7f9fb",
                        "secondary-fixed": "#d5e3fc",
                        "surface-container": "#eceef0",
                        "primary": "#006876",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-tertiary-container": "#0c0300",
                        "on-primary-fixed-variant": "#004e59",
                        "secondary": "#515f74",
                        "outline": "#6e797c",
                        "on-primary": "#ffffff"
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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .filled-icon {
            font-variation-settings: 'FILL' 1;
        }

        .custom-shadow {
            box-shadow: 0 4px 20px -2px rgba(0, 104, 118, 0.08), 0 10px 40px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="text-on-surface">
    <!-- SideNavBar Integration -->
    <aside
        class="h-screen w-64 fixed left-0 top-0 bg-slate-50 dark:bg-slate-950 flex flex-col p-4 space-y-2 z-40 hidden md:flex">
        <div class="px-4 py-6 mb-4">
            <h2 class="text-lg font-black text-teal-800 dark:text-teal-300">Sanctuary Health</h2>
            <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold">Clinical Excellence</p>
        </div>
        <nav class="flex-1 space-y-1">
            <a class="flex items-center gap-3 px-4 py-3 bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300 rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined filled-icon">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">calendar_today</span>
                <span class="text-sm font-medium">Appointments</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium">Patients</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">description</span>
                <span class="text-sm font-medium">Medical Records</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">medical_services</span>
                <span class="text-sm font-medium">Inventory</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-slate-200 space-y-1">
            <button
                class="w-full bg-gradient-to-br from-primary to-primary-container text-white rounded-xl py-3 px-4 text-sm font-bold flex items-center justify-center gap-2 custom-shadow mb-4">
                <span class="material-symbols-outlined text-sm">add</span>
                New Consultation
            </button>
            <a class="flex items-center gap-3 px-4 py-2 text-slate-600 hover:text-teal-700 text-xs font-medium"
                href="#">
                <span class="material-symbols-outlined text-lg">help_outline</span>
                Support
            </a>
            <a class="flex items-center gap-3 px-4 py-2 text-slate-600 hover:text-error text-xs font-medium"
                href="{{route('logout')}}">
                <span class="material-symbols-outlined text-lg">logout</span>
                Sign Out
            </a>
        </div>
    </aside>
    <!-- Main Content Area -->
    <main class="md:ml-64 min-h-screen flex flex-col">
        <!-- TopAppBar Integration -->
        <header
            class="bg-white/80 backdrop-blur-md sticky top-0 z-30 shadow-sm px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div
                    class="hidden lg:flex items-center bg-surface-container-low px-4 py-1.5 rounded-full border border-outline-variant/10">
                    <span class="material-symbols-outlined text-slate-400 mr-2 text-lg">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-sm w-64 p-0"
                        placeholder="Rechercher un dossier..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                </button>
                <button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
                    <span class="material-symbols-outlined">settings</span>
                </button>
                <div class="h-8 w-px bg-slate-200 mx-1"></div>
                <div class="flex items-center gap-3 pl-2">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">Dr. Smith</p>
                        <p class="text-[10px] text-slate-500">Administrateur</p>
                    </div>
                    <img alt="Dr. Smith's Profile" class="w-10 h-10 rounded-full object-cover ring-2 ring-teal-50"
                        data-alt="close-up portrait of a professional male doctor with short dark hair in white lab coat smiling warmly"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCM_tvBJXfOctEo7N0Ppthjh9-mX9FWP9mp-SKLctImsoahrx2mesFnHgJxyiUs-IyuOFp25yE0GslTDAC74uPXfWio3bfuBUo_3eAyKR15tx-q7q_modonWXNOHoCTHARgV4fVRXzyUUnxiHuVjE6Egq__Hu4vde_fretOOEFTwVPeRdo6RCcJjiKQ73tpsVd2eZTHoqr-lT1sNfuhx6HZXqc3Gkyn3REfAA_ZpvYaoZ24QzpTI_7WAJAaOVMVK9tbJYWw1skVEVg" />
                </div>
            </div>
        </header>
        <!-- Dashboard Content -->
        <section class="p-6 lg:p-8 space-y-8">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold tracking-tight text-on-surface">Aperçu Administratif</h2>
                    <p class="text-on-surface-variant mt-1">Données analytiques pour la période du 1er au 28 Octobre
                        2024</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="bg-surface-container-lowest px-4 py-2 rounded-xl text-sm font-medium border border-outline-variant/20 hover:bg-surface-container-low transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">calendar_month</span>
                        Derniers 30 jours
                    </button>
                    <button
                        class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-bold custom-shadow hover:brightness-110 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">download</span>
                        Exporter PDF
                    </button>
                </div>
            </div>
            <!-- Bento Grid - KPIs -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-[1.5rem] custom-shadow flex flex-col gap-4 border border-outline-variant/10">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-2xl">group</span>
                        </div>
                        <span
                            class="text-teal-600 text-xs font-bold bg-teal-50 px-2 py-1 rounded-lg flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">arrow_upward</span>
                            12%
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">Total Patients</p>
                        <p class="text-2xl font-black text-on-surface">1,284</p>
                    </div>
                </div>
                <!-- Stat Card 2 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-[1.5rem] custom-shadow flex flex-col gap-4 border border-outline-variant/10">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-primary-container/10 flex items-center justify-center">
                            <span
                                class="material-symbols-outlined text-primary-container text-2xl">event_available</span>
                        </div>
                        <span
                            class="text-teal-600 text-xs font-bold bg-teal-50 px-2 py-1 rounded-lg flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">arrow_upward</span>
                            8%
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">Consultations</p>
                        <p class="text-2xl font-black text-on-surface">432</p>
                    </div>
                </div>
                <!-- Stat Card 3 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-[1.5rem] custom-shadow flex flex-col gap-4 border border-outline-variant/10">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-tertiary-fixed/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-tertiary text-2xl">payments</span>
                        </div>
                        <span
                            class="text-error text-xs font-bold bg-error-container/30 px-2 py-1 rounded-lg flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">arrow_downward</span>
                            2%
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">Revenu Mensuel</p>
                        <p class="text-2xl font-black text-on-surface">€45,210</p>
                    </div>
                </div>
                <!-- Stat Card 4 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-[1.5rem] custom-shadow flex flex-col gap-4 border border-outline-variant/10">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-secondary-container/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-2xl">timer</span>
                        </div>
                        <span
                            class="text-teal-600 text-xs font-bold bg-teal-50 px-2 py-1 rounded-lg flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">trending_down</span>
                            15%
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-on-surface-variant">Attente Moyenne</p>
                        <p class="text-2xl font-black text-on-surface">14 min</p>
                    </div>
                </div>
            </div>
            <!-- Analysis Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Chart Area -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Consultations par Mois -->
                    <div
                        class="bg-surface-container-lowest p-8 rounded-[2rem] custom-shadow border border-outline-variant/10 h-[400px] flex flex-col">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-lg font-bold">Consultations par Mois</h3>
                            <select class="bg-surface-container-low border-none text-xs rounded-lg focus:ring-primary">
                                <option>Année 2024</option>
                                <option>Année 2023</option>
                            </select>
                        </div>
                        <div class="flex-1 flex items-end justify-between gap-2 px-4">
                            <!-- Simple Bar Mockup -->
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-32 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">JAN</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-44 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">FEV</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-36 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">MAR</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-56 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">AVR</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div class="w-full bg-primary rounded-t-lg h-72 shadow-lg shadow-primary/20"></div>
                                <span class="text-[10px] text-primary mt-2 font-black">MAI</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-48 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">JUN</span>
                            </div>
                            <div class="flex flex-col items-center flex-1 group">
                                <div
                                    class="w-full bg-teal-100 rounded-t-lg h-60 group-hover:bg-primary transition-all duration-300">
                                </div>
                                <span class="text-[10px] text-slate-400 mt-2 font-bold">JUL</span>
                            </div>
                        </div>
                    </div>
                    <!-- Analyse d'Efficacité -->
                    <div
                        class="bg-surface-container-lowest p-8 rounded-[2rem] custom-shadow border border-outline-variant/10">
                        <h3 class="text-lg font-bold mb-6">Analyse d'Efficacité Opérationnelle</h3>
                        <div class="space-y-6">
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-medium">Taux d'occupation des salles</span>
                                    <span class="font-bold text-primary">88%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full w-[88%]"></div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-medium">Résolution au premier contact</span>
                                    <span class="font-bold text-primary">94%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary-container rounded-full w-[94%]"></div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-medium">Vitesse de saisie des dossiers</span>
                                    <span class="font-bold text-tertiary">72%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-tertiary-container rounded-full w-[72%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Sidebar Column -->
                <div class="space-y-8">
                    <!-- Démographie des Patients -->
                    <div
                        class="bg-surface-container-lowest p-8 rounded-[2rem] custom-shadow border border-outline-variant/10 flex flex-col items-center">
                        <h3 class="text-lg font-bold mb-8 self-start">Démographie des Patients</h3>
                        <div class="relative w-48 h-48 mb-8">
                            <!-- Circular Pie Chart Representation -->
                            <svg class="w-full h-full -rotate-90" viewbox="0 0 36 36">
                                <circle cx="18" cy="18" fill="transparent" r="16" stroke="#e2e8f0"
                                    stroke-width="4"></circle>
                                <circle cx="18" cy="18" fill="transparent" r="16" stroke="#008394"
                                    stroke-dasharray="45 100" stroke-width="4"></circle>
                                <circle cx="18" cy="18" fill="transparent" r="16" stroke="#515f74"
                                    stroke-dasharray="30 100" stroke-dashoffset="-45" stroke-width="4"></circle>
                                <circle cx="18" cy="18" fill="transparent" r="16" stroke="#ffdcc5"
                                    stroke-dasharray="25 100" stroke-dashoffset="-75" stroke-width="4"></circle>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center flex-col">
                                <span class="text-2xl font-black">100%</span>
                                <span
                                    class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Répartition</span>
                            </div>
                        </div>
                        <div class="w-full grid grid-cols-2 gap-4">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-primary"></div>
                                <span class="text-xs font-medium">18-35 ans</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-secondary"></div>
                                <span class="text-xs font-medium">36-60 ans</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-tertiary-fixed"></div>
                                <span class="text-xs font-medium">60+ ans</span>
                            </div>
                        </div>
                    </div>
                    <!-- Activité Récente -->
                    <div
                        class="bg-surface-container-lowest p-8 rounded-[2rem] custom-shadow border border-outline-variant/10">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold">Activité Récente</h3>
                            <button class="text-primary text-xs font-bold hover:underline">Voir tout</button>
                        </div>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-teal-50 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Consultation terminée</p>
                                    <p class="text-xs text-on-surface-variant">Jean Dupont • Dr. Smith</p>
                                    <p class="text-[10px] text-slate-400 mt-1 italic">Il y a 14 min</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary-container/10 flex items-center justify-center shrink-0">
                                    <span
                                        class="material-symbols-outlined text-primary-container text-xl">add_card</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Nouveau rendez-vous</p>
                                    <p class="text-xs text-on-surface-variant">Marie Curie • Dentisterie</p>
                                    <p class="text-[10px] text-slate-400 mt-1 italic">Il y a 45 min</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-tertiary-fixed/30 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-tertiary text-xl">person_add</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Nouveau Patient créé</p>
                                    <p class="text-xs text-on-surface-variant">Albert Einstein • Dossier #4492</p>
                                    <p class="text-[10px] text-slate-400 mt-1 italic">Il y a 2 heures</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-error-container/30 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-error text-xl">event_busy</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Annulation</p>
                                    <p class="text-xs text-on-surface-variant">Thomas Edison • Ophtalmologie</p>
                                    <p class="text-[10px] text-slate-400 mt-1 italic">Il y a 3 heures</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer Integration -->
        <footer
            class="w-full py-6 mt-auto bg-white flex flex-col md:flex-row justify-between items-center px-8 border-t border-slate-200">
            <p class="text-xs font-inter text-slate-500">© 2024 Clinical Sanctuary. Tous droits réservés.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a class="text-xs text-slate-400 hover:text-teal-500 transition-colors" href="#">Politique de
                    Confidentialité</a>
                <a class="text-xs text-slate-400 hover:text-teal-500 transition-colors" href="#">Conditions
                    d'Utilisation</a>
                <a class="text-xs text-slate-400 hover:text-teal-500 transition-colors" href="#">Conformité
                    HIPAA</a>
            </div>
        </footer>
    </main>
    <!-- Mobile Bottom Navigation -->
    <nav
        class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.05)] flex md:hidden justify-around items-center py-2 z-50">
        <a class="flex flex-col items-center gap-1 text-teal-700" href="#">
            <span class="material-symbols-outlined filled-icon">dashboard</span>
            <span class="text-[10px] font-bold">Dash</span>
        </a>
        <a class="flex flex-col items-center gap-1 text-slate-400" href="#">
            <span class="material-symbols-outlined">calendar_today</span>
            <span class="text-[10px] font-medium">RDV</span>
        </a>
        <div class="bg-primary -mt-8 w-12 h-12 rounded-full flex items-center justify-center text-white shadow-lg">
            <span class="material-symbols-outlined">add</span>
        </div>
        <a class="flex flex-col items-center gap-1 text-slate-400" href="#">
            <span class="material-symbols-outlined">group</span>
            <span class="text-[10px] font-medium">Patients</span>
        </a>
        <a class="flex flex-col items-center gap-1 text-slate-400" href="#">
            <span class="material-symbols-outlined">description</span>
            <span class="text-[10px] font-medium">Docs</span>
        </a>
    </nav>
</body>

</html>
