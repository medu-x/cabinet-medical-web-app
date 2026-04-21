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
            <h1 class="text-lg font-bold text-teal-900">Vue Globale d'Aujourd'hui</h1>
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
                <h1 class="text-4xl font-bold tracking-tight text-teal-900">File d'attente En Direct</h1>
                <p class="text-secondary max-w-2xl">Visualisez et gérez les patients présents dans la salle d'attente à l'instant T.</p>
            </div>
            <div class="text-right">
                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Date d'aujourd'hui</div>
                <div class="text-2xl font-black text-primary">{{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F Y') }}</div>
            </div>
        </section>

        <!-- Dynamic Queue Section -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Col 1: En Consultation -->
            <div class="bg-primary/5 rounded-2xl p-6 border border-primary/20 flex flex-col">
                <h3 class="font-bold text-teal-900 flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">meeting_room</span>
                    En Consultation
                </h3>
                <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 mb-3">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[10px] font-bold text-white bg-primary px-2 py-0.5 rounded uppercase tracking-wider">Actuel</span>
                        <span class="text-xs font-bold text-slate-500">09:00</span>
                    </div>
                    <p class="font-bold text-teal-900">Marie Durand</p>
                    <p class="text-xs text-slate-500">Dr. Dupont (Généraliste)</p>
                </div>
            </div>

            <!-- Col 2: En Salle d'attente -->
            <div class="bg-surface-container-low rounded-2xl p-6 border border-slate-200 flex flex-col lg:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-teal-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">airline_seat_recline_normal</span>
                        Patients en Salle d'Attente
                    </h3>
                    <span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full">3 Personnes</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex justify-center items-center font-bold text-slate-500">
                            1
                        </div>
                        <div>
                            <p class="font-bold text-teal-900">Jean Tremblay</p>
                            <p class="text-xs text-slate-500 mb-1">Arrivé à 09:15</p>
                            <span class="text-[10px] bg-orange-100 text-orange-800 font-bold px-2 py-0.5 rounded uppercase">Urgences Mineures</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex justify-center items-center font-bold text-slate-500">
                            2
                        </div>
                        <div>
                            <p class="font-bold text-teal-900">Lucas Fontaine</p>
                            <p class="text-xs text-slate-500 mb-1">Prévu à 09:30 (Présent)</p>
                            <span class="text-[10px] bg-blue-100 text-blue-800 font-bold px-2 py-0.5 rounded uppercase">Généraliste</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex justify-center items-center font-bold text-slate-500">
                            3
                        </div>
                        <div>
                            <p class="font-bold text-teal-900">Fatima Berrada</p>
                            <p class="text-xs text-slate-500 mb-1">Prévu à 10:00 (Présente)</p>
                            <span class="text-[10px] bg-purple-100 text-purple-800 font-bold px-2 py-0.5 rounded uppercase">Cardiologie</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
