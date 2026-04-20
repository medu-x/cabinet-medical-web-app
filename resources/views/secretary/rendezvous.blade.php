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
                    <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" placeholder="Rechercher avec date, medecin..." type="text"/>
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
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">Les Rendez-Vous</h1>
                <p class="text-secondary max-w-2xl">Visualisez tous les rendez-vous, modifiez-les, et créez-en de nouveaux pour des patients au téléphone ou physiquement présents.</p>
            </div>
            <button onclick="document.getElementById('modal-add-rdv').classList.remove('hidden')" class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Créer un Rendez-vous
            </button>
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
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Upcoming Row -->
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                <div>
                                    <p class="font-bold text-teal-900">Demain</p>
                                    <p class="text-[10px] text-slate-500">14:00</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="font-bold text-slate-600">Amine Larabi</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="text-slate-500">Dr. Robert Martin</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="bg-orange-100 text-orange-800 text-[10px] font-bold px-2 py-1 rounded uppercase">En Attente</span>
                            </td>
                            <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                <button class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Confirmer arrivée">
                                    <span class="material-symbols-outlined text-lg">check_circle</span>
                                </button>
                                <button class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Annuler">
                                    <span class="material-symbols-outlined text-lg">cancel</span>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Confirmed Row -->
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                <div>
                                    <p class="font-bold text-teal-900">Aujourd'hui</p>
                                    <p class="text-[10px] text-slate-500">09:15</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="font-bold text-slate-600">Jean Tremblay</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="text-slate-500">Dr. Robert Martin</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-1 rounded uppercase flex items-center gap-1 w-max">
                                    <span class="material-symbols-outlined text-[14px]">done</span> Confirmé
                                </span>
                            </td>
                            <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Past Row -->
                        <tr class="group hover:bg-slate-50 transition-colors opacity-70">
                            <td class="px-6 py-4 bg-white first:rounded-l-2xl border-y border-l border-slate-100">
                                <div>
                                    <p class="font-bold text-slate-600">18 Mars 2024</p>
                                    <p class="text-[10px] text-slate-500">10:30</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="font-bold text-slate-600">Sarah Figuier</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="text-slate-500">Dr. Celine Blanc</span>
                            </td>
                            <td class="px-6 py-4 bg-white border-y border-slate-100">
                                <span class="bg-slate-100 text-slate-500 text-[10px] font-bold px-2 py-1 rounded uppercase">Terminé</span>
                            </td>
                            <td class="px-6 py-4 bg-white last:rounded-r-2xl border-y border-r border-slate-100 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
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
        
        <form class="p-8 space-y-6 overflow-y-auto">
            <div class="grid grid-cols-2 gap-6">
                
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Sélectionner Patient</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                        <option>Amine Larabi - AB123456</option>
                        <option>Jean Tremblay - AA112233</option>
                    </select>
                </div>
                
                <div class="col-span-2">
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Médecin Consultant</label>
                    <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                        <option>Dr. Robert Martin (Cardiologue)</option>
                        <option>Dr. Celine Blanc (Généraliste)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Date du rendez-vous</label>
                    <input type="date" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-2">Heure</label>
                    <input type="time" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20">
                </div>
                
                <!-- Business Logic: Statut Choice -->
                <div class="col-span-2 mt-2">
                    <label class="block text-sm font-bold text-teal-900 mb-3 border-b border-slate-100 pb-2">Situation du Patient</label>
                    <div class="grid grid-cols-2 gap-4">
                        
                        <!-- Option 1: En_Attente -->
                        <label class="cursor-pointer relative">
                            <input type="radio" name="statut" value="en_attente" class="peer sr-only" checked>
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
                            <input type="radio" name="statut" value="confirme" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-primary peer-checked:bg-teal-50 transition-all">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="material-symbols-outlined text-green-500">how_to_reg</span>
                                    <span class="font-bold text-slate-700 peer-checked:text-teal-900">Présent Immédiatement</span>
                                </div>
                                <p class="text-xs text-slate-500">Statut: <strong class="text-green-600">Confirmé</strong><br/>Le patient vient d'arriver au cabinet sans RDV préalable et est ajouté à la file direct.</p>
                            </div>
                        </label>
                        
                    </div>
                </div>

            </div>
            
            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal-add-rdv').classList.add('hidden')" class="px-6 py-2.5 rounded-xl font-bold text-sm text-slate-500 hover:bg-slate-100">
                    Annuler
                </button>
                <button type="button" class="cta-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg hover:shadow-xl transition-all">
                    Planifier
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
