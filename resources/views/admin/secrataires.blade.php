<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Clinical Vitality - Gestion des Secrétaires</title>
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
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px -2px rgba(0, 104, 118, 0.08), 0 10px 40px -5px rgba(0, 0, 0, 0.04);
        }
        .cta-gradient {
            background: linear-gradient(135deg, #006876 0%, #008394 100%);
        }
        .ghost-border {
            outline: 1px solid rgba(110, 121, 124, 0.1);
        }
    </style>
</head>
<body class="bg-background text-on-surface">
<!-- SideNavBar Shell -->
<aside class="h-screen w-64 fixed left-0 top-0 bg-slate-50 border-r border-slate-200/50 flex flex-col py-6 z-40">
<div class="px-6 mb-10">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl bg-primary-container flex items-center justify-center text-white">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">medical_services</span>
</div>
<div>
<h2 class="text-lg font-black text-teal-900 tracking-tight">Vitality Admin</h2>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold">Clinical Excellence</p>
</div>
</div>
</div>
<nav class="flex-1 space-y-1">
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('admin.dashboard') }}">
<span class="material-symbols-outlined mr-3">dashboard</span>
                Dashboard
            </a>
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('admin.patients') }}">
<span class="material-symbols-outlined mr-3">group</span>
                Patients
            </a>
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-teal-700 border-r-4 border-teal-600 bg-teal-50/50 transition-all duration-200" href="{{ route('admin.secrataires') }}">
<span class="material-symbols-outlined mr-3" style="font-variation-settings: 'FILL' 1;">badge</span>
                Secrétaires
            </a>
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 transition-all duration-200" href="{{ route('admin.doctors') }}">
<span class="material-symbols-outlined mr-3">medical_services</span>
                Médecins
            </a>
</nav>
<div class="mt-auto px-4 space-y-1">
<div class="h-px bg-slate-200/50 mb-4 mx-2"></div>
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-lg transition-all duration-200" href="#">
<span class="material-symbols-outlined mr-3">settings</span>
                Settings
            </a>
<a class="flex items-center px-6 py-3 text-sm font-medium tracking-wide text-slate-600 hover:text-teal-600 hover:bg-slate-100 rounded-lg transition-all duration-200" href="#">
<span class="material-symbols-outlined mr-3">logout</span>
                Logout
            </a>
</div>
</aside>
<!-- Main Content Wrapper -->
<div class="ml-64 flex flex-col min-h-screen">
<!-- TopAppBar Shell -->
<header class="w-full sticky top-0 z-30 bg-white/80 backdrop-blur-xl shadow-sm border-b border-slate-100">
<div class="flex items-center justify-between px-8 py-3 w-full">
<div class="flex items-center flex-1 max-w-md">
<div class="relative w-full">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-400" placeholder="Rechercher des secrétaires..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-50 active:scale-95 transition-all">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-50 active:scale-95 transition-all">
<span class="material-symbols-outlined">help</span>
</button>
<div class="h-8 w-px bg-slate-100 mx-2"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="text-sm font-bold text-teal-800 leading-none">Admin Vitality</p>
<p class="text-[10px] text-slate-500">Super Admin</p>
</div>
<img class="w-10 h-10 rounded-xl object-cover ring-2 ring-primary/10" data-alt="portrait of a professional female hospital administrator with kind expression in a modern clinical setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuANs7ZPAtY12WzpbEo8p8N6dTQ770WmZOr3RMspXmZvRiFBKaS1hB9vQsvCKB0wbUSusFTaWqZlopyhZV0287inUvpakLD26AlL8_K15l7B6347OYLE4bxn0ecWT7Vscjb5M27fill6unKfK2unhLNi5yHet75PdRAR8BayALbENEjTekxMkBG6fm3ziM6-r5ZygX4voVKmuKaTvShVGzLhwbimn8ecwNkjRepKUsU_O10oT0VNXgPULff9UcOxbS7gjylrjgykZIQ"/>
</div>
</div>
</div>
</header>
<!-- Canvas Area -->
<main class="flex-1 p-8 space-y-8">
<!-- Hero Section / Title -->
<section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="space-y-2">
<nav class="flex items-center gap-2 text-xs font-semibold text-primary/60 tracking-wider uppercase">
<span>Gestion</span>
<span class="material-symbols-outlined text-[14px]">chevron_right</span>
<span class="text-primary">Secrétaires</span>
</nav>
<h1 class="text-4xl font-bold tracking-tight text-teal-900">Gestion des Secrétaires</h1>
<p class="text-secondary max-w-2xl">Visualisez, modifiez et gérez les droits d'accès de votre équipe administrative. Assurez une excellence opérationnelle au sein de Clinical Vitality.</p>
</div>
<button class="cta-gradient text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
<span class="material-symbols-outlined text-[20px]">add</span>
                    Ajouter une Secrétaire
                </button>
