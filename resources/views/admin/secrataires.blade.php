<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Clinical Vitality — Gestion des Secrétaires</title>
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
                    "error-container": "#ffdad6",
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
        <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-2xl">medical_services</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-teal-900 tracking-tight">Cabinet Médical</h2>
            <p class="text-[10px] uppercase tracking-widest text-secondary font-bold">Administration</p>
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
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-teal-700 bg-teal-50/50 rounded-xl transition-all duration-200">
            <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1;">badge</span> Secrétaires
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
                       placeholder="Rechercher une secrétaire..." type="text"/>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-bold text-teal-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500">Super Admin</p>
            </div>
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8 pb-0">

        {{-- Flash message --}}
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
                    <span class="text-primary">Secrétaires</span>
                </nav>
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Gestion des Secrétaires</h1>
                <p class="text-secondary max-w-2xl">Visualisez et gérez l'équipe administrative du cabinet.</p>
            </div>
            <button onclick="openAddModal()"
                    class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">badge</span>
                Ajouter une Secrétaire
            </button>
        </section>

        {{-- Table --}}
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-on-surface">Liste des Secrétaires</h3>
                <span class="text-xs text-slate-400 font-medium">{{ $secretaires->total() }} enregistrements</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-1 px-4">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
                            <th class="px-6 py-4">Nom & Identité</th>
                            <th class="px-6 py-4">CIN</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Bureau</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($secretaires as $sec)
                        @php
                            $initials = collect(explode(' ', $sec->user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
                            $bureauColors = ['A' => 'bg-teal-100 text-teal-700', 'B' => 'bg-blue-100 text-blue-700', 'C' => 'bg-violet-100 text-violet-700'];
                            $buColor = $bureauColors[$sec->bureau] ?? 'bg-slate-100 text-slate-600';
                        @endphp
                        <tr class="group hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-teal-900">{{ $sec->user->name }}</p>
                                        <p class="text-[10px] text-slate-400">ID: SEC-{{ str_pad($sec->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-medium">{{ $sec->cin ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $sec->user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter {{ $buColor }}">
                                    Bureau {{ $sec->bureau }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Edit button → opens modal --}}
                                    <button onclick="openEditModal({{ $sec->id }}, '{{ addslashes($sec->user->name) }}', '{{ addslashes($sec->user->email) }}', '{{ $sec->bureau }}', '{{ addslashes($sec->cin) }}')"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    {{-- Delete form --}}
                                    <form method="POST" action="{{ route('admin.secrataires.destroy', $sec->id) }}"
                                          onsubmit="return confirm('Supprimer {{ $sec->user->name }} ? Cette action est irréversible.')">
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
                            <td colspan="5" class="px-8 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2">badge</span>
                                Aucune secrétaire enregistrée.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-8 py-4 border-t border-slate-100 flex items-center justify-between">
                <p class="text-xs text-slate-500 font-medium">
                    Affichage de {{ $secretaires->firstItem() ?? 0 }} à {{ $secretaires->lastItem() ?? 0 }} sur {{ $secretaires->total() }} secrétaires
                </p>
                <div>{{ $secretaires->links() }}</div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="w-full py-6 bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs text-slate-500 mb-4 md:mb-0">© 2026 Cabinet Médical. Tous droits réservés.</div>
        <div class="flex gap-6">
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Politique de confidentialité</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conditions d'utilisation</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conformité HIPAA</a>
        </div>
    </footer>
</div>

{{-- ══ ADD MODAL ══ --}}
<div id="modal-add-sec" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden flex flex-col max-h-[90vh]">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Ajouter une Secrétaire</h3>
                <p class="text-xs text-slate-500 mt-1">Créez un nouveau compte secrétaire</p>
            </div>
            <button onclick="closeAddModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.secrataires.store') }}" class="p-8 overflow-y-auto flex-1 space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Nom Complet</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="Prénom Nom" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Email</label>
                    <input type="email" name="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="secretaire@cabinet.com" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Mot de passe provisoire</label>
                    <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="••••••••" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">CIN</label>
                    <input type="text" name="cin" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="AB123456" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Bureau</label>
                    <select name="bureau" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                        <option value="A">Bureau A</option>
                        <option value="B">Bureau B</option>
                        <option value="C">Bureau C</option>
                    </select>
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
<div id="modal-edit-sec" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Modifier la Secrétaire</h3>
                <p class="text-xs text-slate-500 mt-1">Mettez à jour les informations</p>
            </div>
            <button onclick="closeEditModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <form id="edit-sec-form" method="POST" class="p-8 space-y-5">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Nom Complet</label>
                    <input type="text" name="name" id="edit-name"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Email</label>
                    <input type="email" name="email" id="edit-email"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">CIN</label>
                    <input type="text" name="cin" id="edit-cin"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Bureau</label>
                    <select name="bureau" id="edit-bureau"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" required>
                        <option value="A">Bureau A</option>
                        <option value="B">Bureau B</option>
                        <option value="C">Bureau C</option>
                    </select>
                </div>
            </div>
            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()"
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
    function openAddModal() {
        document.getElementById('modal-add-sec').classList.remove('hidden');
        document.getElementById('modal-add-sec').classList.add('flex');
    }
    function closeAddModal() {
        document.getElementById('modal-add-sec').classList.add('hidden');
        document.getElementById('modal-add-sec').classList.remove('flex');
    }
    function openEditModal(id, name, email, bureau, cin) {
        document.getElementById('edit-name').value   = name;
        document.getElementById('edit-email').value  = email;
        document.getElementById('edit-bureau').value = bureau;
        document.getElementById('edit-cin').value    = cin;
        document.getElementById('edit-sec-form').action = '/admin/secrataires/' + id;
        document.getElementById('modal-edit-sec').classList.remove('hidden');
        document.getElementById('modal-edit-sec').classList.add('flex');
    }
    function closeEditModal() {
        document.getElementById('modal-edit-sec').classList.add('hidden');
        document.getElementById('modal-edit-sec').classList.remove('flex');
    }
</script>
</body>
</html>
