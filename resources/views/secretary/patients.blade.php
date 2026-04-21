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

<!-- SideNavBar -->
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

<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
    <!-- TopAppBar -->
    <header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100">
        <div class="flex items-center justify-between px-8 py-3 w-full">
            <div class="flex items-center flex-1 max-w-md">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" placeholder="Rechercher un patient (CIN, nom, num)..." type="text"/>
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

    <!-- Canvas Area -->
    <main class="flex-1 p-8 space-y-8">
        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="space-y-2">
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Base Patients</h1>
                <p class="text-secondary max-w-2xl">Recherchez un dossier existant ou créez un nouveau profil lorsqu'un patient arrive sans compte.</p>
            </div>
            <button onclick="document.getElementById('modal-add-patient').classList.remove('hidden')" class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                Nouveau Patient
            </button>
        </section>

        <!-- Data Table Section -->
        <section class="bg-surface-container-low rounded-[2rem] overflow-hidden">
            <div class="bg-white p-1 rounded-[2rem] shadow-sm">
                <table class="w-full text-left border-separate border-spacing-y-2 px-4">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
                            <th class="px-6 py-4">Nom & Identité</th>
                            <th class="px-6 py-4">CIN</th>
                            <th class="px-6 py-4">Téléphone</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Mock Row -->
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold">AL</div>
                                    <div>
                                        <p class="font-bold text-teal-900">Amine Larabi</p>
                                        <p class="text-[10px] text-slate-400">Né(e) le 12/05/1990</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="font-bold text-slate-600">AB123456</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="text-slate-500">06 12 34 56 78</span>
                            </td>
                            <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                <button class="px-4 py-2 bg-primary/5 text-primary rounded-lg text-xs font-bold hover:bg-primary/10 transition-colors">
                                    Voir Dossier
                                </button>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold">SF</div>
                                    <div>
                                        <p class="font-bold text-teal-900">Sarah Figuier</p>
                                        <p class="text-[10px] text-slate-400">Né(e) le 21/08/1985</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="font-bold text-slate-600">CD987654</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="text-slate-500">07 98 76 54 32</span>
                            </td>
                            <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                <button class="px-4 py-2 bg-primary/5 text-primary rounded-lg text-xs font-bold hover:bg-primary/10 transition-colors">
                                    Voir Dossier
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- Modal Create Patient -->
<div id="modal-add-patient" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col">
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-surface-container-lowest">
            <div>
                <h3 class="text-xl font-bold text-teal-900">Ajouter un Patient</h3>
                <p class="text-xs text-slate-500 mt-1">Création de dossier pour patient sans compte</p>
            </div>
            <button onclick="document.getElementById('modal-add-patient').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        
        <form class="p-8 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Nom Complet</label>
                    <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="Karim Alaoui">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">CIN (Optionnel)</label>
                    <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="XX123456">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Téléphone</label>
                    <input type="tel" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20" placeholder="06XXXXXXXX">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Date de Naissance</label>
                    <input type="date" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
            </div>
            
            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-patient').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="button" class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg hover:shadow-xl transition-all">
                    Enregistrer le Patient
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
