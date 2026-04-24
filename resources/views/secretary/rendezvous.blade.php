<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Secrétariat - Rendez-vous</title>
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
        /* Custom radio logic styles */
        input[type="radio"]:checked + div {
            border-color: #006876;
            background-color: #e0f2f1;
        }
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
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('secretary.dashboard') }}">
            <span class="material-symbols-outlined mr-3">view_timeline</span>
            File du Jour
        </a>
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('secretary.patients') }}">
            <span class="material-symbols-outlined mr-3">recent_patient</span>
            Gestion Patients
        </a>
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 transition-all duration-200" href="{{ route('secretary.rendezvous') }}">
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
    <!-- TopAppBar -->
    <header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100">
        <div class="flex items-center justify-between px-8 py-3 w-full">
            <div class="flex items-center flex-1 max-w-md">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input id="rendezvous-search-input" class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" placeholder="Rechercher par patient, médecin, date ou CIN..." type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-teal-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500">Secrétaire Médicale</p>
                </div>
                <img src="{{ Auth::user()->photo_url }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-teal-50" alt="">
            </div>
        </div>
    </header>

    <!-- Canvas Area -->
    <main class="flex-1 p-8 space-y-8">
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Les Rendez-Vous</h1>
                <p class="text-secondary max-w-2xl">Visualisez tous les rendez-vous, modifiez-les, et créez-en de nouveaux pour des patients au téléphone ou physiquement présents.</p>
            </div>
            <button onclick="document.getElementById('modal-add-rdv').classList.remove('hidden')" class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Créer un Rendez-vous
            </button>
        </section>

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-bold">Le rendez-vous n'a pas pu être enregistré.</p>
                <ul class="mt-2 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Total</p>
                <p class="mt-2 text-3xl font-black text-teal-900">{{ $rendezVous->count() }}</p>
                <p class="text-sm text-slate-500">Rendez-vous enregistrés</p>
            </div>
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Aujourd'hui</p>
                <p class="mt-2 text-3xl font-black text-teal-900">{{ $rendezVous->filter(fn ($rdv) => \Carbon\Carbon::parse($rdv->date_rendez_vous)->isToday())->count() }}</p>
                <p class="text-sm text-slate-500">Créneaux du jour</p>
            </div>
            <div class="rounded-[2rem] bg-white border border-slate-100 px-6 py-5 shadow-sm">
                <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">En attente</p>
                <p class="mt-2 text-3xl font-black text-orange-600">{{ $rendezVous->where('statut', 'en_attente')->count() }}</p>
                <p class="text-sm text-slate-500">À confirmer ou traiter</p>
            </div>
        </section>

        <!-- Data Table Section -->
        <section class="bg-surface-container-low rounded-[2rem] overflow-hidden">
            <div class="bg-white p-1 rounded-[2rem] shadow-sm">
                <table class="w-full text-left border-separate border-spacing-y-2 px-4">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
                            <th class="px-6 py-4">Date & Heure</th>
                            <th class="px-6 py-4">Patient</th>
                            <th class="px-6 py-4">Médecin</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4 text-right">Réf.</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($rendezVous as $rdv)
                            @php
                                $appointmentDate = \Carbon\Carbon::parse($rdv->date_rendez_vous);
                                $isPast = $appointmentDate->isPast() && ! $appointmentDate->isToday();
                                $statusClasses = match ($rdv->statut) {
                                    'en_attente' => 'bg-orange-100 text-orange-800',
                                    'confirmé' => 'bg-green-100 text-green-800',
                                    'annulé', 'annule' => 'bg-red-100 text-red-700',
                                    'termine', 'terminé' => 'bg-slate-100 text-slate-600',
                                    default => 'bg-slate-100 text-slate-700',
                                };
                                $statusLabel = match ($rdv->statut) {
                                    'en_attente' => 'En attente',
                                    'confirmé' => 'Confirmé',
                                    'annulé', 'annule' => 'Annulé',
                                    'termine', 'terminé' => 'Terminé',
                                    default => ucfirst(str_replace('_', ' ', $rdv->statut)),
                                };
                                $dateLabel = $appointmentDate->isToday()
                                    ? "Aujourd'hui"
                                    : ($appointmentDate->isTomorrow()
                                        ? 'Demain'
                                        : ucfirst($appointmentDate->locale('fr')->translatedFormat('d F Y')));
                                $doctorName = $rdv->medecin->user->name ?? 'Médecin inconnu';
                                $patientName = $rdv->patient->user->name ?? 'Patient inconnu';
                                $specialiteName = $rdv->medecin->specialite->nom ?? 'Spécialité indisponible';
                                $patientCin = $rdv->patient->cin ?? '';
                                $reference = 'rdv-' . str_pad((string) $rdv->id, 4, '0', STR_PAD_LEFT);
                                $searchBlob = \Illuminate\Support\Str::lower(implode(' ', [
                                    $patientName,
                                    $doctorName,
                                    $specialiteName,
                                    $patientCin,
                                    $statusLabel,
                                    $dateLabel,
                                    $appointmentDate->locale('fr')->translatedFormat('d/m/Y'),
                                    substr($rdv->heure_rendez_vous, 0, 5),
                                    $reference,
                                ]));
                            @endphp
                            <tr class="group hover:bg-slate-50 transition-colors rendezvous-row {{ $isPast ? 'opacity-70' : '' }}"
                                data-search="{{ $searchBlob }}">
                                <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                    <div>
                                        <p class="font-bold {{ $isPast ? 'text-slate-600' : 'text-teal-900' }}">{{ $dateLabel }}</p>
                                        <p class="text-[10px] text-slate-500">
                                            {{ \Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->translatedFormat('d/m/Y') }}
                                            •
                                            {{ substr($rdv->heure_rendez_vous, 0, 5) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white border-y border-slate-100">
                                    <div>
                                        <p class="font-bold text-slate-700">{{ $patientName }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $rdv->patient->cin ?? 'CIN indisponible' }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white border-y border-slate-100">
                                    <div>
                                        <p class="text-slate-700 font-semibold">Dr. {{ $doctorName }}</p>
                                        <p class="text-[10px] text-slate-500">{{ $specialiteName }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white border-y border-slate-100">
                                    <span class="{{ $statusClasses }} text-[10px] font-bold px-2 py-1 rounded uppercase inline-flex items-center gap-1">
                                        @if ($rdv->statut === 'confirmé')
                                            <span class="material-symbols-outlined text-[14px]">done</span>
                                        @endif
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                    <span class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-1 text-[11px] font-bold text-slate-500">
                                        #{{ strtoupper($reference) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr id="rendezvous-empty-row">
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    Aucun rendez-vous n'est encore enregistré.
                                </td>
                            </tr>
                        @endforelse
                        @if ($rendezVous->isNotEmpty())
                            <tr id="rendezvous-empty-row" class="hidden">
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    Aucun rendez-vous ne correspond à cette recherche.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <footer class="w-full py-6 mt-auto bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8 gap-4">
        <p class="text-xs text-slate-500">© 2026 Cabinet Médical. Tous droits réservés.</p>
        <div class="flex items-center gap-6">
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Politique de confidentialité</a>
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Conditions d'utilisation</a>
            <a href="#" class="text-xs text-slate-400 hover:text-primary transition-colors">Support</a>
        </div>
    </footer>
</div>

<!-- Modal Create RDV with Business Logic -->
<div id="modal-add-rdv" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-surface-container-lowest shrink-0">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Nouveau Rendez-vous</h3>
                <p class="text-xs text-slate-500 mt-1">Planifier une séance ou intégrer un patient présent</p>
            </div>
            <button onclick="document.getElementById('modal-add-rdv').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        
        <form action="{{ route('secretary.rendezvous.store') }}" method="POST" class="p-8 space-y-6 overflow-y-auto">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Sélectionner Patient</label>
                    <select name="patient_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                        <option value="">Choisir un patient</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}" @selected(old('patient_id') == $patient->id)>
                                {{ $patient->user->name ?? 'Patient inconnu' }} - {{ $patient->cin }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($patients->isEmpty())
                        <p class="mt-2 text-xs font-medium text-orange-600">Aucun patient disponible pour l'instant.</p>
                    @endif
                </div>

                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Médecin Consultant</label>
                    <select name="medecin_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                        <option value="">Choisir un médecin</option>
                        @foreach ($medecins as $medecin)
                            <option value="{{ $medecin->id }}" @selected(old('medecin_id') == $medecin->id)>
                                Dr. {{ $medecin->user->name ?? 'Médecin inconnu' }}
                                @if ($medecin->specialite)
                                    ({{ $medecin->specialite->nom }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('medecin_id')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                    @if ($medecins->isEmpty())
                        <p class="mt-2 text-xs font-medium text-orange-600">Aucun médecin disponible pour l'instant.</p>
                    @endif
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Date du rendez-vous</label>
                    <input type="date" name="date_rendez_vous" min="{{ now()->toDateString() }}" value="{{ old('date_rendez_vous', now()->toDateString()) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                    @error('date_rendez_vous')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Heure</label>
                    <input type="time" name="heure_rendez_vous" value="{{ old('heure_rendez_vous') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                    @error('heure_rendez_vous')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Business Logic: Statut Choice -->
                <div class="col-span-2 mt-2">
                    <label class="block text-sm font-bold text-teal-900 mb-3 border-b border-slate-100 pb-2">Situation du Patient</label>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Option 1: En_Attente -->
                        <label class="cursor-pointer relative">
                            <input type="radio" name="statut" value="en_attente" class="peer sr-only" {{ old('statut', 'en_attente') === 'en_attente' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-primary peer-checked:bg-teal-50 transition-all">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="material-symbols-outlined text-orange-500">pending_actions</span>
                                    <span class="font-bold text-slate-700 peer-checked:text-teal-900">Réservation Classique</span>
                                </div>
                                <p class="text-xs text-slate-500">Statut: <strong class="text-orange-600">En Attente</strong><br/>Le patient prend rdv par téléphone ou à l'avance pour une date ultérieure.</p>
                            </div>
                        </label>
                        
                        <!-- Option 2: Confirme -->
                        <label class="cursor-pointer relative">
                            <input type="radio" name="statut" value="confirmé" class="peer sr-only" {{ old('statut') === 'confirmé' ? 'checked' : '' }}>
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-primary peer-checked:bg-teal-50 transition-all">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="material-symbols-outlined text-green-500">how_to_reg</span>
                                    <span class="font-bold text-slate-700 peer-checked:text-teal-900">Présent Immédiatement</span>
                                </div>
                                <p class="text-xs text-slate-500">Statut: <strong class="text-green-600">Confirmé</strong><br/>Le patient vient d'arriver au cabinet sans RDV préalable et est ajouté à la file direct.</p>
                            </div>
                        </label>
                    </div>
                    @error('statut')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-rdv').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="submit" @disabled($patients->isEmpty() || $medecins->isEmpty()) class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    Planifier
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('modal-add-rdv').classList.remove('hidden');
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('rendezvous-search-input');
        const rendezvousRows = Array.from(document.querySelectorAll('.rendezvous-row'));
        const emptyRow = document.getElementById('rendezvous-empty-row');

        if (!searchInput) {
            return;
        }

        const filterRows = function () {
            const query = searchInput.value.trim().toLowerCase();
            let visibleCount = 0;

            rendezvousRows.forEach(function (row) {
                const haystack = row.dataset.search || '';
                const matches = query === '' || haystack.includes(query);

                row.classList.toggle('hidden', !matches);

                if (matches) {
                    visibleCount += 1;
                }
            });

            if (emptyRow) {
                emptyRow.classList.toggle('hidden', visibleCount !== 0);
            }
        };

        searchInput.addEventListener('input', filterRows);
        filterRows();
    });
</script>

</body>
</html>
