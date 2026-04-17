<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mes Rendez-vous - Cabinet Médical</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
                        "error": "#ba1a1a",
                        "surface-tint": "#006876",
                        "on-surface": "#191c1e",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-background": "#191c1e",
                        "secondary-container": "#d5e3fc",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-high": "#e6e8ea",
                        "on-error": "#ffffff",
                        "background": "#f7f9fb",
                        "outline-variant": "#bdc8cb",
                        "on-surface-variant": "#3e494b",
                        "surface": "#f7f9fb",
                        "primary-fixed": "#a0efff",
                        "error-container": "#ffdad6",
                        "primary": "#006876",
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
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-en_attente { background-color: #fef08a; color: #854d0e; } /* Yellow */
        .status-confirmé { background-color: #bbf7d0; color: #166534; } /* Green */
        .status-annulé { background-color: #fecdd3; color: #9f1239; } /* Red */
        .status-terminé { background-color: #e2e8f0; color: #334155; } /* Gray */
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <nav id="navbar" class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50 w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a class="flex items-center gap-2" href="/">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-2xl">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-teal-800 dark:text-teal-300">Cabinet Médical</span>
                </a>
                <div class="hidden md:flex gap-8">
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="/">Accueil</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="{{ route('patient.dashboard') }}">Prendre un RDV</a>
                    <a class="text-primary font-semibold border-b-2 border-primary pb-0.5" href="{{ route('patient.rendezvous.index') }}">Mes rendez-vous</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 pl-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">{{$user->name}}</p>
                        <p class="text-[10px] text-on-surface-variant">{{$user->role}}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-fixed shadow-sm">
                        <img alt="{{ $user->name }}" class="w-10 h-10 object-cover" src="{{ $user->photo_url }}" />
                    </div>
                </div>
                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="GET">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-red-500 transition-colors px-3 py-2 rounded-lg hover:bg-red-50">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span class="hidden sm:inline">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 py-8 md:py-12">
        <!-- Breadcrumb & Header -->
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <span>Espace patient</span>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-teal-700">Mes rendez-vous</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-teal-900 mb-2">Mes rendez-vous</h1>
                    <p class="text-slate-500 max-w-2xl text-sm leading-relaxed">Gérez vos consultations médicales, visualisez vos rendez-vous à venir et consultez l'historique de vos soins.</p>
                    <br>
            </div>
        </div>

        <!-- Section: À venir -->
        <section class="mb-12">
            <h2 class="text-xl font-bold text-teal-900 mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-teal-700" style="font-variation-settings: 'FILL' 1;">event_upcoming</span>
                À venir
            </h2>
            
            <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FAFB] text-slate-500 text-[10px] uppercase tracking-widest font-bold">
                                <th class="p-5 pl-8 whitespace-nowrap">Date et Heure</th>
                                <th class="p-5">Spécialité</th>
                                <th class="p-5">Médecin</th>
                                <th class="p-5">Statut</th>
                                <th class="p-5 pr-8 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @if($upcoming->isEmpty())
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-slate-400 italic">
                                        Aucun rendez-vous à venir.
                                    </td>
                                </tr>
                            @else
                                @foreach($upcoming as $rdv)
                                    <tr class="hover:bg-slate-50/50 transition-colors group">
                                        <td class="p-5 pl-8 whitespace-nowrap">
                                            <div class="font-bold text-slate-800">{{ ucwords(\Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->translatedFormat('d F Y')) }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5">{{ substr($rdv->heure_rendez_vous, 0, 5) }} {{ (int)substr($rdv->heure_rendez_vous, 0, 2) >= 12 ? 'PM' : 'AM' }}</div>
                                        </td>
                                        <td class="p-5">
                                            <span class="bg-[#F0F4F8] text-slate-600 px-3 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-wider">
                                                {{ $rdv->medecin->specialite->nom }}
                                            </span>
                                        </td>
                                        <td class="p-5 flex items-center gap-3">
                                            <img src="{{ $rdv->medecin->photo_url }}" class="w-8 h-8 rounded-full object-cover border border-slate-200" />
                                            <span class="font-bold text-slate-800 text-sm">Dr. {{ $rdv->medecin->user->name }}</span>
                                        </td>
                                        <td class="p-5">
                                            @if($rdv->statut === 'en_attente')
                                                <span class="inline-flex items-center gap-1.5 bg-[#FFF0E6] text-[#D97706] px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#D97706]"></span>
                                                    En attente
                                                </span>
                                            @elseif($rdv->statut === 'confirmé')
                                                <span class="inline-flex items-center gap-1.5 bg-[#E6F4EA] text-[#166534] px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#166534]"></span>
                                                    Confirmé
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                    {{ $rdv->statut }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-5 pr-8 text-right">
                                            <a href="{{ route('rendezvous.confirmation', $rdv->id) }}" class="inline-flex items-center gap-1 text-[#007B88] text-sm font-bold hover:underline">
                                                Voir <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Section: Historique -->
         <br>
        <section>
            <h2 class="text-xl font-bold text-teal-900 mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-teal-700" style="font-variation-settings: 'FILL' 1;">history</span>
                Historique
            </h2>
            
            <div class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FAFB] text-slate-500 text-[10px] uppercase tracking-widest font-bold">
                                <th class="p-5 pl-8 whitespace-nowrap">Date et Heure</th>
                                <th class="p-5">Spécialité</th>
                                <th class="p-5">Médecin</th>
                                <th class="p-5">Statut</th>
                                <th class="p-5 pr-8 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @if($past->isEmpty())
                                <tr>
                                    <td colspan="5" class="p-10 text-center text-slate-400 italic">
                                        Aucun historique pour le moment.
                                    </td>
                                </tr>
                            @else
                                @foreach($past as $rdv)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="p-5 pl-8 whitespace-nowrap">
                                            <div class="font-bold text-slate-500">{{ ucwords(\Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->translatedFormat('d F Y')) }}</div>
                                            <div class="text-xs text-slate-400 mt-0.5">{{ substr($rdv->heure_rendez_vous, 0, 5) }} {{ (int)substr($rdv->heure_rendez_vous, 0, 2) >= 12 ? 'PM' : 'AM' }}</div>
                                        </td>
                                        <td class="p-5">
                                            <span class="bg-[#F0F4F8] text-slate-400 px-3 py-1.5 rounded-full text-[9px] font-bold uppercase tracking-wider">
                                                {{ $rdv->medecin->specialite->nom }}
                                            </span>
                                        </td>
                                        <td class="p-5 flex items-center gap-3">
                                            <img src="{{ $rdv->medecin->photo_url }}" class="w-8 h-8 rounded-full object-cover grayscale opacity-80" />
                                            <span class="font-bold text-slate-500 text-sm">Dr. {{ $rdv->medecin->user->name }}</span>
                                        </td>
                                        <td class="p-5">
                                            <span class="inline-flex items-center gap-1.5 text-slate-500 text-[10px] font-bold uppercase tracking-wide">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                                {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                            </span>
                                        </td>
                                        <td class="p-5 pr-8 text-right">
                                            <a href="{{ route('rendezvous.confirmation', $rdv->id) }}" class="text-slate-500 text-sm font-bold hover:text-teal-700 transition-colors">
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>








    
    <!-- Footer -->
    <footer class="w-full py-6 mt-auto bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs font-inter text-slate-500 mb-4 md:mb-0">
            © 2024 Cabinet Médical. Tous droits réservés.
        </div>
        <div class="flex gap-6">
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Politique de confidentialité</a>
            <a class="text-xs font-inter text-slate-500 hover:text-teal-500 transition-colors" href="#">Conditions d'utilisation</a>
        </div>
    </footer>

</body>
</html>
