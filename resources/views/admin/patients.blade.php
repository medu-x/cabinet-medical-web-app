<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Clinical Vitality — Gestion des Patients</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#006876",
                    "primary-container": "#008394",
                    "secondary": "#515f74",
                    "surface-container": "#eceef0",
                    "surface-container-low": "#f2f4f6",
                    "surface-container-lowest": "#ffffff",
                    "error": "#ba1a1a",
                    "on-surface": "#191c1e",
                    "on-surface-variant": "#3e494b",
                    "background": "#f7f9fb",
                },
                fontFamily: { body: ["Inter"] }
            }
        }
    }
</script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    .cta-gradient { background: linear-gradient(135deg, #006876 0%, #008394 100%); }
</style>
</head>
<body class="bg-background text-on-surface">

{{-- ══ SIDEBAR ══ --}}
<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-50 border-r border-slate-200/50 flex flex-col py-6 z-40">
    <div class="px-6 mb-10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-white">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">medical_services</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-teal-900 tracking-tight">Vitality Admin</h2>
            <p class="text-[10px] uppercase tracking-widest text-secondary font-bold">Clinical Excellence</p>
        </div>
    </div>
    <nav class="flex-1 space-y-1 px-3">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">dashboard</span> Dashboard
        </a>
        <a href="{{ route('admin.patients') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">group</span> Patients
        </a>
        <a href="{{ route('admin.secrataires') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">badge</span> Secrétaires
        </a>
        <a href="{{ route('admin.doctors') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">medical_services</span> Médecins
        </a>
    </nav>
    <div class="mt-auto px-3 pt-4 border-t border-slate-200">
        <a href="{{ route('logout') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-error hover:bg-red-50 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">logout</span> Déconnexion
        </a>
    </div>
</aside>

{{-- ══ MAIN ══ --}}
<div class="ml-64 flex flex-col min-h-screen">

    {{-- Top bar --}}
    <header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100 flex items-center justify-between px-8 py-3">
        <div class="flex items-center flex-1 max-w-md">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400"
                       placeholder="Rechercher un patient..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-bold text-teal-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500">Super Admin</p>
            </div>
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8">

        {{-- Flash --}}
        @if (session('success'))
            <div class="flex items-center gap-3 bg-teal-50 border border-teal-200 text-teal-800 px-5 py-4 rounded-2xl text-sm font-medium">
                <span class="material-symbols-outlined text-teal-600">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-semibold text-primary/60 tracking-wider uppercase">
                    <span>Gestion</span>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-primary">Patients</span>
                </nav>
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Base de Données Patients</h1>
                <p class="text-secondary max-w-2xl">Gérez les dossiers de vos patients depuis une interface centralisée.</p>
            </div>
        </section>

        {{-- Table --}}
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-on-surface">Liste des Patients</h3>
                <span class="text-xs text-slate-400 font-medium">{{ $patients->total() }} enregistrements</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">CIN</th>
                            <th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Téléphone</th>
                            <th class="px-8 py-4 text-xs font-bold text-secondary uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @forelse ($patients as $patient)
                        @php
                            $initials = collect(explode(' ', $patient->user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
                            $colors = ['bg-primary/10 text-primary','bg-purple-100 text-purple-600','bg-blue-100 text-blue-600','bg-teal-100 text-teal-600','bg-orange-100 text-orange-600'];
                            $color  = $colors[$patient->id % count($colors)];
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm {{ $color }}">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-on-surface">{{ $patient->user->name }}</p>
                                        <p class="text-xs text-on-surface-variant">
                                            @if($patient->date_naissance)
                                                {{ \Carbon\Carbon::parse($patient->date_naissance)->age }} ans
                                            @else
                                                —
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-on-surface">{{ $patient->cin ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $patient->user->email }}</td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $patient->telephone ?? '—' }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Edit --}}
                                    <button onclick="openPatientModal({{ $patient->id }}, '{{ addslashes($patient->user->name) }}', '{{ addslashes($patient->user->email) }}', '{{ addslashes($patient->telephone) }}', '{{ addslashes($patient->cin) }}')"
                                            class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Modifier">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.patients.destroy', $patient->id) }}"
                                          onsubmit="return confirm('Supprimer {{ $patient->user->name }} ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Supprimer">
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2">group</span>
                                Aucun patient enregistré.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-8 py-5 border-t border-surface-container flex items-center justify-between">
                <p class="text-xs text-on-surface-variant font-medium">
                    Affichage de {{ $patients->firstItem() ?? 0 }} à {{ $patients->lastItem() ?? 0 }} sur {{ $patients->total() }} patients
                </p>
                <div>{{ $patients->links() }}</div>
            </div>
        </section>
    </main>
</div>

{{-- ══ EDIT MODAL ══ --}}
<div id="modal-edit-patient" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Modifier le Patient</h3>
                <p class="text-xs text-slate-500 mt-1">Mettez à jour les informations</p>
            </div>
            <button onclick="closePatientModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <form id="edit-patient-form" method="POST" class="p-8 space-y-5">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Nom Complet</label>
                    <input type="text" name="name" id="ep-name"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Email</label>
                    <input type="email" name="email" id="ep-email"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Téléphone</label>
                    <input type="text" name="telephone" id="ep-telephone"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">CIN</label>
                    <input type="text" name="cin" id="ep-cin"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closePatientModal()"
                        class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="submit"
                        class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openPatientModal(id, name, email, telephone, cin) {
        document.getElementById('ep-name').value      = name;
        document.getElementById('ep-email').value     = email;
        document.getElementById('ep-telephone').value = telephone;
        document.getElementById('ep-cin').value       = cin;
        document.getElementById('edit-patient-form').action = '/admin/patients/' + id;
        document.getElementById('modal-edit-patient').classList.remove('hidden');
        document.getElementById('modal-edit-patient').classList.add('flex');
    }
    function closePatientModal() {
        document.getElementById('modal-edit-patient').classList.add('hidden');
        document.getElementById('modal-edit-patient').classList.remove('flex');
    }
</script>
</body>
</html>
