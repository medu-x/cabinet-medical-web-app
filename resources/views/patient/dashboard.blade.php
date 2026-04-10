<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="bg-surface font-body text-on-surface antialiased">
    <!-- TopNavBar -->
    <nav id="navbar" class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50 w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a class="flex items-center gap-2" href="#">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-2xl">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-teal-800 dark:text-teal-300">Cabinet Médical</span>
                </a>
                <div class="hidden md:flex gap-8">
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Accueil</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Services</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">À propos</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Médecins</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Contact</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors rounded-full relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                </button>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                <div class="flex items-center gap-3 pl-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">Dr. Smith</p>
                        <p class="text-[10px] text-on-surface-variant">Administrateur</p>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-fixed shadow-sm">
                        <img alt="Dr. Smith's Profile" data-alt="portrait of a professional male doctor with a kind expression wearing a white coat and stethoscope in a bright clinical setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAlWR3IYhs7cheWJwvGMiMXTHluzy-gr0Oa-BZJcHqDevNmTfgCfhxq8oqAEVWmsGEwIO9oGdscUE93cId5NUOgZgQc2JVBUeRYdlgnqEgQwogW-cPEzO4Pd7HAqI89ETZ_pWwkl8SC1wwGYoPnesagLdhguKfNyuSolW8dFPNfV8M2i5Gni5P7v90aT7qZvzbqggvIqeWhhmsLRgAw4VgLiPWIaBXVzwTtHBE5r6LlqadXVX_izdB6SqMLsFW2-uZnmGdA3-Ax6g" />
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-4 py-8 md:py-12 flex flex-col lg:flex-row gap-8">
        <!-- Left: Form Stepper Canvas -->
        <div class="flex-1 space-y-8">
            <header>
                <h1 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">Prendre un rendez-vous</h1>
                <p class="text-on-surface-variant">Suivez les étapes ci-dessous pour planifier votre consultation.</p>
            </header>
            <!-- Stepper Progress -->
            <div class="flex items-center justify-between max-w-2xl">
                <div class="flex flex-col items-center gap-2 group">
                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">1</div>
                    <span class="text-xs font-semibold text-primary">Spécialité</span>
                </div>
                <div class="flex-1 h-px bg-outline-variant mx-4 mb-6"></div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold">2</div>
                    <span class="text-xs font-medium text-on-surface-variant">Spécialiste</span>
                </div>
                <div class="flex-1 h-px bg-outline-variant mx-4 mb-6"></div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold">3</div>
                    <span class="text-xs font-medium text-on-surface-variant">Heure</span>
                </div>
            </div>
            <!-- Bento Grid Section: Step 1 - Choisir une Spécialité -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-3">
                    <h2 class="text-lg font-bold text-teal-800 mb-4">1. Choisir une Spécialité</h2>
                </div>
                <!-- Category Cards -->
                <button class="group p-6 rounded-xl bg-surface-container-lowest border border-transparent hover:border-primary/20 transition-all text-left shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                        <span class="material-symbols-outlined">cardiology</span>
                    </div>
                    <h3 class="font-bold text-on-surface mb-1">Cardiologie</h3>
                    <p class="text-xs text-on-surface-variant">Santé cardiaque et vasculaire</p>
                </button>
                <button class="group p-6 rounded-xl bg-surface-container-lowest border border-primary/40 ring-2 ring-primary/10 transition-all text-left shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined">neurology</span>
                    </div>
                    <h3 class="font-bold text-on-surface mb-1">Neurologie</h3>
                    <p class="text-xs text-on-surface-variant">Troubles du système nerveux</p>
                </button>
                <button class="group p-6 rounded-xl bg-surface-container-lowest border border-transparent hover:border-primary/20 transition-all text-left shadow-sm hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4 transition-transform group-hover:scale-110">
                        <span class="material-symbols-outlined">dermatology</span>
                    </div>
                    <h3 class="font-bold text-on-surface mb-1">Dermatologie</h3>
                    <p class="text-xs text-on-surface-variant">Soins de la peau et esthétique</p>
                </button>
            </section>
            <!-- Step 2: Spécialistes Disponibles -->
            <section class="space-y-4">
                <h2 class="text-lg font-bold text-teal-800">2. Spécialistes Disponibles</h2>
                <div class="grid grid-cols-1 gap-4">
                    <!-- Specialist Card 1 -->
                    <div class="flex items-center p-4 rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer border border-transparent hover:border-primary/20">
                        <img alt="Dr. Claire Vallet" class="w-16 h-16 rounded-lg object-cover" data-alt="headshot of a confident female neurologist with dark hair and glasses in a modern medical clinic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkG4oTDpspnxPYFSy9hkflYMeUbdsaEL_1lPns68rGweieK9rEMEvQFiUiG9Tl4E3M48ExNfCMDxY5QnzQbcFn0uZN11IJ9VgGuMtyWlt2sdU7o5F2Yyq7FM4SoOoK7YQvQiDOQA6H4s81HLq3bBbl-DZ0GSIfb94MkkjITBskrzNhwBGyWzB1mhha6tyWQfMRN9aYpf2KTFAsyegBY0o3oEi0rB8iKpcoZM_dI2CoRh3oB-MgCeuPLFdXR-rv8N8xyzGcvT02z8c" />
                        <div class="ml-4 flex-1">
                            <h4 class="font-bold text-on-surface">Dr. Claire Vallet</h4>
                            <p class="text-xs text-on-surface-variant">Neurologue Senior • 12 ans d'exp.</p>
                            <div class="flex items-center mt-1 gap-1">
                                <span class="material-symbols-outlined text-yellow-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs font-bold">4.9</span>
                                <span class="text-xs text-on-surface-variant">(120 avis)</span>
                            </div>
                        </div>
                        <div class="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold">Disponible aujourd'hui</div>
                    </div>
                    <!-- Specialist Card 2 -->
                    <div class="flex items-center p-4 rounded-xl bg-surface-container-lowest border border-primary shadow-sm">
                        <img alt="Dr. Marc Antoine" class="w-16 h-16 rounded-lg object-cover" data-alt="portrait of a professional male doctor with a warm smile in a teal scrubs against a soft blurred hospital background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBzoeSlOy9oADoHiudDt3psnyoJHxq4TwAS4QNDfTGsSyyeyUru-VNwMKFYwsslj7v4jHYV6lZ5RCSZMUMNKMDLWFnUK-l-KuSbE7zPHnIE7DuRyVHPZakoFGJ2T7rX3p4LC57ygmDXY4G91lFm3KUTCaiO1e1DUlPCIH-znTaNh5cGcqpvqmX1kPdwjai50hUq_PJN7olNMXcFoQ1NncGP2lae4NDQ8WZG9wZPXhCwMXSp53WE_PJMqnekNsd4WWDNvuagYsLwuQ" />
                        <div class="ml-4 flex-1">
                            <h4 class="font-bold text-on-surface">Dr. Marc Antoine</h4>
                            <p class="text-xs text-on-surface-variant">Spécialiste en Neurochirurgie</p>
                            <div class="flex items-center mt-1 gap-1">
                                <span class="material-symbols-outlined text-yellow-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs font-bold">5.0</span>
                                <span class="text-xs text-on-surface-variant">(85 avis)</span>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                    </div>
                </div>
            </section>
            <!-- Step 3: Choisir l'Heure -->
            <section class="space-y-4">
                <h2 class="text-lg font-bold text-teal-800">3. Choisir l'Heure</h2>
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10">
                    <div class="flex justify-between items-center mb-6">
                        <button class="p-2 hover:bg-surface-container-low rounded-lg transition-colors"><span class="material-symbols-outlined">chevron_left</span></button>
                        <h3 class="font-bold">Mardi, 24 Octobre 2024</h3>
                        <button class="p-2 hover:bg-surface-container-low rounded-lg transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
                    </div>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">09:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">09:30</button>
                        <button class="py-2 rounded-lg bg-primary text-white text-xs font-bold shadow-md shadow-primary/20">10:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">10:30</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium opacity-40 cursor-not-allowed">11:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">11:30</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">14:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">14:30</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">15:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">15:30</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">16:00</button>
                        <button class="py-2 rounded-lg bg-surface-container-low text-xs font-medium hover:bg-primary hover:text-white transition-colors">16:30</button>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right: Résumé de la Réservation Sidebar -->
        <aside class="w-full lg:w-96">
            <div class="sticky top-24 space-y-6">
                <!-- Insurance Alert -->
                <div class="bg-teal-50  p-4 rounded-xl flex items-start gap-3 border border-teal-100 ">
                    <span class="material-symbols-outlined text-teal-600" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    <div>
                        <p class="text-sm font-bold text-teal-800 ">Assurance Vérifiée</p>
                        <p class="text-xs text-teal-700 ">Votre couverture santé est active pour cet établissement.</p>
                    </div>
                </div>
                <!-- Booking Summary Card -->
                <div class="glass-card rounded-3xl p-8 shadow-xl shadow-primary/5 border border-white/50">
                    <h2 class="text-xl font-bold text-on-surface mb-6">Résumé de la Réservation</h2>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">medical_information</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Spécialité</p>
                                <p class="font-bold text-on-surface">Neurologie</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Spécialiste</p>
                                <p class="font-bold text-on-surface">Dr. Marc Antoine</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">calendar_today</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Date &amp; Heure</p>
                                <p class="font-bold text-on-surface">24 Oct. 2024 • 10:00</p>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-outline-variant/20">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-on-surface-variant">Consultation</span>
                                <span class="font-bold">65,00 €</span>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-on-surface-variant">Frais de dossier</span>
                                <span class="text-teal-600 font-bold">OFFERT</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-black text-teal-800">
                                <span>Total</span>
                                <span>65,00 €</span>
                            </div>
                        </div>
                        <button class="w-full py-4 rounded-2xl bg-gradient-to-br from-primary to-primary-container text-white font-bold text-lg shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform flex items-center justify-center gap-2">
                            <span>Confirmer le Rendez-vous</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        <p class="text-[10px] text-center text-on-surface-variant px-4">
                            En confirmant, vous acceptez nos <a class="underline" href="#">Conditions d'Utilisation</a> et notre <a class="underline" href="#">Politique de Confidentialité</a>.
                        </p>
                    </div>
                </div>
                <!-- Assistance Card -->
                <div class="p-6 rounded-2xl bg-surface-container-high border border-outline-variant/10 text-center">
                    <p class="text-sm font-medium mb-3">Besoin d'aide pour réserver ?</p>
                    <a class="inline-flex items-center gap-2 text-primary font-bold hover:underline" href="tel:+33123456789">
                        <span class="material-symbols-outlined text-sm">call</span>
                        01 23 45 67 89
                    </a>
                </div>
            </div>
        </aside>
    </main>
    <!-- Footer -->
    <footer class="w-full py-6 mt-auto bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs font-inter text-slate-500 mb-4 md:mb-0">
            © 2024 Cabinet Médical. All rights reserved.
        </div>
        <div class="flex gap-6">
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Privacy Policy</a>
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Terms of Service</a>
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">HIPAA Compliance</a>
        </div>
    </footer>
</body>

</html>