<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Clinical Vitality — Gestion des Médecins</title>
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
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">group</span> Patients
        </a>
        <a href="{{ route('admin.secrataires') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined">badge</span> Secrétaires
        </a>
        <a href="{{ route('admin.doctors') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">medical_services</span> Médecins
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
                       placeholder="Rechercher un médecin..." type="text"/>
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
        @if ($errors->any())
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl text-sm font-medium">
                <span class="material-symbols-outlined text-red-600 mt-0.5">error</span>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Header --}}
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-1">
                <nav class="flex items-center gap-2 text-xs font-semibold text-primary/60 tracking-wider uppercase">
                    <span>Gestion</span>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-primary">Médecins</span>
                </nav>
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Corps Médical</h1>
                <p class="text-secondary max-w-2xl">Gérez les profils de vos praticiens et ajoutez de nouveaux médecins.</p>
            </div>
            <button onclick="openAddModal()"
                    class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Ajouter un Médecin
            </button>
        </section>

        {{-- Table --}}
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-on-surface">Liste des Médecins</h3>
                <span class="text-xs text-slate-400 font-medium">{{ $medecins->total() }} enregistrements</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-1 px-4">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
                            <th class="px-6 py-4">Médecin</th>
                            <th class="px-6 py-4">CIN</th>
                            <th class="px-6 py-4">Spécialité</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Téléphone</th>
                            <th class="px-6 py-4">Expérience</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($medecins as $med)
                        @php
                            $initials = collect(explode(' ', $med->user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
                        @endphp
                        <tr class="group hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-teal-900">{{ $med->user->name }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $med->level }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-medium">{{ $med->cin ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-teal-100 text-teal-700 uppercase tracking-tighter">
                                    {{ $med->specialite->nom ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-medium">{{ $med->user->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $med->telephone ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $med->experience }} ans</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit --}}
                                    <button onclick="openEditModal({{ $med->id }}, '{{ addslashes($med->user->name) }}', '{{ addslashes($med->user->email) }}', '{{ addslashes($med->cin) }}', {{ $med->specialite_id }}, '{{ addslashes($med->telephone) }}', {{ $med->experience }})"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.doctors.destroy', $med->id) }}"
                                          onsubmit="return confirm('Supprimer Dr. {{ $med->user->name }} ? Cette action est irréversible.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-error hover:bg-error/5 transition-all">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-8 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2">medical_services</span>
                                Aucun médecin enregistré.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-8 py-4 border-t border-slate-100 flex items-center justify-between">
                <p class="text-xs text-slate-500 font-medium">
                    Affichage de {{ $medecins->firstItem() ?? 0 }} à {{ $medecins->lastItem() ?? 0 }} sur {{ $medecins->total() }} médecins
                </p>
                <div>{{ $medecins->links() }}</div>
            </div>
        </section>
    </main>
</div>

{{-- ══ ADD MODAL ══ --}}
<div id="modal-add-doctor" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Ajouter un Médecin</h3>
                <p class="text-xs text-slate-500 mt-1">Créez un nouveau compte praticien</p>
            </div>
            <button onclick="closeAddModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.doctors.store') }}" class="p-8 overflow-y-auto flex-1 space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Nom Complet</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="Dr. Prénom Nom" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Email</label>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="medecin@cabinet.com" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">CIN</label>
                    <input type="text" name="cin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="MED0001">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Mot de passe provisoire</label>
                    <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="••••••••" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Spécialité</label>
                    <select name="specialite_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                        <option value="">— Choisir —</option>
                        @foreach ($specialites as $spe)
                            <option value="{{ $spe->id }}">{{ $spe->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Téléphone</label>
                    <input type="text" name="telephone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="06 XX XX XX XX">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Années d'expérience</label>
                    <input type="number" name="experience" min="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="5">
                </div>
            </div>
            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeAddModal()" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="submit" class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══ EDIT MODAL ══ --}}
<div id="modal-edit-doctor" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Modifier le Médecin</h3>
                <p class="text-xs text-slate-500 mt-1">Mettez à jour les informations du praticien</p>
            </div>
            <button onclick="closeEditModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <form id="edit-doctor-form" method="POST" class="p-8 overflow-y-auto flex-1 space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Nom Complet</label>
                    <input type="text" name="name" id="ed-name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Email</label>
                    <input type="email" name="email" id="ed-email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">CIN</label>
                    <input type="text" name="cin" id="ed-cin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Spécialité</label>
                    <select name="specialite_id" id="ed-specialite" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                        @foreach ($specialites as $spe)
                            <option value="{{ $spe->id }}">{{ $spe->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Téléphone</label>
                    <input type="text" name="telephone" id="ed-telephone" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Années d'expérience</label>
                    <input type="number" name="experience" id="ed-experience" min="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="submit" class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('modal-add-doctor').classList.remove('hidden');
        document.getElementById('modal-add-doctor').classList.add('flex');
    }
    function closeAddModal() {
        document.getElementById('modal-add-doctor').classList.add('hidden');
        document.getElementById('modal-add-doctor').classList.remove('flex');
    }
    function openEditModal(id, name, email, cin, specialiteId, telephone, experience) {
        document.getElementById('ed-name').value       = name;
        document.getElementById('ed-email').value      = email;
        document.getElementById('ed-cin').value        = cin;
        document.getElementById('ed-specialite').value = specialiteId;
        document.getElementById('ed-telephone').value  = telephone;
        document.getElementById('ed-experience').value = experience;
        document.getElementById('edit-doctor-form').action = '/admin/doctors/' + id;
        document.getElementById('modal-edit-doctor').classList.remove('hidden');
        document.getElementById('modal-edit-doctor').classList.add('flex');
    }
    function closeEditModal() {
        document.getElementById('modal-edit-doctor').classList.add('hidden');
        document.getElementById('modal-edit-doctor').classList.remove('flex');
    }
</script>
</body>
</html>
