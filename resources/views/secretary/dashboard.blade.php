<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Secrétariat - File d'attente</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#006876",
                        "primary-container": "#008394",
                        secondary: "#515f74",
                        "surface-container": "#eceef0",
                        "surface-container-low": "#f2f4f6",
                        "surface-container-lowest": "#ffffff",
                        error: "#ba1a1a",
                        "error-container": "#ffdad6"
                    },
                    fontFamily: {
                        body: ["Inter"],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .cta-gradient { background: linear-gradient(135deg, #006876 0%, #008394 100%); }
    </style>
</head>
<body class="text-slate-800">

<!-- SideNavBar -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-50 border-r border-slate-200/50 flex flex-col py-6 z-40">
    <div class="px-6 mb-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-2xl">medical_services</span>
            </div>
            <div>
                <h2 class="text-lg font-black text-teal-900 tracking-tight">Cabinet Médical</h2>
                <p class="text-[10px] uppercase tracking-widest text-secondary font-bold">Espace Secrétaire</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 space-y-1">
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 transition-all duration-200" href="{{ route('secretary.dashboard') }}">
            <span class="material-symbols-outlined mr-3">view_timeline</span>
            File du Jour
        </a>
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('secretary.patients') }}">
            <span class="material-symbols-outlined mr-3">recent_patient</span>
            Gestion Patients
        </a>
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('secretary.rendezvous') }}">
            <span class="material-symbols-outlined mr-3">calendar_month</span>
            Rendez-vous
        </a>
    </nav>
    <div class="mt-auto px-4 space-y-1">
        <div class="h-px bg-slate-200/50 mb-4 mx-2"></div>
        <a href="{{ route('logout') }}" class="w-full flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
            <span class="material-symbols-outlined mr-3">logout</span>
            Déconnexion
        </a>
    </div>
</aside>

