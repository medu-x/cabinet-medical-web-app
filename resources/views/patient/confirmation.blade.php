<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Confirmation de Rendez-vous - Clinical Excellence</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap"
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
                        "surface-container-low": "#f2f4f6",
                        "on-primary": "#ffffff",
                        "tertiary": "#8d4e16",
                        "on-tertiary-fixed-variant": "#703800",
                        "on-surface-variant": "#3e494b",
                        "on-secondary-fixed": "#0d1c2e",
                        "surface-tint": "#006876",
                        "inverse-on-surface": "#eff1f3",
                        "secondary-container": "#d5e3fc",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "primary-fixed-dim": "#75d4e7",
                        "on-primary-fixed-variant": "#004e59",
                        "on-error": "#ffffff",
                        "secondary": "#515f74",
                        "on-surface": "#191c1e",
                        "surface-container-high": "#e6e8ea",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-container-highest": "#e0e3e5",
                        "primary-fixed": "#a0efff",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#191c1e",
                        "outline": "#6e797c",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#ab662d",
                        "on-primary-container": "#000608",
                        "surface": "#f7f9fb",
                        "primary-container": "#008394",
                        "tertiary-fixed": "#ffdcc5",
                        "surface-container": "#eceef0",
                        "on-tertiary-fixed": "#301400",
                        "inverse-primary": "#75d4e7",
                        "surface-bright": "#f7f9fb",
                        "on-tertiary-container": "#0c0300",
                        "tertiary-fixed-dim": "#ffb782",
                        "on-secondary-fixed-variant": "#3a485b",
                        "primary": "#006876",
                        "on-primary-fixed": "#001f25",
                        "outline-variant": "#bdc8cb",
                        "inverse-surface": "#2d3133",
                        "surface-dim": "#d8dadc",
                        "on-secondary-container": "#57657a",
                        "secondary-fixed": "#d5e3fc",
                        "background": "#f7f9fb",
                        "surface-variant": "#e0e3e5",
                        "on-tertiary": "#ffffff"
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
            }
        }
    </script>
    <style>
        .glass-badge {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px -2px rgba(0, 104, 118, 0.08), 0 10px 40px -5px rgba(0, 0, 0, 0.04);
        }

        .clinical-gradient {
            background: linear-gradient(135deg, #006876 0%, #008394 100%);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .fill-icon {
            font-variation-settings: 'FILL' 1;
        }
        @media print {
    nav,
    footer,
     body * {
        visibility: hidden;
    }
   #print-area,
    #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: white;
        padding: 30px;
    }

    .no-print {
        display: none !important;
    }
}

    </style>
</head>