</section>
<!-- Data Table Section -->
<section class="bg-surface-container-low rounded-[2rem] overflow-hidden">
<div class="bg-surface-container-lowest p-1 rounded-[2rem] shadow-sm">
<table class="w-full text-left border-separate border-spacing-y-2 px-4">
<thead>
<tr class="text-slate-400 text-[11px] font-black uppercase tracking-widest">
<th class="px-6 py-4">Nom &amp; Identité</th>
<th class="px-6 py-4">Email</th>
<th class="px-6 py-4">Niveau d'Accès</th>
<th class="px-6 py-4">Date d'Adhésion</th>
<th class="px-6 py-4 text-right">Actions</th>
</tr>
</thead>
<tbody class="text-sm">
<!-- Row 1 -->
<tr class="group hover:bg-slate-50 transition-colors">
<td class="px-6 py-4 bg-white first:rounded-l-2xl group-hover:bg-slate-50 transition-colors">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">JD</div>
<div>
<p class="font-bold text-teal-900">Jeanne Dupont</p>
<p class="text-[10px] text-slate-400">ID: SEC-8921</p>
</div>
</div>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-600 font-medium">j.dupont@vitality.fr</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-teal-100 text-teal-700 uppercase tracking-tighter">Superviseur</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-500">12 Jan 2023</span>
</td>
<td class="px-6 py-4 bg-white last:rounded-r-2xl group-hover:bg-slate-50 transition-colors text-right">
<div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-error hover:bg-error/5 transition-all">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 2 -->
<tr class="group hover:bg-slate-50 transition-colors">
<td class="px-6 py-4 bg-white first:rounded-l-2xl group-hover:bg-slate-50 transition-colors">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold">ML</div>
<div>
<p class="font-bold text-teal-900">Marc Lefebvre</p>
<p class="text-[10px] text-slate-400">ID: SEC-4412</p>
</div>
</div>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-600 font-medium">m.lefebvre@vitality.fr</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-tighter">Standard</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-500">05 Mai 2023</span>
</td>
<td class="px-6 py-4 bg-white last:rounded-r-2xl group-hover:bg-slate-50 transition-colors text-right">
<div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-error hover:bg-error/5 transition-all">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 3 -->
<tr class="group hover:bg-slate-50 transition-colors">
<td class="px-6 py-4 bg-white first:rounded-l-2xl group-hover:bg-slate-50 transition-colors">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">SM</div>
<div>
<p class="font-bold text-teal-900">Sophie Martin</p>
<p class="text-[10px] text-slate-400">ID: SEC-1033</p>
</div>
</div>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-600 font-medium">s.martin@vitality.fr</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-teal-100 text-teal-700 uppercase tracking-tighter">Superviseur</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-500">22 Nov 2022</span>
</td>
<td class="px-6 py-4 bg-white last:rounded-r-2xl group-hover:bg-slate-50 transition-colors text-right">
<div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-error hover:bg-error/5 transition-all">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
<!-- Row 4 -->
<tr class="group hover:bg-slate-50 transition-colors">
<td class="px-6 py-4 bg-white first:rounded-l-2xl group-hover:bg-slate-50 transition-colors">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold">AB</div>
<div>
<p class="font-bold text-teal-900">Antoine Bernard</p>
<p class="text-[10px] text-slate-400">ID: SEC-5590</p>
</div>
</div>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-600 font-medium">a.bernard@vitality.fr</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-tighter">Lecture Seule</span>
</td>
<td class="px-6 py-4 bg-white group-hover:bg-slate-50 transition-colors">
<span class="text-slate-500">14 Fév 2024</span>
</td>
<td class="px-6 py-4 bg-white last:rounded-r-2xl group-hover:bg-slate-50 transition-colors text-right">
<div class="flex items-center justify-end gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
<span class="material-symbols-outlined text-[20px]">edit</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-error hover:bg-error/5 transition-all">
<span class="material-symbols-outlined text-[20px]">delete</span>
</button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination / Footer -->
<div class="px-8 py-4 flex items-center justify-between">
<p class="text-xs font-semibold text-slate-500">Affichage de <span class="text-teal-900">4</span> sur <span class="text-teal-900">12</span> secrétaires</p>
<div class="flex gap-2">
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:bg-white transition-all disabled:opacity-30" disabled="">
<span class="material-symbols-outlined text-[18px]">chevron_left</span>
</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white font-bold text-xs">1</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-white transition-all font-bold text-xs">2</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 hover:bg-white transition-all font-bold text-xs">3</button>
<button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:bg-white transition-all">
<span class="material-symbols-outlined text-[18px]">chevron_right</span>
</button>
</div>
</div>
</section>
</main>
<!-- Pattern Background Decoration -->
<div class="fixed bottom-0 right-0 w-64 h-64 opacity-[0.03] pointer-events-none -z-10 overflow-hidden">
<svg fill="none" height="400" viewbox="0 0 400 400" width="400" xmlns="http://www.w3.org/2000/svg">
<path d="M0 0H400V400H0V0Z" fill="white"></path>
<path d="M10 0V400M50 0V400M90 0V400M130 0V400M170 0V400M210 0V400M250 0V400M290 0V400M330 0V400M370 0V400" stroke="#006876" stroke-width="0.5"></path>
<path d="M0 10H400M0 50H400M0 90H400M0 130H400M0 170H400M0 210H400M0 250H400M0 290H400M0 330H400M0 370H400" stroke="#006876" stroke-width="0.5"></path>
</svg>
</div>
</div>
</body></html>
