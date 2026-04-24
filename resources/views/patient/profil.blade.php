<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mon Profil Électronique — Cabinet Médical</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-container": "#008394",
                        "inverse-primary": "#75d4e7",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "surface-tint": "#006876",
                        "on-surface": "#191c1e",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "surface-container": "#eceef0",
                        "on-background": "#191c1e",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-high": "#e6e8ea",
                        "on-error": "#ffffff",
                        "background": "#f7f9fb",
                        "outline-variant": "#bdc8cb",
                        "on-surface-variant": "#3e494b",
                        "surface": "#f7f9fb",
                        "primary-fixed": "#a0efff",
                        "primary": "#006876",
                        "secondary": "#515f74",
                        "outline": "#6e797c",
                        "on-primary": "#ffffff"
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
        .star-btn { cursor: pointer; color: #cbd5e1; font-size: 28px; transition: color .15s; }
        .star-btn.active, .star-btn:hover, .star-btn:hover ~ .star-btn { color: #f59e0b; }
        .stars-row { display: flex; flex-direction: row-reverse; justify-content: flex-end; }
        .stars-row .star-btn:hover,
        .stars-row .star-btn:hover ~ .star-btn { color: #f59e0b; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen flex flex-col">

    <!-- TopNavBar -->
    <nav class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50 w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a class="flex items-center gap-2" href="/">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-2xl">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-teal-800 dark:text-teal-300">Cabinet Médical</span>
                </a>
                <div class="hidden md:flex gap-8">
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="/">Accueil</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="{{ route('patient.dashboard') }}">Prendre un RDV</a>
                    <a class="text-slate-500 hover:text-primary transition-colors font-medium" href="{{ route('patient.rendezvous.index') }}">Mes rendez-vous</a>
                    <a class="text-primary font-semibold border-b-2 border-primary pb-0.5" href="{{ route('patient.profil') }}">Profil électronique</a>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 pl-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-on-surface">{{ $user->name }}</p>
                        <p class="text-[10px] text-on-surface-variant">{{ $user->role }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary-fixed shadow-sm">
                        <img alt="{{ $user->name }}" class="w-10 h-10 object-cover" src="{{ $user->photo_url }}" />
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-red-500 transition-colors px-3 py-2 rounded-lg hover:bg-red-50">
                    <span class="material-symbols-outlined text-base">logout</span>
                    <span class="hidden sm:inline">Déconnexion</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-5xl w-full mx-auto px-4 py-8 md:py-12 space-y-8">

        @if(session('success_avis'))
            <div class="flex items-center gap-3 bg-teal-50 border border-teal-200 text-teal-800 px-5 py-4 rounded-2xl text-sm font-semibold">
                <span class="material-symbols-outlined text-teal-600">check_circle</span>
                {{ session('success_avis') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm font-semibold">
                <span class="material-symbols-outlined text-red-500">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- Breadcrumb & Header --}}
        <header>
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                <span>Espace patient</span>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-teal-700">Profil électronique</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-teal-900 mb-2">Mon Profil Électronique</h1>
            <p class="text-slate-500 text-sm leading-relaxed">Consultez vos informations personnelles, votre dossier médical et l'historique de vos consultations.</p>
        </header>

        {{-- ══ IDENTITY CARD ══ --}}
        @php
            $initials = collect(explode(' ', $user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
            $age = $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : null;
            $dossier = $patient->dossierMedical;
        @endphp

        <section class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] border border-slate-100 p-8">
            <h2 class="text-lg font-bold text-teal-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">person</span>
                Informations personnelles
            </h2>
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="w-20 h-20 rounded-2xl bg-primary/10 flex items-center justify-center text-primary font-black text-2xl shrink-0">
                    {{ $initials }}
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-teal-900 mb-1">{{ $user->name }}</h3>
                    <p class="text-slate-500 mb-4">{{ $user->email }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Âge</p>
                            <p class="text-sm font-bold text-on-surface">{{ $age ? $age . ' ans' : 'Non renseigné' }}</p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">CIN</p>
                            <p class="text-sm font-bold text-on-surface">{{ $patient->cin ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Téléphone</p>
                            <p class="text-sm font-bold text-on-surface">{{ $patient->telephone ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Date de naissance</p>
                            <p class="text-sm font-bold text-on-surface">
                                {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') : 'Non renseigné' }}
                            </p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4 md:col-span-2">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Adresse</p>
                            <p class="text-sm font-bold text-on-surface">{{ $patient->adresse ?? 'Non renseigné' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ DOSSIER MÉDICAL ══ --}}
        <section class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] border border-slate-100 p-8">
            <h2 class="text-lg font-bold text-teal-900 mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">folder_shared</span>
                Dossier Médical
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-surface-container-low rounded-2xl p-6 border border-outline-variant/20">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3">Groupe Sanguin</p>
                    @if($dossier && $dossier->groupe_sanguin)
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-red-100 text-red-700 font-black text-lg">
                            {{ $dossier->groupe_sanguin }}
                        </span>
                    @else
                        <p class="text-sm text-slate-400 italic">Non renseigné</p>
                    @endif
                </div>
                <div class="bg-surface-container-low rounded-2xl p-6 border border-outline-variant/20">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3">Allergies</p>
                    @if($dossier && $dossier->allergies)
                        <p class="text-sm text-on-surface leading-relaxed">{{ $dossier->allergies }}</p>
                    @else
                        <p class="text-sm text-slate-400 italic">Non renseigné</p>
                    @endif
                </div>
                <div class="bg-surface-container-low rounded-2xl p-6 border border-outline-variant/20">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3">Antécédents Médicaux</p>
                    @if($dossier && $dossier->antecedents)
                        <p class="text-sm text-on-surface leading-relaxed">{{ $dossier->antecedents }}</p>
                    @else
                        <p class="text-sm text-slate-400 italic">Non renseigné</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- ══ HISTORIQUE DES CONSULTATIONS ══ --}}
        <section class="bg-white rounded-2xl shadow-[0_4px_24px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-teal-900 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">history</span>
                    Historique des Consultations
                </h2>
                <span class="text-xs text-slate-400 font-medium">{{ $consultations->count() }} consultation(s)</span>
            </div>

            @if($consultations->isEmpty())
                <div class="px-8 py-16 text-center text-slate-400">
                    <span class="material-symbols-outlined text-4xl block mb-2">clinical_notes</span>
                    Aucune consultation enregistrée pour le moment.
                </div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach($consultations as $consultation)
                    <div class="px-8 py-6">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary font-bold text-sm shrink-0">
                                    {{ collect(explode(' ', $consultation->medecin->user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('') }}
                                </div>
                                <div>
                                    <p class="font-bold text-teal-900">Dr. {{ $consultation->medecin->user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $consultation->medecin->specialite->nom ?? '—' }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 font-medium">
                                {{ \Carbon\Carbon::parse($consultation->created_at)->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div class="bg-surface-container-low rounded-xl p-4">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2">Motif</p>
                                <p class="text-sm text-on-surface">{{ $consultation->motif ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="bg-surface-container-low rounded-xl p-4">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2">Diagnostic</p>
                                <p class="text-sm text-on-surface">{{ $consultation->diagnostic ?? 'Non renseigné' }}</p>
                            </div>
                            <div class="bg-surface-container-low rounded-xl p-4">
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2">Rapport médical</p>
                                <p class="text-sm text-on-surface leading-relaxed line-clamp-3">{{ $consultation->rapport_medical ?? 'Non renseigné' }}</p>
                            </div>
                        </div>

                        @if($consultation->ordonnance && $consultation->ordonnance->prescriptions->isNotEmpty())
                        <div class="mb-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] text-primary">prescriptions</span>
                                Ordonnance ({{ $consultation->ordonnance->prescriptions->count() }} médicament(s))
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($consultation->ordonnance->prescriptions as $presc)
                                <div class="bg-teal-50 border border-teal-100 rounded-xl px-4 py-2">
                                    <p class="text-xs font-bold text-teal-900">{{ $presc->medicament }}</p>
                                    <p class="text-[10px] text-teal-700">{{ $presc->dosage }} — {{ $presc->frequence }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- ══ AVIS ══ --}}
                        @php $avis = $consultation->rendezVous?->avis; @endphp
                        <div class="mt-4 pt-4 border-t border-slate-100">
                            @if($avis)
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-amber-400" style="font-variation-settings:'FILL' 1;">star</span>
                                    Votre avis
                                </p>
                                <div class="flex items-center gap-1 mb-1">
                                    @for($s = 1; $s <= 5; $s++)
                                        <span class="material-symbols-outlined text-[22px] {{ $s <= $avis->note ? 'text-amber-400' : 'text-slate-200' }}"
                                              style="font-variation-settings:'FILL' 1;">star</span>
                                    @endfor
                                    <span class="ml-2 text-xs text-slate-500 font-semibold">{{ $avis->note }}/5</span>
                                </div>
                                @if($avis->commentaire)
                                    <p class="text-sm text-slate-600 italic mt-1">"{{ $avis->commentaire }}"</p>
                                @endif
                            @else
                                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-primary">rate_review</span>
                                    Laisser un avis
                                </p>
                                <form method="POST" action="{{ route('patient.avis.store') }}" class="space-y-3">
                                    @csrf
                                    <input type="hidden" name="rendez_vous_id" value="{{ $consultation->rendez_vous_id }}">
                                    <input type="hidden" name="note" id="note-{{ $consultation->id }}" value="">

                                    {{-- Star picker --}}
                                    <div class="flex items-center gap-1" id="stars-{{ $consultation->id }}">
                                        @for($s = 1; $s <= 5; $s++)
                                        <button type="button"
                                            onclick="setNote({{ $consultation->id }}, {{ $s }})"
                                            class="star-btn material-symbols-outlined"
                                            style="font-variation-settings:'FILL' 0;"
                                            data-value="{{ $s }}">star</button>
                                        @endfor
                                        <span class="ml-2 text-xs text-slate-400" id="note-label-{{ $consultation->id }}">Sélectionnez une note</span>
                                    </div>

                                    {{-- Commentaire --}}
                                    <textarea name="commentaire" rows="2" placeholder="Commentaire (facultatif)..."
                                        class="w-full bg-surface-container-low border border-outline-variant/20 rounded-xl px-4 py-2.5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20 focus:outline-none resize-none"></textarea>

                                    <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-primary text-white text-xs font-bold rounded-xl hover:bg-primary/90 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">send</span>
                                        Soumettre l'avis
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                    @endforeach
                </div>
            @endif
        </section>

    </main>

    <!-- Footer -->
    <footer class="w-full py-6 mt-auto bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs text-slate-500 mb-4 md:mb-0">© 2026 Cabinet Médical. Tous droits réservés.</div>
        <div class="flex gap-6">
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Politique de confidentialité</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conditions d'utilisation</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conformité HIPAA</a>
        </div>
    </footer>

    <script>
        function setNote(consultationId, value) {
            document.getElementById('note-' + consultationId).value = value;
            const labels = ['', '1 — Mauvais', '2 — Moyen', '3 — Bien', '4 — Très bien', '5 — Excellent'];
            document.getElementById('note-label-' + consultationId).textContent = labels[value];
            const stars = document.querySelectorAll('#stars-' + consultationId + ' .star-btn');
            stars.forEach(btn => {
                const v = parseInt(btn.dataset.value);
                btn.style.fontVariationSettings = v <= value ? "'FILL' 1" : "'FILL' 0";
                btn.style.color = v <= value ? '#f59e0b' : '#cbd5e1';
            });
        }
    </script>
</body>
</html>
