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
    <nav id="navbar" class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50 w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a class="flex items-center gap-2" href="{{ route('dashboard') }}">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-2xl">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-teal-800 dark:text-teal-300">Cabinet Medical</span>
                </a>
                <div class="hidden md:flex gap-8">
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Mes rendez-vous</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="#">Support</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors rounded-full relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-white"></span>
                </button>
                <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                <div class="flex items-center gap-3 pl-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">{{ $rendezVous->patient->user->name }}</p>
                        <p class="text-[10px] text-on-surface-variant">Patient</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                        {{ strtoupper(substr($rendezVous->patient->user->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8 md:py-12 flex flex-col lg:flex-row gap-8">
        <div class="flex-1 space-y-8">
            <header>
                <h1 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">Confirmation</h1>
                <p class="text-on-surface-variant">Votre reservation a bien ete enregistree. Vous retrouvez ici le meme recapitulatif clair que sur le dashboard.</p>
            </header>

            @if (session('success'))
                <div class="mx-auto mb-4 w-fit px-4 py-2 rounded-lg bg-green-100 text-green-800 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between max-w-2xl">
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold bg-primary text-white">1</div>
                    <span class="text-xs font-semibold text-primary">Specialite</span>
                </div>
                <div class="flex-1 h-px mx-4 mb-6 bg-primary/30"></div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold bg-primary text-white">2</div>
                    <span class="text-xs font-semibold text-primary">Specialiste</span>
                </div>
                <div class="flex-1 h-px mx-4 mb-6 bg-primary/30"></div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold bg-primary text-white">3</div>
                    <span class="text-xs font-semibold text-primary">Heure</span>
                </div>
            </div>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/10 p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Medecin</p>
                    <p class="mt-2 text-lg font-bold">Dr. {{ $rendezVous->medecin->user->name }}</p>
                    <p class="mt-1 text-xs text-on-surface-variant">{{ $rendezVous->medecin->specialite->nom }}</p>
                </div>

                <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/10 p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Statut</p>
                    <p class="mt-2 text-lg font-bold capitalize">{{ str_replace('_', ' ', $rendezVous->statut) }}</p>
                    <p class="mt-1 text-xs text-on-surface-variant">Le creneau est maintenant reserve pour vous.</p>
                </div>

                <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/10 p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Date</p>
                    <p class="mt-2 text-lg font-bold">{{ ucfirst(\Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('l j F Y')) }}</p>
                </div>

                <div class="rounded-2xl bg-surface-container-lowest border border-outline-variant/10 p-5 shadow-sm">
                    <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Heure</p>
                    <p class="mt-2 text-lg font-bold">{{ substr($rendezVous->heure_rendez_vous, 0, 5) }}</p>
                </div>
            </section>

            <section class="rounded-3xl bg-surface-container-lowest border border-outline-variant/10 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-teal-800 mb-4">Informations utiles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-2xl bg-surface-container-low p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Patient</p>
                        <p class="mt-2 font-bold">{{ $rendezVous->patient->user->name }}</p>
                    </div>
                    <div class="rounded-2xl bg-surface-container-low p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Reservation</p>
                        <p class="mt-2 font-bold">#{{ $rendezVous->id }}</p>
                    </div>
                    <div class="rounded-2xl bg-surface-container-low p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-on-surface-variant">Montant</p>
                        <p class="mt-2 font-bold">{{ number_format($rendezVous->medecin->specialite->prix_consultation, 2, ',', ' ') }} DH</p>
                    </div>
                </div>
            </section>
        </div>

        <aside class="w-full lg:w-96">
            <div class="sticky top-24 space-y-6">
                <div class="bg-teal-50 p-4 rounded-xl flex items-start gap-3 border border-teal-100">
                    <span class="material-symbols-outlined text-teal-600" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <div>
                        <p class="text-sm font-bold text-teal-800">Reservation confirmee</p>
                        <p class="text-xs text-teal-700">Votre rendez-vous est enregistre et pret a etre consulte ou imprime.</p>
                    </div>
                </div>

                <div class="glass-card rounded-3xl p-8 shadow-xl shadow-primary/5 border border-white/50">
                    <h2 class="text-xl font-bold text-on-surface mb-6">Resume de la reservation</h2>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">medical_information</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Specialite</p>
                                <p class="font-bold text-on-surface">{{ $rendezVous->medecin->specialite->nom }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Specialiste</p>
                                <p class="font-bold text-on-surface">Dr. {{ $rendezVous->medecin->user->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-primary-container/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">calendar_today</span>
                            </div>
                            <div>
                                <p class="text-xs text-on-surface-variant uppercase tracking-wider font-bold">Date &amp; Heure</p>
                                <p class="font-bold text-on-surface">{{ ucfirst(\Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('j M Y')) }} • {{ substr($rendezVous->heure_rendez_vous, 0, 5) }}</p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-outline-variant/20">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-on-surface-variant">Consultation</span>
                                <span class="font-bold">{{ number_format($rendezVous->medecin->specialite->prix_consultation, 2, ',', ' ') }} DH</span>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-on-surface-variant">Frais de dossier</span>
                                <span class="text-teal-600 font-bold">Gratuit</span>
                            </div>
                            <div class="flex justify-between items-center text-lg font-black text-teal-800">
                                <span>Total</span>
                                <span>{{ number_format($rendezVous->medecin->specialite->prix_consultation, 2, ',', ' ') }} DH</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3">
                            <a href="{{ route('dashboard') }}" class="w-full py-4 rounded-2xl bg-gradient-to-br from-primary to-primary-container text-white font-bold text-lg shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform flex items-center justify-center gap-2">
                                <span>Retour au tableau de bord</span>
                                <span class="material-symbols-outlined">arrow_back</span>
                            </a>

                            <button type="button" onclick="window.print()" class="w-full py-4 rounded-2xl bg-surface-container-low text-on-surface font-bold text-lg hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2">
                                <span>Imprimer</span>
                                <span class="material-symbols-outlined">print</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-surface-container-high border border-outline-variant/10 text-center">
                    <p class="text-sm font-medium mb-3">Besoin d'aide pour votre rendez-vous ?</p>
                    <a class="inline-flex items-center gap-2 text-primary font-bold hover:underline" href="tel:+33123456789">
                        <span class="material-symbols-outlined text-sm">call</span>
                        01 23 45 67 89
                    </a>
                </div>
            </div>
        </aside>
    </main>

    <footer class="w-full py-6 mt-auto bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs font-inter text-slate-500 mb-4 md:mb-0">
            © 2026 Cabinet Medical. All rights reserved.
        </div>
        <div class="flex gap-6">
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Privacy Policy</a>
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Terms of Service</a>
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Support</a>
        </div>
    </footer>
</body>

</html>
