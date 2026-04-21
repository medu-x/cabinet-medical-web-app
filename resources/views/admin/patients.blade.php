<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Clinical Vitality - Gestion des Patients</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#006876",
                    "on-tertiary-fixed": "#301400",
                    "outline-variant": "#bdc8cb",
                    "on-error-container": "#93000a",
                    "surface-variant": "#e0e3e5",
                    "on-background": "#191c1e",
                    "background": "#f7f9fb",
                    "surface-container": "#eceef0",
                    "primary-fixed-dim": "#75d4e7",
                    "outline": "#6e797c",
                    "inverse-on-surface": "#eff1f3",
                    "surface-container-lowest": "#ffffff",
                    "error": "#ba1a1a",
                    "tertiary-fixed": "#ffdcc5",
                    "on-surface-variant": "#3e494b",
                    "surface-container-low": "#f2f4f6",
                    "secondary-container": "#d5e3fc",
                    "on-error": "#ffffff",
                    "on-primary-fixed": "#001f25",
                    "surface": "#f7f9fb",
                    "tertiary": "#8d4e16",
                    "on-secondary": "#ffffff",
                    "surface-tint": "#006876",
                    "secondary-fixed-dim": "#b9c7df",
                    "inverse-surface": "#2d3133",
                    "tertiary-container": "#ab662d",
                    "primary-fixed": "#a0efff",
                    "secondary": "#515f74",
                    "surface-bright": "#f7f9fb",
                    "on-secondary-fixed": "#0d1c2e",
                    "surface-dim": "#d8dadc",
                    "surface-container-highest": "#e0e3e5",
                    "on-tertiary-fixed-variant": "#703800",
                    "on-secondary-container": "#57657a",
                    "on-surface": "#191c1e",
                    "tertiary-fixed-dim": "#ffb782",
                    "on-primary-fixed-variant": "#004e59",
                    "on-primary": "#ffffff",
                    "surface-container-high": "#e6e8ea",
                    "error-container": "#ffdad6",
                    "inverse-primary": "#75d4e7",
                    "on-tertiary": "#ffffff",
                    "on-primary-container": "#000608",
                    "primary-container": "#008394",
                    "on-tertiary-container": "#0c0300",
                    "secondary-fixed": "#d5e3fc",
                    "on-secondary-fixed-variant": "#3a485b"
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
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #bdc8cb; border-radius: 10px; }
    </style>
</head>
<body class="bg-background text-on-surface flex min-h-screen">
<!-- SideNavBar -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-50 dark:bg-slate-950 border-r border-slate-200/50 dark:border-slate-800/50 z-50 flex flex-col py-6">
<div class="px-6 mb-8 flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary shadow-lg shadow-primary/20">
<span class="material-symbols-outlined">medical_services</span>
</div>
<div>
<h1 class="text-lg font-black text-teal-900 dark:text-teal-200 leading-none">Vitality Admin</h1>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold mt-1">Clinical Excellence</p>
</div>
</div>
<nav class="flex-1 px-3 space-y-1">
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-teal-600 dark:hover:text-teal-300 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all duration-200 ease-in-out rounded-xl text-sm font-medium tracking-wide" href="{{ route('admin.dashboard') }}">
<span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </a>
<a class="flex items-center gap-3 px-4 py-3 text-teal-700 dark:text-teal-400 border-r-4 border-teal-600 dark:border-teal-400 bg-teal-50/50 dark:bg-teal-900/10 transition-all duration-200 ease-in-out rounded-xl text-sm font-medium tracking-wide" href="{{ route('admin.patients') }}">
<span class="material-symbols-outlined">group</span>
            Patients
        </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-teal-600 dark:hover:text-teal-300 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all duration-200 ease-in-out rounded-xl text-sm font-medium tracking-wide" href="{{ route('admin.secrataires') }}">
<span class="material-symbols-outlined">badge</span>
            Secrétaires
        </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-teal-600 dark:hover:text-teal-300 hover:bg-slate-100 dark:hover:bg-slate-900 transition-all duration-200 ease-in-out rounded-xl text-sm font-medium tracking-wide" href="{{ route('admin.doctors') }}">