<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
    <header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100">
        <div class="flex items-center justify-between px-8 py-3 w-full">
            <h1 class="text-lg font-bold text-teal-900">File quotidienne du secrétariat</h1>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-teal-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500">Secrétaire Médicale</p>
                </div>
                <img src="{{ Auth::user()->photo_url }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-teal-50" alt="">
            </div>
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8">
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Circuit des rendez-vous du jour</h1>
                <p class="text-secondary max-w-3xl">Gérez uniquement les rendez-vous d'aujourd'hui et déplacez chaque patient de l'attente à la consultation, puis vers les dossiers clôturés une fois la visite terminée ou en cas d'absence.</p>
            </div>
            <div class="text-right">
                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Aujourd'hui</div>
                <div class="text-2xl font-black text-primary">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F Y') }}</div>
            </div>
        </section>

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-bold">Veuillez corriger les erreurs suivantes :</p>
                <ul class="mt-2 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Total du jour</p>
                <p class="mt-2 text-3xl font-black text-teal-900">{{ $todayRendezVous->count() }}</p>
                <p class="text-sm text-slate-500">Rendez-vous programmés aujourd'hui</p>
            </div>
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">En attente</p>
                <p class="mt-2 text-3xl font-black text-orange-600">{{ $waitingReservations->count() }}</p>
                <p class="text-sm text-slate-500">En attente au secrétariat</p>
            </div>
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">En consultation</p>
                <p class="mt-2 text-3xl font-black text-green-700">{{ $inConsultationReservations->count() }}</p>
                <p class="text-sm text-slate-500">Actuellement chez le médecin</p>
            </div>
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Clôturés</p>
                <p class="mt-2 text-3xl font-black text-slate-700">{{ $closedReservations->count() }}</p>
                <p class="text-sm text-slate-500">Terminés ou absents aujourd'hui</p>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="rounded-[2rem] border border-orange-200 bg-orange-50/70 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-lg font-black text-orange-900 flex items-center gap-2">
                            <span class="material-symbols-outlined">schedule</span>
                            Réservations du jour
                        </h2>
                        <p class="text-sm text-orange-700 mt-1">Confirmez l'arrivée ou marquez le patient comme absent.</p>
                    </div>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-black uppercase tracking-wider text-orange-700">
                        {{ $waitingReservations->count() }}
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($waitingReservations as $rdv)
                        <div class="rounded-2xl bg-white p-5 border border-orange-100 shadow-sm">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-lg font-black text-slate-800">{{ $rdv->patient->user->name ?? 'Patient inconnu' }}</p>
                                    <p class="text-sm text-slate-500">Dr. {{ $rdv->medecin->user->name ?? 'Médecin inconnu' }}</p>
                                </div>
                                <span class="rounded-lg bg-orange-100 px-3 py-1 text-xs font-black uppercase tracking-wider text-orange-700">
                                    {{ substr($rdv->heure_rendez_vous, 0, 5) }}
                                </span>
                            </div>
                            <div class="mt-4 space-y-1 text-sm text-slate-500">
                                <p>CIN : <span class="font-semibold text-slate-700">{{ $rdv->patient->cin ?? 'Non renseigné' }}</span></p>
                                <p>Spécialité : <span class="font-semibold text-slate-700">{{ $rdv->medecin->specialite->nom ?? 'Non renseignée' }}</span></p>
                            </div>
                            <div class="mt-5 flex gap-3">
                                <form action="{{ route('secretary.rendezvous.status', $rdv) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="confirmé">
                                    <button type="submit" class="w-full rounded-xl bg-primary px-4 py-3 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                                        Confirmer
                                    </button>
                                </form>
                                <form action="{{ route('secretary.rendezvous.status', $rdv) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="annulé">
                                    <button type="submit" class="w-full rounded-xl bg-red-100 px-4 py-3 text-sm font-bold text-red-700 hover:bg-red-200 transition-colors">
                                        Absent
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-orange-200 bg-white/70 px-5 py-10 text-center text-sm text-slate-500">
                            Aucun rendez-vous en attente pour aujourd'hui.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-[2rem] border border-green-200 bg-green-50/70 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-lg font-black text-green-900 flex items-center gap-2">
                            <span class="material-symbols-outlined">medical_services</span>
                            En consultation
                        </h2>
                        <p class="text-sm text-green-700 mt-1">Patients déjà envoyés chez le médecin.</p>
                    </div>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-black uppercase tracking-wider text-green-700">
                        {{ $inConsultationReservations->count() }}
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($inConsultationReservations as $rdv)
                        <div class="rounded-2xl bg-white p-5 border border-green-100 shadow-sm">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-lg font-black text-slate-800">{{ $rdv->patient->user->name ?? 'Patient inconnu' }}</p>
                                    <p class="text-sm text-slate-500">Dr. {{ $rdv->medecin->user->name ?? 'Médecin inconnu' }}</p>
                                </div>
                                <span class="rounded-lg bg-green-100 px-3 py-1 text-xs font-black uppercase tracking-wider text-green-700">
                                    {{ substr($rdv->heure_rendez_vous, 0, 5) }}
                                </span>
                            </div>
                            <div class="mt-4 space-y-1 text-sm text-slate-500">
                                <p>Téléphone : <span class="font-semibold text-slate-700">{{ $rdv->patient->telephone ?? 'Non renseigné' }}</span></p>
                                <p>Spécialité : <span class="font-semibold text-slate-700">{{ $rdv->medecin->specialite->nom ?? 'Non renseignée' }}</span></p>
                            </div>
                            <div class="mt-5">
                                <form action="{{ route('secretary.rendezvous.status', $rdv) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="termine">
                                    <button type="submit" class="w-full rounded-xl bg-slate-800 px-4 py-3 text-sm font-bold text-white hover:bg-slate-900 transition-colors">
                                        Terminer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-green-200 bg-white/70 px-5 py-10 text-center text-sm text-slate-500">
                            Aucun patient n'est actuellement en consultation.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-slate-100/70 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-lg font-black text-slate-800 flex items-center gap-2">
                            <span class="material-symbols-outlined">task_alt</span>
                            Clôturés aujourd'hui
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">Consultations terminées et patients absents.</p>
                    </div>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-black uppercase tracking-wider text-slate-700">
                        {{ $closedReservations->count() }}
                    </span>
                </div>

                <div class="space-y-4">
                    @forelse ($closedReservations as $rdv)
                        @php
                            $isTerminated = in_array($rdv->statut, ['termine', 'terminé'], true);
                            $badgeClasses = $isTerminated
                                ? 'bg-slate-800 text-white'
                                : 'bg-red-100 text-red-700';
                            $badgeLabel = $isTerminated ? 'Terminé' : 'Absent';
                        @endphp
                        <div class="rounded-2xl bg-white p-5 border border-slate-200 shadow-sm">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-lg font-black text-slate-800">{{ $rdv->patient->user->name ?? 'Patient inconnu' }}</p>
                                    <p class="text-sm text-slate-500">Dr. {{ $rdv->medecin->user->name ?? 'Médecin inconnu' }}</p>
                                </div>
                                <span class="rounded-lg {{ $badgeClasses }} px-3 py-1 text-xs font-black uppercase tracking-wider">
                                    {{ $badgeLabel }}
                                </span>
                            </div>
                            <div class="mt-4 space-y-1 text-sm text-slate-500">
                                <p>Heure : <span class="font-semibold text-slate-700">{{ substr($rdv->heure_rendez_vous, 0, 5) }}</span></p>
                                <p>Spécialité : <span class="font-semibold text-slate-700">{{ $rdv->medecin->specialite->nom ?? 'Non renseignée' }}</span></p>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-300 bg-white/70 px-5 py-10 text-center text-sm text-slate-500">
                            Aucun rendez-vous terminé ou absent pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
    <footer class="w-full py-6 mt-auto bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8 gap-4">
        <p class="text-xs text-slate-500">© 2024 Cabinet Médical. Tous droits réservés.</p>
        <div class="flex items-center gap-6">
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Politique de confidentialité</a>
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Conditions d'utilisation</a>
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Support</a>
        </div>
    </footer>
</div>
</body>
</html>
