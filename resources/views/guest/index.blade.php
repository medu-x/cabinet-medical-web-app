<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
            <div class="text-xl font-bold text-teal-800 dark:text-teal-300">Cabinet Médical</div>
            <div class="hidden md:flex gap-8 items-center">
                <a class="font-['Inter'] font-semibold text-sm tracking-tight text-teal-700 dark:text-teal-400 border-b-2 border-teal-700 hover:text-teal-600 transition-colors" href="#">Accueil</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#services">Services</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#a-propos">À propos</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#medecins">Médecins</a>
                <a class="font-['Inter'] font-medium text-sm tracking-tight text-slate-600 dark:text-slate-400 hover:text-teal-600 transition-colors" href="#contact">Contact</a>
            </div>
            <div class="flex items-center gap-4">
                <a class="px-5 py-2 text-sm font-medium text-teal-700 hover:text-teal-600 transition-colors" href="{{ url('/login') }}">Se connecter</a>
                <a class="bg-gradient-to-br from-primary to-primary-container text-white px-6 py-2.5 rounded-xl text-sm font-semibold clinical-shadow scale-95 active:duration-150 transition-all" href="{{url('/register')}}">S'inscrire</a>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <header class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-tr from-surface-container-low via-surface to-primary/5 -z-10"></div>
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase">
                    <span class="material-symbols-outlined text-base">verified_user</span>
                    Clinique Certifiée ISO 9001
                </div>
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
    <!-- À Propos Section -->
    <section class="py-24" id="a-propos">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative">
                        <div class="aspect-[4/5] rounded-[2rem] overflow-hidden">
                            <img class="w-full h-full object-cover" data-alt="professional medical team standing in a modern clinic hallway, wearing white coats and scrubs with warm confident expressions" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3T9qRpmyplWsbNGBXzzX1JZ8bYHxX3YmrAvVvydUYCIeVhpxritgq6xoZB4mu3OEyEnqaU9YSmLxYM1crt_bg5e2p3MJ5SNbcUBF5D1GDrqK3_iQTMn3H8NnCMjIKeNFSRqCYm0zzigq-GP9JO591_LSZADQN9nSvRqs-1njJhgsgpunwhWz9f2H6W-0TJZyqixmsQZuJmzVtdswqnf9ZCV2QyVPUJBTQezV8c5HjQA3oD7Lqq3d5eXl4nCpXP8RufUL4QViTCPQ" />
                        </div>
                        <div class="absolute -top-6 -right-6 bg-primary text-white p-8 rounded-3xl clinical-shadow">
                            <div class="text-4xl font-black">15+</div>
                            <div class="text-sm font-medium opacity-80 uppercase tracking-widest mt-1">Ans d'Excellence</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-6">
                    <h2 class="text-4xl font-extrabold leading-tight">Une tradition de confiance et d'innovation médicale.</h2>
                    <p class="text-on-surface-variant text-lg">Depuis plus de 15 ans, notre cabinet s'engage à offrir une médecine humaine, précise et accessible. Notre approche repose sur trois piliers : l'excellence clinique, le respect du patient et l'innovation constante.</p>
                    <div class="space-y-4 pt-4">
                        <div class="flex items-center gap-4">
                            <div class="w-6 h-6 rounded-full bg-teal-100 flex items-center justify-center text-teal-700">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <span class="font-semibold">Plus de 50,000 patients satisfaits</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-6 h-6 rounded-full bg-teal-100 flex items-center justify-center text-teal-700">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <span class="font-semibold">Équipement de diagnostic de dernière génération</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-6 h-6 rounded-full bg-teal-100 flex items-center justify-center text-teal-700">
                                <span class="material-symbols-outlined text-sm font-bold">check</span>
                            </div>
                            <span class="font-semibold">Réseau de spécialistes coordonné</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Médecins Section -->
    <section class="py-24 bg-surface-container" id="medecins">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-end mb-16">
                <div class="max-w-xl">
                    <h2 class="text-3xl font-extrabold mb-4">Nos Médecins Experts</h2>
                    <p class="text-on-surface-variant">Une équipe multidisciplinaire dédiée à votre santé, formée dans les meilleures facultés de médecine.</p>
                </div>
                <button class="hidden md:block text-primary font-bold hover:underline">Voir toute l'équipe</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Doctor Card -->
                <div class="bg-surface-container-lowest p-4 rounded-[2rem] clinical-shadow group">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4">
                        <img class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-500" data-alt="professional male doctor in a white lab coat with a stethoscope around his neck, smiling warmly against a clean clinical background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDlQoNnn52ukm-invfpgwdU4qL4eHdDkl5tQRYycOJBktgGZdcjQflaZ8KFZeFEye-vuysu4d3MBVqKxtP6G3KCVqPVyBlOYA3jzrhjKM-T5AAnfv7QaQk0EDgeZDleITstQvSvJq0dLPzm96nNMEgBrsppGcHPK8gHSKQaROsy4Z5TiSS3u9E-owPQvGvnmeAoMuJAtDqkmGuP-nh7O2k7_llpo8Hfl4owJsLJBmNtr3s0Q2DiVdT0HhQXQ_cizse5forTPL2BO64" />
                    </div>
                    <div class="px-2 pb-2">
                        <h4 class="text-lg font-bold">Dr. Jean Dupont</h4>
                        <p class="text-primary text-sm font-medium">Cardiologue</p>
                        <div class="flex items-center gap-1 mt-3">
                            <span class="material-symbols-outlined text-sm text-tertiary-container" data-weight="fill">star</span>
                            <span class="text-xs font-bold">4.9 (120 avis)</span>
                        </div>
                    </div>
                </div>
                <!-- Doctor Card -->
                <div class="bg-surface-container-lowest p-4 rounded-[2rem] clinical-shadow group">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4">
                        <img class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-500" data-alt="female doctor with glasses and white coat, looking professional and approachable in a modern medical office setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2y5x50P1r40EsZVYPW5G2A-ne1mjMRS1IvhcCtFXrvFy8dRZnKvNspn2lHxVM8xjRUeKVT6rfNo1T9mv71Y7mFQ_MHsVYyhPgGLRWd8-17ibuYNESnq19XPcUrJ-3yxPcupnaN33Fsyn2ld26hTOfqxDxY0YniS713qlp75S1oHrb4y8j6LzdSs-2wsw-xoPqLM0woaedfGFx5TYpGVDtx2UtRcrMGNxSNzYz1Y4iSogkvy2_-R88vO3hRbNlhvne0cxDrLgl8q0" />
                    </div>
                    <div class="px-2 pb-2">
                        <h4 class="text-lg font-bold">Dr. Sarah Martin</h4>
                        <p class="text-primary text-sm font-medium">Pédiatre</p>
                        <div class="flex items-center gap-1 mt-3">
                            <span class="material-symbols-outlined text-sm text-tertiary-container" data-weight="fill">star</span>
                            <span class="text-xs font-bold">5.0 (98 avis)</span>
                        </div>
                    </div>
                </div>
                <!-- Doctor Card -->
                <div class="bg-surface-container-lowest p-4 rounded-[2rem] clinical-shadow group">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4">
                        <img class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-500" data-alt="male surgeon in blue scrubs looking focused and professional in a bright clinical hallway" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1NAR5idezKhtRh2ETqND28Mu-TTDTEdYONwjHQXtQpDvUMX93tHz6yYI486v5pfhy-cA26OcKQkSHD6wIOLj1lZxwms1wJxAfwvsJMFvLdRdebQF97zn-ntR1vuPYc8Ka27jJHgn9WVZ6t1eJ2_EZDgK0Jh7aeprMkZ5VTppfi22flAofOQY_9a7tVzN1mN8bSOwSYMjHpbnfbUm4endXS-2W95b5ghLUB6GirErVqUTYxbi96lTGsaEZAedvXeD8QXconFDUCTE" />
                    </div>
                    <div class="px-2 pb-2">
                        <h4 class="text-lg font-bold">Dr. Marc Leroy</h4>
                        <p class="text-primary text-sm font-medium">Généraliste</p>
                        <div class="flex items-center gap-1 mt-3">
                            <span class="material-symbols-outlined text-sm text-tertiary-container" data-weight="fill">star</span>
                            <span class="text-xs font-bold">4.8 (215 avis)</span>
                        </div>
                    </div>
                </div>
                <!-- Doctor Card -->
                <div class="bg-surface-container-lowest p-4 rounded-[2rem] clinical-shadow group">
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4">
                        <img class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-500" data-alt="portrait of a female medical professional in scrubs with a digital tablet, smiling in a clinical workspace" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnj_Ieoxuv3CEyze-ZGM-vy0u-e32u7eh84Qnp3LFkRzfAON5LYqwPHquOnJIp9DmmuoMsZm02WUWHIQDQTwsRtVgbf1EvwuW0pvGGfziY-2SnEevVJM25W0cZzo0VjjjLnddhLxK7uR1FGsNEAA_n5pMQIE7QMUy3HGoidV60j9CjSDCJc6EmhLFqTnbY8oOORLJZ1zEqBr3rq4kTAPyuDNnQHOwR2H8Iw357btYBPLQXnvCm4wp4Cz-PFXSpRVaAB18g5FcNYIY" />
                    </div>
                    <div class="px-2 pb-2">
                        <h4 class="text-lg font-bold">Dr. Elena Costa</h4>
                        <p class="text-primary text-sm font-medium">Dermatologue</p>
                        <div class="flex items-center gap-1 mt-3">
                            <span class="material-symbols-outlined text-sm text-tertiary-container" data-weight="fill">star</span>
                            <span class="text-xs font-bold">4.9 (85 avis)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer / Contact Section -->
    <footer class="bg-slate-900 text-slate-400 py-20 mt-auto" id="contact">
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
                            <span>Lundi - Vendredi</span>
                            <span class="text-white font-medium">08:00 - 20:00</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-700 pb-2">
                            <span>Samedi</span>
                            <span class="text-white font-medium">09:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Dimanche</span>
                            <span class="text-teal-500 font-bold uppercase text-[10px]">Urgences uniquement</span>
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
            <div class="bg-white p-10 rounded-[2rem] clinical-shadow">
                <h3 class="text-2xl font-bold text-on-surface mb-6">Contactez-nous</h3>
                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Nom</label>
                            <input class="w-full bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all text-on-surface" placeholder="Jean" type="text" />
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Prénom</label>
                            <input class="w-full bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all text-on-surface" placeholder="Dupont" type="text" />
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Email</label>
                        <input class="w-full bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all text-on-surface" placeholder="jean.dupont@email.com" type="email" />
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Message</label>
                        <textarea class="w-full bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all text-on-surface" placeholder="Comment pouvons-nous vous aider ?" rows="4"></textarea>
                    </div>
                    <button class="w-full bg-primary text-white py-4 rounded-xl font-bold clinical-shadow hover:bg-primary-container transition-all" type="submit">Envoyer le message</button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-8 mt-20 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
            <div>© 2024 Cabinet Médical. Excellence Clinique.</div>
            <div class="flex gap-8">
                <a class="hover:text-teal-400 transition-colors" href="#">Mentions Légales</a>
                <a class="hover:text-teal-400 transition-colors" href="#">Confidentialité</a>
                <a class="hover:text-teal-400 transition-colors" href="#">Aide</a>
            </div>
        </div>
    </footer>
</body>

</html>