<span class="material-symbols-outlined">medical_services</span>
            Médecins
        </a>
</nav>
<div class="px-6 mt-6">
<button class="w-full py-3 bg-gradient-to-br from-primary to-primary-container text-white rounded-xl font-semibold shadow-md shadow-primary/20 flex items-center justify-center gap-2 active:scale-95 transition-transform">
<span class="material-symbols-outlined text-sm">add</span>
            Add New Record
        </button>
</div>
<div class="mt-auto px-3 space-y-1 pt-6 border-t border-slate-100 dark:border-slate-800">
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:text-teal-600 rounded-xl text-sm font-medium tracking-wide" href="#">
<span class="material-symbols-outlined">settings</span>
            Settings
        </a>
<a class="flex items-center gap-3 px-4 py-3 text-error hover:bg-error-container/20 rounded-xl text-sm font-medium tracking-wide" href="#">
<span class="material-symbols-outlined">logout</span>
            Logout
        </a>
</div>
</aside>
<!-- Main Wrapper -->
<main class="ml-64 flex-1 flex flex-col min-h-screen">
<!-- TopAppBar -->
<header class="w-full sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-sm dark:shadow-none flex items-center justify-between px-6 py-3 border-b border-slate-100 dark:border-slate-800">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-slate-800/50 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-500" placeholder="Rechercher un patient..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors rounded-xl relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
</button>
<button class="p-2 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors rounded-xl">
<span class="material-symbols-outlined">help</span>
</button>
<div class="h-8 w-px bg-slate-100 dark:bg-slate-800 mx-1"></div>
<div class="flex items-center gap-3 pl-2">
<div class="text-right hidden sm:block">
<p class="text-xs font-bold text-teal-800 dark:text-teal-300">Clinical Vitality</p>
<p class="text-[10px] text-slate-500">Admin Panel</p>
</div>
<img alt="Admin Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-primary/10" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5ddexIYUsT2dR4mnoMooR4oi2cAhC0wOCUZJW4gFCCzhNmS_VE_9uFCh_dRaVUrMmmtAhspMctTWN6zhM_kekO1P0EYe8CfhDQosJDKIt4_TfMYsXFC8lZAEnDeuAfcGJEnLWJ2eUSMpE-v0tbxDQlraEpm1575gG9_PlJbpQN7gyFTgH0kkeBRuP8D6uAIgDM5RXKPgogKYUDXZPViHEWM0QQnKRYva2MrRViI_pvYU-EEsD8WyZrdlhMF57dTqprOC5xMODyQc"/>
</div>
</div>
</header>
<!-- Page Content -->
<div class="p-8 space-y-8">
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div>
<nav class="flex items-center gap-2 text-xs text-secondary font-medium mb-2">
<span>Dashboard</span>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<span class="text-primary font-bold">Gestion des Patients</span>
</nav>
<h2 class="text-3xl font-bold tracking-tight text-on-surface">Base de Données Patients</h2>
<p class="text-on-surface-variant text-sm mt-1 max-w-xl">Gérez les dossiers médicaux, suivez les visites et communiquez avec vos patients depuis une interface centralisée et sécurisée.</p>
</div>
<button class="flex items-center gap-2 bg-primary hover:bg-primary-container text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-primary/20 transition-all active:scale-95">
<span class="material-symbols-outlined">person_add</span>
                Ajouter un Patient
            </button>
</div>
<!-- Table Section Only -->
<div class="bg-surface-container-lowest rounded-3xl shadow-sm overflow-hidden border border-outline-variant/10">
<div class="px-8 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-surface-container">
<h3 class="text-lg font-bold text-on-surface">Liste des Patients</h3>
<div class="flex items-center gap-3">
<button class="p-2.5 text-slate-500 bg-surface-container-low rounded-xl hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined text-lg">filter_list</span>
</button>
<button class="p-2.5 text-slate-500 bg-surface-container-low rounded-xl hover:bg-slate-200 transition-colors">
<span class="material-symbols-outlined text-lg">download</span>
</button>
</div>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low/50">
<th class="px-8 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Patient</th>
<th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">CIN</th>
<th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Email</th>
<th class="px-6 py-4 text-xs font-bold text-secondary uppercase tracking-wider">Téléphone</th>

