<!DOCTYPE html>

<html class="light overflow-hidden" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    @vite('resources/css/app.css')
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed-dim": "#75d4e7",
                        "secondary-fixed": "#d5e3fc",
                        "secondary": "#515f74",
                        "primary-container": "#008394",
                        "tertiary-fixed": "#ffdcc5",
                        "on-background": "#191c1e",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-container": "#0c0300",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#ab662d",
                        "on-primary": "#ffffff",
                        "surface-container": "#eceef0",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-tertiary-fixed": "#301400",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#8d4e16",
                        "primary": "#006876",
                        "outline-variant": "#bdc8cb",
                        "on-primary-fixed-variant": "#004e59",
                        "secondary-fixed-dim": "#b9c7df",
                        "primary-fixed": "#a0efff",
                        "secondary-container": "#d5e3fc",
                        "error": "#ba1a1a",
                        "surface-container-low": "#f2f4f6",
                        "surface": "#f7f9fb",
                        "inverse-surface": "#2d3133",
                        "inverse-primary": "#75d4e7",
                        "outline": "#6e797c",
                        "on-secondary-container": "#57657a",
                        "surface-tint": "#006876",
                        "on-error-container": "#93000a",
                        "background": "#f7f9fb",
                        "tertiary-fixed-dim": "#ffb782",
                        "on-primary-container": "#000608",
                        "surface-variant": "#e0e3e5",
                        "on-surface-variant": "#3e494b",
                        "surface-dim": "#d8dadc",
                        "surface-bright": "#f7f9fb",
                        "on-surface": "#191c1e",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed": "#001f25",
                        "on-tertiary-fixed-variant": "#703800",
                        "error-container": "#ffdad6"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-badge {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body overflow-hidden">
    <!-- main workspace - no sidebar since doctor just uses ce single page -->
    <main class="h-screen bg-surface-container-low flex flex-col">
        <!-- top bar : logo + doctor info + logout -->
        <header class="h-14 flex items-center justify-between px-6 bg-surface-container-lowest border-b border-outline-variant/10 shadow-sm">
            {{-- logo et nom app --}}
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-[18px]">medical_services</span>
                </div>
                <span class="text-base font-black text-teal-800 tracking-tight">Cabinet Medical</span>
                <div class="h-4 w-[1px] bg-outline-variant/30 mx-1"></div>
                <p class="text-xs text-on-surface-variant font-medium">
                    {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F Y') }}
                </p>
            </div>
            {{-- doctor profile + logout a droite --}}
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <img src="{{ $user->photo_url }}" class="w-8 h-8 rounded-full object-cover border-2 border-primary/20" alt="photo" />
                    <div>
                        <p class="text-xs font-bold text-on-surface leading-none">Dr. {{ $user->name }}</p>
                        <p class="text-[10px] text-on-surface-variant">{{ $user->medecin->specialite->nom }}</p>
                    </div>
                </div>
                {{-- logout --}}
                <a href="{{ route('logout') }}" class="flex items-center gap-1 text-xs text-outline hover:text-red-500 transition-colors px-2 py-1 rounded-lg hover:bg-red-50">
                    <span class="material-symbols-outlined text-[16px]">logout</span>
                    Déconnexion
                </a>
            </div>
        </header>
        <!-- Content Grid -->
        <div class="flex-1 p-4 grid grid-cols-12 gap-4 overflow-hidden">
            <!-- queue : reduite en col-span-2 pour donner plus de place au centre -->
            <section class="col-span-2 flex flex-col gap-4 overflow-hidden">
                <div
                    class="bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-outline-variant/10 flex flex-col h-full overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary"
                                data-icon="pending_actions">pending_actions</span>
                            File d'attente
                        </h3>
                        <span
                            class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-lg uppercase tracking-wider">{{ $rendezVousDuJourConfirmed->count() }}</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto space-y-4 pr-1">
                        @forelse ($rendezVousDuJourConfirmed as $index => $rdv)
                            @php $isActive = $activeRdv && $activeRdv->id === $rdv->id; @endphp
                            <a href="?rdv={{ $rdv->id }}" class="block">
                                <div class="p-4 rounded-xl flex flex-col gap-2 transition-all cursor-pointer
                                    {{ $isActive
                                        ? 'bg-primary text-on-primary shadow-md border border-primary/20'
                                        : 'bg-surface-container-low hover:bg-surface-container border border-transparent hover:border-outline-variant/20 ' . ($index > 1 ? 'opacity-70' : '') }}">
                                    <div class="flex justify-between items-start">
                                        <span class="text-[10px] font-bold uppercase {{ $isActive ? 'opacity-80' : ($index === 0 ? 'text-primary' : 'text-on-surface-variant') }}">
                                            @if ($index === 0) En consultation
                                            @elseif ($index === 1) Suivant
                                            @else Attente
                                            @endif
                                        </span>
                                        <span class="text-[10px] font-bold {{ $isActive ? '' : 'text-on-surface-variant' }}">{{ substr($rdv->heure_rendez_vous, 0, 5) }}</span>
                                    </div>
                                    <p class="font-bold text-sm {{ $isActive ? '' : 'text-on-surface' }}">{{ $rdv->patient->user->name }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-center text-on-surface-variant mt-8">Aucun rendez-vous confirmé aujourd'hui.</p>
                        @endforelse
                    </div>

                </div>
            </section>
            <!-- Center/Right: Active Consultation -->
            <section class="col-span-10 flex flex-col gap-4 overflow-hidden">
                <!-- Patient Info Header -->
@if ($activeRdv)
                @php
                    $patient     = $activeRdv->patient;
                    $patientUser = $patient->user;
                    $dossier     = $patient->dossierMedical;
                    $age         = \Carbon\Carbon::parse($patient->date_naissance)->age;
                @endphp
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <img alt="{{ $patientUser->name }}" class="w-16 h-16 rounded-2xl object-cover"
                                src="{{ $patientUser->photo_url }}" />
                            <div class="absolute -bottom-2 -right-2 glass-badge px-2 py-1 rounded-lg text-[10px] font-bold text-primary shadow-sm">
                                CIN: {{ $patient->cin ?? 'N/A' }}
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-on-surface tracking-tight">{{ $patientUser->name }}</h3>
                            <div class="flex items-center gap-4 mt-1">
                                <span class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">person</span>
                                    {{ $age }} ans
                                </span>
                                <span class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">call</span>
                                    {{ $patient->telephone ?? 'N/A' }}
                                </span>
                                @if ($dossier && $dossier->groupe_sanguin)
                                <span class="px-2 py-0.5 bg-error-container text-on-error-container text-[10px] font-bold rounded-md">
                                    GROUPE {{ $dossier->groupe_sanguin }}
                                </span>
                                @endif
                                @if ($dossier && $dossier->allergies)
                                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 text-[10px] font-bold rounded-md">
                                    ALLERGIES: {{ $dossier->allergies }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button id="btn-dossier" onclick="toggleDossier()"
                            class="px-4 py-2 rounded-xl text-primary font-bold bg-primary/10 hover:bg-primary/20 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">folder_open</span>
                            <span id="btn-dossier-label">Dossier Complet</span>
                        </button>
                        <button type="submit" form="panel-consultation" class="px-4 py-2 rounded-xl bg-primary text-on-primary font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                            Terminer
                        </button>
                    </div>
                </div>
                @else
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex items-center justify-center h-32">
                    <p class="text-on-surface-variant text-sm">Aucun patient sélectionné — choisissez un rendez-vous dans la file d'attente.</p>
                </div>
                @endif

                @if(session('success_consultation'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium shadow-sm mb-2">
                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                        {{ session('success_consultation') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2 text-sm font-medium shadow-sm mb-2">
                        <span class="material-symbols-outlined text-[20px]">error</span>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex flex-col gap-1 text-sm font-medium shadow-sm mb-2">
                        <div class="flex items-center gap-2 font-bold mb-1">
                            <span class="material-symbols-outlined text-[20px]">warning</span>
                            Veuillez corriger les erreurs suivantes :
                        </div>
                        <ul class="list-disc list-inside text-xs ml-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- panel-consultation : hauteur fixe = ecran - header - patient info - paddings --}}
                <form id="panel-consultation" method="POST" action="{{ route('doctor.consultation.store') }}" class="grid grid-cols-12 gap-4" style="height: calc(100vh - 14rem)">
                    @csrf
                    @if($activeRdv)
                        <input type="hidden" name="rendez_vous_id" value="{{ $activeRdv->id }}">
                    @endif

                    {{-- col 1 : motif + diagnostic + notes --}}
                    <div class="col-span-3 h-full bg-surface-container-lowest rounded-2xl p-5 shadow-sm border border-outline-variant/10 flex flex-col gap-4 overflow-hidden">
                        <h4 class="font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">clinical_notes</span>
                            Consultation
                        </h4>

                        {{-- motif : pourquoi le patient est venu --}}
                        <div>
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1.5 block">Motif</label>
                            <input type="text" name="motif" placeholder="Raison de la consultation..."
                                class="w-full bg-surface-container-low border border-outline-variant/20 rounded-xl px-3 py-2 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none" />
                        </div>

                        {{-- diagnostic : conclusion du doctor apres examen --}}
                        <div>
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1.5 block">Diagnostic</label>
                            <input type="text" name="diagnostic" placeholder="Conclusion medicale..."
                                class="w-full bg-surface-container-low border border-outline-variant/20 rounded-xl px-3 py-2 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none" />
                        </div>

                        {{-- notes consultation : flex-1 pour prendre toute la hauteur restante --}}
                        <div class="flex-1 flex flex-col min-h-0">
                            <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1.5 block">Notes</label>
                            <textarea name="notes" placeholder="Ex: Revoir dans 2 semaines, faire une analyse sanguine..."
                                class="flex-1 w-full bg-surface-container-low border border-outline-variant/20 rounded-xl px-3 py-2 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none resize-none"></textarea>
                        </div>
                    </div>

                    {{-- col 2 : rapport medical --}}
                    <div class="col-span-4 h-full bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex flex-col overflow-hidden">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-on-surface flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">description</span>
                                Rapport Médical
                            </h4>
                            {{-- boutons de formatage du rapport --}}
                            <div class="flex gap-1">
                                <button type="button" class="p-1.5 rounded-lg hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">format_bold</span>
                                </button>
                                <button type="button" class="p-1.5 rounded-lg hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">format_italic</span>
                                </button>
                                <button type="button" class="p-1.5 rounded-lg hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">format_list_bulleted</span>
                                </button>
                            </div>
                        </div>
                        {{-- textarea principal du rapport - flex-1 pour remplir la hauteur restante --}}
                        <div class="flex-1 min-h-0">
                            <textarea name="rapport_medical" required
                                class="w-full h-full bg-surface-container-low border-0 focus:ring-2 focus:ring-primary/20 rounded-xl p-4 text-sm text-on-surface placeholder:text-on-surface-variant/40 resize-none font-body leading-relaxed"
                                placeholder="Saisissez les observations cliniques ici..."></textarea>
                        </div>
                        <div class="mt-4 flex items-center gap-3 shrink-0">
                            <span class="text-[10px] font-bold text-on-surface-variant/60 uppercase">Rapport du {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    {{-- col 3 : ordonnance - footer toujours visible --}}
                    <div class="col-span-5 h-full bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 flex flex-col overflow-hidden">
                        <h4 class="font-bold text-on-surface flex items-center gap-2 mb-6">
                            <span class="material-symbols-outlined text-primary">prescriptions</span>
                            Ordonnance Numérique
                        </h4>

                        {{-- liste medicaments vide au debut - le doctor ajoute via le bouton + --}}
                        <div id="medicaments-list" class="space-y-4 flex-1 overflow-y-auto pr-1">

                            {{-- placeholder visible quand aucun medicament n'est ajoute --}}
                            <div id="medicaments-placeholder" class="flex flex-col items-center justify-center py-8 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[40px] opacity-30 mb-2">medication</span>
                                <p class="text-xs font-medium opacity-50">Aucun medicament ajoute</p>
                                <p class="text-[10px] opacity-40">Cliquez sur + pour ajouter</p>
                            </div>

                        </div>

                        {{-- btn ajouter medicament - style original dashed border --}}
                        <button type="button" onclick="addMedicament()"
                            class="mt-4 w-full py-3 border-2 border-dashed border-outline-variant/30 rounded-xl text-on-surface-variant font-bold text-xs hover:border-primary/40 hover:text-primary transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">add_circle</span>
                            Ajouter un médicament
                        </button>

                        {{-- footer toujours visible en bas : imprimer --}}
                        <div class="mt-4 pt-4 border-t border-outline-variant/10 flex justify-start items-center shrink-0">
                            <button type="button" class="text-primary text-sm font-bold flex items-center gap-1 hover:text-primary/70 transition-colors">
                                <span class="material-symbols-outlined">print</span>
                                Imprimer
                            </button>
                        </div>
                    </div>

                </form>{{-- end #panel-consultation --}}



                {{-- panel dossier medical - cache par defaut, show quand doctor clique "Dossier Complet" --}}
                @if ($activeRdv)
                @php
                    // on recupere le dossier du patient actif, peut etre null si jamais cree
                    $dossierActif = $activeRdv->patient->dossierMedical;
                @endphp
                <div id="panel-dossier" class="hidden flex-1 overflow-y-auto">
                    <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10 h-full flex flex-col gap-4">

                        {{-- header du panel --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">folder_shared</span>
                                <h4 class="font-bold text-on-surface text-lg">Dossier Medical — {{ $activeRdv->patient->user->name }}</h4>
                            </div>
                            {{-- btn switch entre read/edit mode --}}
                            <button id="btn-edit-dossier" onclick="switchToEditMode()"
                                class="px-3 py-1.5 rounded-lg text-primary font-bold bg-primary/10 hover:bg-primary/20 text-xs flex items-center gap-1 transition-colors">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                                Modifier
                            </button>
                        </div>

                        {{-- success message apres update --}}
                        @if(session('success'))
                            <div class="px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ===== READ MODE : doctor voir les infos, default view ===== --}}
                        <div id="dossier-read-mode" class="flex flex-col gap-5 flex-1">

                            {{-- groupe sanguin --}}
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/20">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Groupe Sanguin</p>
                                @if($dossierActif && $dossierActif->groupe_sanguin)
                                    <span class="px-3 py-1 bg-error-container text-on-error-container text-sm font-bold rounded-lg">
                                        {{ $dossierActif->groupe_sanguin }}
                                    </span>
                                @else
                                    <p class="text-sm text-on-surface-variant italic">Non renseigne</p>
                                @endif
                            </div>

                            {{-- allergies --}}
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/20">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2">Allergies</p>
                                @if($dossierActif && $dossierActif->allergies)
                                    <p class="text-sm text-on-surface leading-relaxed">{{ $dossierActif->allergies }}</p>
                                @else
                                    <p class="text-sm text-on-surface-variant italic">Aucune allergie connue</p>
                                @endif
                            </div>

                            {{-- antecedents medicaux --}}
                            <div class="p-4 bg-surface-container-low rounded-xl border border-outline-variant/20 flex-1">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2">Antecedents Medicaux</p>
                                @if($dossierActif && $dossierActif->antecedents)
                                    <p class="text-sm text-on-surface leading-relaxed">{{ $dossierActif->antecedents }}</p>
                                @else
                                    <p class="text-sm text-on-surface-variant italic">Aucun antecedent enregistre</p>
                                @endif
                            </div>

                        </div>

                        {{-- ===== EDIT MODE : doctor peut update les champs, cache par defaut ===== --}}
                        <form id="dossier-edit-mode" method="POST"
                            action="{{ route('doctor.dossier.update', $activeRdv->patient->id) }}"
                            class="hidden flex-col gap-4 flex-1">
                            @csrf
                            @method('PATCH')

                            {{-- groupe sanguin input --}}
                            <div>
                                <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2 block">Groupe Sanguin</label>
                                <input type="text" name="groupe_sanguin"
                                    value="{{ old('groupe_sanguin', $dossierActif->groupe_sanguin ?? '') }}"
                                    placeholder="Ex: A+, B-, O+..."
                                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-2.5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none" />
                            </div>

                            {{-- allergies input --}}
                            <div>
                                <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2 block">Allergies</label>
                                <textarea name="allergies" rows="3"
                                    placeholder="Ex: Penicilline, Aspirine, pollen..."
                                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-2.5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none resize-none">{{ old('allergies', $dossierActif->allergies ?? '') }}</textarea>
                            </div>

                            {{-- antecedents input --}}
                            <div class="flex-1">
                                <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2 block">Antecedents Medicaux</label>
                                <textarea name="antecedents" rows="4"
                                    placeholder="Ex: Diabete type 2, Hypertension..."
                                    class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-2.5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none resize-none">{{ old('antecedents', $dossierActif->antecedents ?? '') }}</textarea>
                            </div>

                            {{-- actions : annuler ou save --}}
                            <div class="flex justify-between items-center pt-3 border-t border-outline-variant/10">
                                <button type="button" onclick="switchToReadMode()"
                                    class="px-4 py-2 rounded-xl text-on-surface-variant font-bold text-sm hover:bg-surface-container transition-colors">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-primary text-white font-bold rounded-xl text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">save</span>
                                    Enregistrer
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                @endif

            </section>
        </div>
    </main>

    <script>
        // toggle entre panel consultation et panel dossier
        function toggleDossier() {
            const panelConsultation = document.getElementById('panel-consultation');
            const panelDossier      = document.getElementById('panel-dossier');
            const btnLabel          = document.getElementById('btn-dossier-label');
            const btn               = document.getElementById('btn-dossier');

            if (!panelDossier) return; // pas de patient actif

            const isDossierVisible = !panelDossier.classList.contains('hidden');

            if (isDossierVisible) {
                // retour vers consultation panels
                panelDossier.classList.add('hidden');
                panelConsultation.classList.remove('hidden');
                btnLabel.textContent = 'Dossier Complet';
                btn.classList.remove('bg-primary/30');
                // reset edit mode si le doctor avait ouvert le form
                switchToReadMode();
            } else {
                // show le dossier medical
                panelConsultation.classList.add('hidden');
                panelDossier.classList.remove('hidden');
                btnLabel.textContent = 'Retour Consultation';
                btn.classList.add('bg-primary/30');
            }
        }

        // switch vers edit mode : hide read, show form
        function switchToEditMode() {
            document.getElementById('dossier-read-mode').classList.add('hidden');
            document.getElementById('dossier-edit-mode').classList.remove('hidden');
            document.getElementById('dossier-edit-mode').classList.add('flex');
            document.getElementById('btn-edit-dossier').classList.add('hidden');
        }

        // switch vers read mode : show read, hide form
        function switchToReadMode() {
            const editForm = document.getElementById('dossier-edit-mode');
            if (!editForm) return;
            editForm.classList.add('hidden');
            editForm.classList.remove('flex');
            document.getElementById('dossier-read-mode').classList.remove('hidden');
            document.getElementById('btn-edit-dossier').classList.remove('hidden');
        }

        // ajouter un medicament dans l'ordonnance
        // build depuis un template string car la liste est vide au debut
        function addMedicament() {
            const list        = document.getElementById('medicaments-list');
            const placeholder = document.getElementById('medicaments-placeholder');
            const index       = list.querySelectorAll('.medicament-row').length;

            // cacher le placeholder si c'est le premier medicament
            if (placeholder) placeholder.classList.add('hidden');

            // create la nouvelle row depuis template HTML
            const row = document.createElement('div');
            row.className = 'medicament-row p-4 bg-surface-container rounded-xl border border-outline-variant/20 relative group';
            row.innerHTML = `
                <button type="button" onclick="removeMedicament(this)"
                    class="absolute top-2 right-2 text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity hover:text-red-500">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
                <div class="grid grid-cols-2 gap-3">
                    <div class="col-span-2">
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Médicament</label>
                        <input type="text" name="medicaments[${index}][medicament]" placeholder="Nom du medicament..."
                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm font-semibold py-1.5 px-3 focus:ring-1 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Posologie</label>
                        <input type="text" name="medicaments[${index}][posologie]" placeholder="1 gélule"
                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30" />
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Fréquence</label>
                        <input type="text" name="medicaments[${index}][frequence]" placeholder="3x par jour"
                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30" />
                    </div>
                    <div class="col-span-2">
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase mb-1 block">Notes</label>
                        <input type="text" name="medicaments[${index}][notes]" placeholder="Ex: Prendre avec repas, eviter le soleil..."
                            class="w-full bg-surface-container-lowest border-0 rounded-lg text-sm py-1.5 px-3 focus:ring-1 focus:ring-primary/30" />
                    </div>
                </div>`;

            list.appendChild(row);
        }

        // supprimer une ligne medicament
        // si plus aucune row restante, re-afficher le placeholder
        function removeMedicament(btn) {
            const list = document.getElementById('medicaments-list');
            btn.closest('.medicament-row').remove();

            // re-afficher le placeholder si liste vide
            if (list.querySelectorAll('.medicament-row').length === 0) {
                const placeholder = document.getElementById('medicaments-placeholder');
                if (placeholder) placeholder.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>

