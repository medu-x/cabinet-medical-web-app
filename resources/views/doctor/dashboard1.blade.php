<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-badge {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body overflow-hidden">
    <!-- SideNavBar Component -->
    <aside
        class="fixed left-0 top-0 h-full flex flex-col p-4 z-40 bg-slate-50 dark:bg-slate-900 border-r-0 w-64 shadow-sm dark:shadow-none font-['Inter'] text-sm font-medium">
        <div class="flex items-center gap-3 mb-8 px-2">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white">
                <span class="material-symbols-outlined" data-icon="medical_services">medical_services</span>
            </div>
            <div>
                <h1 class="text-lg font-black text-teal-800 dark:text-teal-300 leading-none">Cabinet Médical</h1>
                <p class="text-[10px] uppercase tracking-wider text-slate-500 font-bold mt-1">Clinical Excellence</p>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <a class="flex items-center gap-3 px-4 py-3 bg-teal-50 dark:bg-teal-900/30 text-teal-800 dark:text-teal-200 rounded-xl font-bold Active: translate-x-1 duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                Tableau de bord
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all"
                href="#">
                <span class="material-symbols-outlined" data-icon="calendar_today">calendar_today</span>
                Rendez-vous
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all"
                href="#">
                <span class="material-symbols-outlined" data-icon="group">group</span>
                Patients
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all"
                href="#">
                <span class="material-symbols-outlined" data-icon="assessment">assessment</span>
                Rapports
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all"
                href="#">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                Paramètres
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-slate-200 dark:border-slate-800">
            <button
                class="w-full py-3 px-4 bg-primary text-white rounded-xl font-semibold flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">
                <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                Nouvelle Consultation
            </button>
            <div class="flex items-center gap-3 mt-6 px-2">
                <img alt="Dr. Profile Picture" class="w-10 h-10 rounded-full object-cover border-2 border-primary/10"
                    data-alt="professional close-up portrait of a confident male doctor in his 40s wearing a white clinical coat with soft studio lighting"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxkI9LSN9k6-Yf7cPkhJJeCRUuazGkAu-hdq1cNJJ_TDWEenghbQSC70i8Cwqkv6nUGRNrn64WzMsxKMJPPFw_u1J_m39owaWX0fFLq9wviRzycQoWecq0VQLU145LMVlc8Oo_1nF0PhTbc43yuQ6F9XcMs-tq0MxYQhwJR5220EREkjJBf1qI6KrkCPJ1uqYoqeog2KzP0Msa07q0_7FfMC7_JiwsbBwKSxNxKv8ZnB2ba9Z3uhUYWbryP0KAHGqQn9IwlzglUek" />
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-on-surface truncate">Dr. Julien Morel</p>
                    <p class="text-[10px] text-on-surface-variant">Cardiologue</p>
                </div>
            </div>
        </div>
    </aside>
    <!-- Main Workspace -->
    <main class="ml-64 h-screen bg-surface-container-low flex flex-col">
        <!-- Header / Top Bar -->
        <header
            class="h-16 flex items-center justify-between px-8 bg-surface-container-low/50 backdrop-blur-sm sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-bold text-on-surface tracking-tight">Tableau de bord</h2>
                <div class="h-4 w-[1px] bg-outline-variant/30"></div>
                <p class="text-sm text-on-surface-variant font-medium">Lundi 14 Octobre, 2024</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 rounded-full hover:bg-surface-container transition-colors text-on-surface-variant">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>
                <button class="p-2 rounded-full hover:bg-surface-container transition-colors text-on-surface-variant">
                    <span class="material-symbols-outlined" data-icon="search">search</span>
                </button>
            </div>
        </header>
        <!-- Content Grid -->
        <div class="flex-1 p-6 grid grid-cols-12 gap-6 overflow-hidden">
            <!-- Left Column: Queue -->
            <section class="col-span-3 flex flex-col gap-6 overflow-hidden">
                <div
                    class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-outline-variant/10 flex flex-col h-full overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary"
                                data-icon="pending_actions">pending_actions</span>
                            File d'attente
                        </h3>
                        <span
                            class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-lg uppercase tracking-wider">8
                            Patients</span>
                    </div>
                    <div class="flex-1 overflow-y-auto space-y-4 pr-1">
                        <!-- Active Patient -->
                        <div
                            class="p-4 bg-primary text-on-primary rounded-xl shadow-md flex flex-col gap-2 border border-primary/20">
                            <div class="flex justify-between items-start">
                                <span class="text-[10px] font-bold uppercase opacity-80">En consultation</span>
                                <span class="text-[10px] font-bold">14:00</span>
                            </div>
                            <p class="font-bold text-sm">Mme. Sophie Laurent</p>
                            <p class="text-xs opacity-90">Contrôle Post-opératoire</p>
                        </div>
                        <!-- Waiting Patients -->
                        <div
                            class="p-4 bg-surface-container-low hover:bg-surface-container rounded-xl transition-all cursor-pointer border border-transparent hover:border-outline-variant/20">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-[10px] font-bold text-primary uppercase">Suivant</span>
                                <span class="text-[10px] text-on-surface-variant">14:30</span>
                            </div>
                            <p class="font-bold text-sm text-on-surface">M. Thomas Bernard</p>
                            <p class="text-xs text-on-surface-variant">Douleurs thoraciques</p>
                        </div>
                        <div
                            class="p-4 bg-surface-container-low hover:bg-surface-container rounded-xl transition-all cursor-pointer border border-transparent hover:border-outline-variant/20 opacity-70">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-[10px] font-bold text-on-surface-variant uppercase">Attente</span>
                                <span class="text-[10px] text-on-surface-variant">15:00</span>
                            </div>
                            <p class="font-bold text-sm text-on-surface">Mme. Claire Petit</p>
                            <p class="text-xs text-on-surface-variant">Renouvellement ordonnance</p>
                        </div>
                        <div
                            class="p-4 bg-surface-container-low hover:bg-surface-container rounded-xl transition-all cursor-pointer border border-transparent hover:border-outline-variant/20 opacity-70">
                            <div class="flex justify-between items-start mb-1">
                                <span class="text-[10px] font-bold text-on-surface-variant uppercase">Attente</span>
                                <span class="text-[10px] text-on-surface-variant">15:30</span>
                            </div>
                            <p class="font-bold text-sm text-on-surface">M. Lucas Martin</p>
                            <p class="text-xs text-on-surface-variant">Consultation annuelle</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Center/Right: Active Consultation -->
            <section class="col-span-9 flex flex-col gap-6 overflow-hidden">
                <!-- Patient Info Header -->
                <div
                    class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <img alt="Sophie Laurent" class="w-16 h-16 rounded-2xl object-cover"
                                data-alt="studio portrait of a middle-aged woman with friendly expression and blond hair wearing a casual blue shirt"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA64bwwjVbTSQnrdWjYea2bIhf9u-cO-qm7XvH5Lycf3F4MGuA8CbCiq8DyA37hK--tmpJGWa0HCfe_RXR9IFXC9p3P7TCbk95uxvFCCx4DZATwnlEndL3thg4Q3fV5Bk4ttGyTMDV7mwHGyd7sHaKPZ9Loxi5oDkp_RKjtz6yOrItiV0k8dkwxTYN11ZlY2QKOe2cDYVaRODEB9GEXq3_FRrb0McMLUKKyVisRvTox7RsiJdIEDCaQSDCyRDfijKmVDJ2ZiW3WY84" />
                            <div
                                class="absolute -bottom-2 -right-2 glass-badge px-2 py-1 rounded-lg text-[10px] font-bold text-primary shadow-sm">
                                ID: 8429</div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-on-surface tracking-tight">Sophie Laurent</h3>
                            <div class="flex items-center gap-4 mt-1">
                                <span class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]"
                                        data-icon="female">female</span> 42 ans
                                </span>
                                <span class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]"
                                        data-icon="height">height</span> 168 cm
                                </span>
                                <span class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]"
                                        data-icon="weight">weight</span> 64 kg
                                </span>
                                <span
                                    class="px-2 py-0.5 bg-error-container text-on-error-container text-[10px] font-bold rounded-md">GROUPE
                                    A-</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 rounded-xl text-primary font-bold bg-primary/10 hover:bg-primary/20 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]" data-icon="history">history</span>
                            Dossier Complet
                        </button>
                        <button
                            class="px-4 py-2 rounded-xl bg-primary text-on-primary font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]"
                                data-icon="check_circle">check_circle</span>
                            Terminer
                        </button>
                    </div>
                </div>
                <div class="flex-1 grid grid-cols-2 gap-6 overflow-hidden">
                    <!-- Medical Report Editor -->
                    <div
                        class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-on-surface flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary"
                                    data-icon="description">description</span>
                                Rapport Médical
                            </h4>
                            <div class="flex gap-1">
                                <button class="p-1.5 rounded-lg hover:bg-surface-container transition-colors"><span
                                        class="material-symbols-outlined text-[18px]"
                                        data-icon="format_bold">format_bold</span></button>
                                <button class="p-1.5 rounded-lg hover:bg-surface-container transition-colors"><span
                                        class="material-symbols-outlined text-[18px]"
                                        data-icon="format_italic">format_italic</span></button>
                                <button class="p-1.5 rounded-lg hover:bg-surface-container transition-colors"><span
                                        class="material-symbols-outlined text-[18px]"
                                        data-icon="format_list_bulleted">format_list_bulleted</span></button>
                            </div>
                        </div>
                        <div class="flex-1">
                            <textarea
                                class="w-full h-full bg-surface-container-low border-0 focus:ring-2 focus:ring-primary/20 rounded-xl p-4 text-sm text-on-surface placeholder:text-on-surface-variant/40 resize-none font-body leading-relaxed"
                                placeholder="Saisissez les observations cliniques ici..."></textarea>
                        </div>
                        <div class="mt-4 flex items-center gap-3">
                            <span class="text-[10px] font-bold text-on-surface-variant/60 uppercase">Dernière
                                sauvegarde: 14:12</span>
                        </div>
                    </div>
                    <!-- Prescription Form -->
                    <div
                        class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex flex-col">
                        <h4 class="font-bold text-on-surface flex items-center gap-2 mb-6">
                            <span class="material-symbols-outlined text-primary"
                                data-icon="prescriptions">prescriptions</span>
                            Ordonnance Numérique
                        </h4>
                        <div class="space-y-4 flex-1 overflow-y-auto pr-1">
                            <!-- Drug Entry 1 -->
                            <div
                                class="p-4 bg-surface-container rounded-xl border border-outline-variant/20 relative group">
                                <button
                                    class="absolute top-2 right-2 text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[18px]" data-icon="close">close</span>
                                </button>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="col-span-2">
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Médicament</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm font-semibold py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="Amoxicilline 500mg" />
                                    </div>
                                    <div>
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Posologie</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="1 gélule" />
                                    </div>
                                    <div>
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Fréquence</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="3x par jour" />
                                    </div>
                                </div>
                            </div>
                            <!-- Drug Entry 2 -->
                            <div
                                class="p-4 bg-surface-container rounded-xl border border-outline-variant/20 relative group">
                                <button
                                    class="absolute top-2 right-2 text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[18px]" data-icon="close">close</span>
                                </button>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="col-span-2">
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Médicament</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm font-semibold py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="Doliprane 1000mg" />
                                    </div>
                                    <div>
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Posologie</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="Si douleur" />
                                    </div>
                                    <div>
                                        <label
                                            class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Fréquence</label>
                                        <input
                                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30"
                                            type="text" value="Max 4/jour" />
                                    </div>
                                </div>
                            </div>
                            <!-- Add New -->
                            <button
                                class="w-full py-3 border-2 border-dashed border-outline-variant/30 rounded-xl text-on-surface-variant font-bold text-xs hover:border-primary/40 hover:text-primary transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]"
                                    data-icon="add_circle">add_circle</span>
                                Ajouter un médicament
                            </button>
                        </div>
                        <div class="mt-6 pt-4 border-t border-outline-variant/10 flex justify-between items-center">
                            <button class="text-primary text-sm font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined" data-icon="print">print</span>
                                Imprimer
                            </button>
                            <button
                                class="px-6 py-2 bg-secondary text-white font-bold rounded-xl text-sm shadow-md hover:bg-secondary/90 transition-colors">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
