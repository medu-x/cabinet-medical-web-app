<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Secrétariat - Patients</title>
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

<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-50 border-r border-slate-200/50 flex flex-col py-6 z-40">
    <div class="px-6 mb-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-white">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">support_agent</span>
            </div>
            <div>
                <h2 class="text-lg font-black text-teal-900 tracking-tight">Accueil Cabinet</h2>
                <p class="text-[10px] uppercase tracking-widest text-secondary font-bold">Espace Secrétaire</p>
            </div>
        </div>
    </div>
    <nav class="flex-1 space-y-1">
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('secretary.dashboard') }}">
            <span class="material-symbols-outlined mr-3">view_timeline</span>
            File du Jour
        </a>
        <a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 transition-all duration-200" href="{{ route('secretary.patients') }}">
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
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                <span class="material-symbols-outlined mr-3">logout</span>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<div class="ml-64 flex flex-col min-h-screen">
    <header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100">
        <div class="flex items-center justify-between px-8 py-3 w-full gap-6">
            <div class="flex items-center flex-1 max-w-md">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input id="patient-search-input" name="search" value="{{ $search }}" class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" placeholder="Rechercher un patient par nom ou CIN..." type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-teal-800 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500">Secrétaire Médicale</p>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8">
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Base Patients</h1>
                <p class="text-secondary max-w-2xl">Consultez tous les patients enregistrés dans la base de données et créez de nouveaux dossiers directement depuis l'espace secrétaire.</p>
            </div>
            <button onclick="document.getElementById('modal-add-patient').classList.remove('hidden')" class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                Nouveau Patient
            </button>
        </section>

        @if (session('success'))
            <div class="rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <p class="font-bold">Le patient n'a pas pu être enregistré.</p>
                <ul class="mt-2 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="bg-surface-container-low rounded-[2rem] overflow-hidden">
            <div class="bg-white p-1 rounded-[2rem] shadow-sm">
                <table class="w-full text-left border-separate border-spacing-y-2 px-4">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
                            <th class="px-6 py-4">Nom & Identité</th>
                            <th class="px-6 py-4">CIN</th>
                            <th class="px-6 py-4">Téléphone</th>
                            <th class="px-6 py-4 text-right">Email</th>
                        </tr>
                    </thead>
                    <tbody id="patients-table-body" class="text-sm">
                        @forelse ($patients as $patient)
                            @php
                                $fullName = $patient->user->name ?? 'Patient inconnu';
                                $initials = collect(explode(' ', trim($fullName)))
                                    ->filter()
                                    ->take(2)
                                    ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                                    ->join('');
                            @endphp
                            <tr class="group hover:bg-slate-50 transition-colors patient-row"
                                data-name="{{ \Illuminate\Support\Str::lower($fullName) }}"
                                data-cin="{{ \Illuminate\Support\Str::lower($patient->cin ?? '') }}">
                                <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold">
                                            {{ $initials !== '' ? $initials : 'PT' }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-teal-900">{{ $fullName }}</p>
                                            <p class="text-[10px] text-slate-400">
                                                Né(e) le
                                                {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') : 'Non renseigné' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white border-y border-slate-100">
                                    <span class="font-bold text-slate-600">{{ $patient->cin ?: 'Non renseigné' }}</span>
                                </td>
                                <td class="px-6 py-4 bg-white border-y border-slate-100">
                                    <span class="text-slate-500">{{ $patient->telephone ?: 'Non renseigné' }}</span>
                                </td>
                                <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                    <span class="text-slate-500">{{ $patient->user->email ?? 'Email non défini' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr id="patients-empty-row">
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    {{ $search !== '' ? 'Aucun patient ne correspond à cette recherche.' : "Aucun patient n'est encore enregistré." }}
                                </td>
                            </tr>
                        @endforelse
                        @if ($patients->isNotEmpty())
                            <tr id="patients-empty-row" class="hidden">
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    Aucun patient ne correspond à cette recherche.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<div id="modal-add-patient" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-surface-container-lowest">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Ajouter un Patient</h3>
                <p class="text-xs text-slate-500 mt-1">Création de dossier patient depuis le secrétariat</p>
            </div>
            <button onclick="document.getElementById('modal-add-patient').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>

        <form action="{{ route('secretary.patients.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Nom Complet</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="Karim Alaoui">
                    @error('name')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">CIN</label>
                    <input name="cin" value="{{ old('cin') }}" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm uppercase focus:ring-2 focus:ring-primary/20" placeholder="XX123456">
                    @error('cin')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Email (Optionnel)</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="patient@email.com">
                    @error('email')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Téléphone</label>
                    <input name="telephone" value="{{ old('telephone') }}" type="tel" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="06XXXXXXXX">
                    @error('telephone')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Date de Naissance</label>
                    <input name="date_naissance" value="{{ old('date_naissance') }}" type="date" max="{{ now()->subDay()->toDateString() }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                    @error('date_naissance')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Adresse</label>
                    <input name="adresse" value="{{ old('adresse') }}" type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="Adresse du patient">
                    @error('adresse')
                        <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-500">
                Si aucun email n'est saisi, le système générera automatiquement une adresse email interne pour créer le dossier patient dans la base de données.
            </div>

            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-patient').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="submit" class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg hover:shadow-xl transition-all">
                    Enregistrer le Patient
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('modal-add-patient').classList.remove('hidden');
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('patient-search-input');
        const patientRows = Array.from(document.querySelectorAll('.patient-row'));
        const emptyRow = document.getElementById('patients-empty-row');

        if (!searchInput) {
            return;
        }

        const filterRows = function () {
            const query = searchInput.value.trim().toLowerCase();
            let visibleCount = 0;

            patientRows.forEach(function (row) {
                const name = row.dataset.name || '';
                const cin = row.dataset.cin || '';
                const matches = query === '' || name.includes(query) || cin.includes(query);

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