<th class="px-8 py-4 text-xs font-bold text-secondary uppercase tracking-wider text-center">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container">
@php
    $colors = ['bg-primary/10 text-primary', 'bg-purple-100 text-purple-600', 'bg-blue-100 text-blue-600', 'bg-teal-100 text-teal-600'];
@endphp
@foreach($patients as $index => $patient)
<tr class="hover:bg-slate-50/50 transition-colors group">
<td class="px-8 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full {{ $colors[$index % count($colors)] }} flex items-center justify-center font-bold text-sm">{{ strtoupper(substr($patient->user->name, 0, 1) . (strpos($patient->user->name, ' ') !== false ? substr($patient->user->name, strpos($patient->user->name, ' ') + 1, 1) : '')) }}</div>
<div>
<p class="text-sm font-bold text-on-surface">{{ $patient->user->name }}</p>
<p class="text-xs text-on-surface-variant">{{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age . ' ans' : 'N/A' }}</p>
</div>
</div>
</td>
<td class="px-6 py-4 text-sm font-medium text-on-surface">{{ $patient->cin }}</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">{{ $patient->user->email }}</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">{{ $patient->telephone }}</td>

<td class="px-8 py-4 text-right">
<div class="flex items-center justify-end gap-1">
<button class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Voir Profil">
<span class="material-symbols-outlined text-lg">visibility</span>
</button>
<button class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Modifier">
<span class="material-symbols-outlined text-lg">edit</span>
</button>
<button class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Supprimer">
<span class="material-symbols-outlined text-lg">delete</span>
</button>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
<!-- Pagination -->
<div class="px-8 py-5 border-t border-surface-container flex items-center justify-between">
<p class="text-xs text-on-surface-variant font-medium">Affichage de {{ $patients->firstItem() ?? 0 }} à {{ $patients->lastItem() ?? 0 }} sur {{ $patients->total() }} patients</p>
<div class="flex items-center gap-2">
@if($patients->onFirstPage())
<button class="p-2 text-slate-400 hover:text-primary transition-colors disabled:opacity-30" disabled="">
<span class="material-symbols-outlined">chevron_left</span>
</button>
@else
<a href="{{ $patients->previousPageUrl() }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">chevron_left</span>
</a>
@endif
<div class="flex items-center gap-1">
@foreach($patients->getUrlRange(1, $patients->lastPage()) as $page => $url)
@if($page == $patients->currentPage())
<button class="w-8 h-8 rounded-lg bg-primary text-white text-xs font-bold">{{ $page }}</button>
@else
<a href="{{ $url }}" class="w-8 h-8 rounded-lg hover:bg-surface-container text-on-surface text-xs font-medium transition-colors">{{ $page }}</a>
@endif
@endforeach
@if($patients->lastPage() > 5)
<span class="px-1 text-slate-400">...</span>
<a href="{{ $patients->url($patients->lastPage()) }}" class="w-8 h-8 rounded-lg hover:bg-surface-container text-on-surface text-xs font-medium transition-colors">{{ $patients->lastPage() }}</a>
@endif
</div>
@if($patients->hasMorePages())
<a href="{{ $patients->nextPageUrl() }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
<span class="material-symbols-outlined">chevron_right</span>
</a>
@else
<button class="p-2 text-slate-400 hover:text-primary transition-colors disabled:opacity-30" disabled="">
<span class="material-symbols-outlined">chevron_right</span>
</button>
@endif
</div>
</div>
</div>
</div>
<!-- Footer Pattern Decor -->
<footer class="mt-auto p-8 opacity-40">
<div class="flex justify-center">
<svg class="text-outline-variant" fill="none" height="40" viewbox="0 0 200 40" width="200" xmlns="http://www.w3.org/2000/svg">
<path d="M0 20H200M20 0V40M60 0V40M100 0V40M140 0V40M180 0V40" stroke="currentColor" stroke-dasharray="2 2" stroke-width="0.5"></path>
</svg>
</div>
</footer>
</main>
</body></html>