<body class="bg-surface font-body text-on-surface antialiased">
    <!-- TopNavBar -->
    <nav id="navbar"
        class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50 w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a class="flex items-center gap-2" href="#">
                    <div
                        class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-2xl">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-teal-800 dark:text-teal-300">Cabinet
                        Médical</span>
                </a>
                <div class="hidden md:flex gap-8">
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium"
                        href="#">Accueil</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium"
                        href="#">Services</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">À
                        propos</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium"
                        href="#">Médecins</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium"
                        href="#">Contact</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button
                    class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors rounded-full relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                </button>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                <div class="flex items-center gap-3 pl-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">{{$rendezVous->patient->user->name}}</p>
                        <p class="text-[10px] text-on-surface-variant">{{$rendezVous->patient->user->role}}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-fixed shadow-sm">
                        <img alt="Dr. Smith's Profile"
                            class="w-10 h-10 rounded-full object-cover"
                            data-alt="portrait of a professional male doctor with a kind expression wearing a white coat and stethoscope in a bright clinical setting"
                            src="{{$rendezVous->patient->user->photo_url}}" />
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="pt-32 pb-24 px-6 max-w-5xl mx-auto">
        <!-- Success Header -->
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-full clinical-gradient text-white mb-6 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-4xl" data-icon="check_circle"
                    style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-4">Rendez-vous Confirmé !
            </h1>
            <p class="text-on-surface-variant max-w-lg mx-auto text-lg">Votre consultation a été enregistrée avec
                succès. Un e-mail de confirmation vous a été envoyé.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            <!-- Summary Card -->
            <div
                class="md:col-span-7 bg-surface-container-lowest rounded-[1.5rem] p-8 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 clinical-gradient opacity-5 rounded-bl-full"></div>
                <h2 class="text-xl font-bold text-primary mb-8 flex items-center gap-2">
                    <span class="material-symbols-outlined" data-icon="description">description</span>
                    Détails du rendez-vous
                </h2>
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-x-4 gap-y-6 pb-6 border-b border-outline-variant/10">
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">
                                Patient</p>
                            <p class="text-lg font-medium">{{ $rendezVous->patient->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">
                                Spécialité</p>
                            <p class="text-lg font-medium">{{ $rendezVous->medecin->specialite->nom }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">
                                Numéro de CIN</p>
                            <p class="text-lg font-medium">AB123456</p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-on-surface-variant font-bold mb-1">
                                Numéro de Rendez-vous</p>
                            <p class="text-lg font-medium">#RDV-{{ $rendezVous->id }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 bg-surface rounded-xl">
                        <img alt="Dr. Marc Antoine"
                            class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm"
                            data-alt="professional portrait of a middle-aged male doctor with a kind expression wearing a white coat in a clean medical office"
                            src="{{$rendezVous->medecin->photo_url}}" />
                        <div>
                            <p class="text-[11px] uppercase tracking-widest text-on-surface-variant font-bold">Médecin
                                référent</p>
                            <p class="text-lg font-bold text-teal-800">Dr.{{ $rendezVous->medecin->user->name }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 border border-outline-variant/20 rounded-xl flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg"
                                data-icon="calendar_today">calendar_today</span>
                            <div>
                                <p class="text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">Date
                                </p>
                                <p class="font-medium">
                                    {{ ucwords(\Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('l, d F Y')) }}
                                </p>
                            </div>
                        </div>
                        <div class="p-4 border border-outline-variant/20 rounded-xl flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg"
                                data-icon="schedule">schedule</span>
                            <div>
                                <p class="text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">Heure
                                </p>
                                <p class="font-medium">{{ substr($rendezVous->heure_rendez_vous,0,5) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border border-outline-variant/20 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg"
                            data-icon="location_on">location_on</span>
                        <div>
                            <p class="text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">Lieu</p>
                            <p class="font-medium">Cabinet Médical, 123 Rue de la Santé, Marrakech</p>
                            <a class="text-sm text-primary font-semibold mt-2 inline-block hover:underline"
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($rendezVous->medecin->adresse) }}"
                                target="_blank">Voir sur la map</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Next Steps & Actions -->
            <div class="md:col-span-5 space-y-8">
                <!-- Next Steps Card -->
                <div class="bg-surface-container rounded-[1.5rem] p-8">
                    <h3 class="text-lg font-bold mb-6">Prochaines étapes</h3>
                    <ul class="space-y-6">
                        <li class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-white flex items-center justify-center font-bold text-primary text-sm shadow-sm">
                                1</div>
                            <p class="text-sm text-on-surface-variant leading-relaxed">Vérifiez votre boîte de réception
                                pour l'e-mail de confirmation et les instructions de préparation.</p>
                        </li>
                        <li class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-white flex items-center justify-center font-bold text-primary text-sm shadow-sm">
                                2</div>
                            <p class="text-sm text-on-surface-variant leading-relaxed">Apportez votre historique
                                médical
                                complet et vos derniers résultats d'examens.</p>
                        </li>
                        <li class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 rounded-full bg-white flex items-center justify-center font-bold text-primary text-sm shadow-sm">
                                3</div>
                            <p class="text-sm text-on-surface-variant leading-relaxed">Présentez-vous à l'accueil 15
                                minutes avant l'heure prévue pour les formalités administratives.</p>
                        </li>
                    </ul>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">
                    <a href="{{ route('rendezvous.pdf', $rendezVous->id) }}"
                        class="clinical-gradient text-white w-full py-4 px-6 rounded-xl font-bold flex items-center justify-center gap-3 shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform active:scale-95 cursor-pointer">
                        <span class="material-symbols-outlined" data-icon="picture_as_pdf">picture_as_pdf</span>
                        Exporter en PDF
                    </a>
                    <a href="{{route('dashboard')}}"
                        class="bg-surface-container-highest text-on-surface-variant w-full py-4 px-6 rounded-xl font-bold flex items-center justify-center gap-3 hover:bg-surface-container-high transition-colors active:scale-95 cursor-pointer">
                        <span class="material-symbols-outlined" data-icon="home">home</span>
                        Retour à l'accueil
                </a>
                </div>
                <!-- Support Badge -->
                <div class="glass-badge p-6 rounded-2xl border border-white/50 text-center">
                    <p class="text-sm font-medium mb-1">Besoin de modifier ou annuler ?</p>
                    <p class="text-xs text-on-surface-variant mb-4">Contactez-nous au moins 24h à l'avance.</p>
                    <a class="text-primary font-bold text-lg" href="tel:+212522000000">+212 522 00 00 00</a>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-slate-50 dark:bg-slate-950 border-t border-slate-200/50 dark:border-slate-800/50 w-full py-12">
        <div
            class="flex flex-col md:flex-row justify-between items-center px-8 max-w-7xl mx-auto space-y-4 md:space-y-0">
            <div class="flex flex-col items-center md:items-start space-y-2">
                <div class="text-lg font-bold text-teal-800 dark:text-teal-300">Clinical Excellence</div>
                <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-widest">© 2024 Clinical
                    Excellence Medical Group. All rights reserved.</div>
            </div>
            <div class="flex space-x-6">
                <a class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:text-teal-600 transition-colors"
                    href="#">Privacy Policy</a>
                <a class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:text-teal-600 transition-colors"
                    href="#">Terms of Service</a>
                <a class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:text-teal-600 transition-colors"
                    href="#">Cookie Settings</a>
            </div>
        </div>
    </footer>
</body>

</html>
