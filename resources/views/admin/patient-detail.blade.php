<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Dossier Patient — {{ $patient->user->name }}</title>
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
                    "on-error-container": "#93000a",
                    "on-surface": "#191c1e",
                    "on-surface-variant": "#3e494b",
                    "outline-variant": "#bdc8cb",
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
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-teal-700 bg-teal-50/50 rounded-xl transition-all duration-200">
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
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.patients') }}" class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Retour aux patients
            </a>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-teal-800">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500">Administrateur</p>
            </div>
            <img alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-teal-50"
                src="{{ Auth::user()->photo_url }}" />
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8 pb-0">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs font-semibold text-primary/60 tracking-wider uppercase">
            <a href="{{ route('admin.patients') }}" class="hover:text-primary transition-colors">Patients</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary">{{ $patient->user->name }}</span>
        </nav>

        {{-- ══ PATIENT IDENTITY CARD ══ --}}
        @php
            $initials = collect(explode(' ', $patient->user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->implode('');
            $age = $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : null;
            $dossier = $patient->dossierMedical;
        @endphp

        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                {{-- Avatar --}}
                <div class="w-24 h-24 rounded-2xl bg-primary/10 flex items-center justify-center text-primary font-black text-3xl shrink-0">
                    {{ $initials }}
                </div>

                {{-- Info principale --}}
                <div class="flex-1 space-y-4">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight text-teal-900">{{ $patient->user->name }}</h1>
                        <p class="text-slate-500 mt-1">{{ $patient->user->email }}</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
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
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Rendez-vous</p>
                            <p class="text-sm font-bold text-on-surface">{{ $rendezVous->count() }} au total</p>
                        </div>
                        <div class="bg-surface-container-low rounded-xl p-4">
                            <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-1">Consultations</p>
                            <p class="text-sm font-bold text-on-surface">{{ $consultations->count() }} au total</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ DOSSIER MÉDICAL ══ --}}
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <h2 class="text-xl font-bold text-teal-900 mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">folder_shared</span>
                Dossier Médical
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Groupe sanguin --}}
                <div class="bg-surface-container-low rounded-2xl p-6 border border-outline-variant/20">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3">Groupe Sanguin</p>
                    @if($dossier && $dossier->groupe_sanguin)
                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-error-container text-on-error-container font-black text-lg">
                            {{ $dossier->groupe_sanguin }}
                        </span>
                    @else
                        <p class="text-sm text-slate-400 italic">Non renseigné</p>
                    @endif
                </div>
                {{-- Allergies --}}
                <div class="bg-surface-container-low rounded-2xl p-6 border border-outline-variant/20">
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider mb-3">Allergies</p>
                    @if($dossier && $dossier->allergies)
                        <p class="text-sm text-on-surface leading-relaxed">{{ $dossier->allergies }}</p>
                    @else
                        <p class="text-sm text-slate-400 italic">Non renseigné</p>
                    @endif
                </div>
                {{-- Antécédents --}}
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
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-xl font-bold text-teal-900 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">history</span>
                    Historique des Consultations
                </h2>
                <span class="text-xs text-slate-400 font-medium">{{ $consultations->count() }} consultation(s)</span>
            </div>

            @if($consultations->isEmpty())
                <div class="px-8 py-16 text-center text-slate-400">
                    <span class="material-symbols-outlined text-4xl block mb-2">clinical_notes</span>
                    Aucune consultation enregistrée pour ce patient.
                </div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach($consultations as $consultation)
                    <div class="px-8 py-6 hover:bg-slate-50/50 transition-colors">
                        {{-- Header de consultation --}}
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
                            <div class="text-right">
                                <p class="text-sm font-bold text-slate-700">
                                    {{ \Carbon\Carbon::parse($consultation->created_at)->format('d/m/Y') }}
                                </p>
                                <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($consultation->created_at)->format('H:i') }}</p>
                            </div>
                        </div>

                        {{-- Corps de consultation --}}
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

                        {{-- Ordonnance --}}
                        @if($consultation->ordonnance && $consultation->ordonnance->prescriptions->isNotEmpty())
                        <div>
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
                    </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- ══ HISTORIQUE DES RENDEZ-VOUS ══ --}}
        <section class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-xl font-bold text-teal-900 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;">calendar_month</span>
                    Rendez-vous
                </h2>
                <span class="text-xs text-slate-400 font-medium">{{ $rendezVous->count() }} rendez-vous</span>
            </div>

            @if($rendezVous->isEmpty())
                <div class="px-8 py-12 text-center text-slate-400">
                    <span class="material-symbols-outlined text-4xl block mb-2">event_busy</span>
                    Aucun rendez-vous enregistré.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50 text-secondary text-[11px] font-black uppercase tracking-wider">
                                <th class="px-8 py-4">Date & Heure</th>
                                <th class="px-6 py-4">Médecin</th>
                                <th class="px-6 py-4">Spécialité</th>
                                <th class="px-6 py-4">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($rendezVous as $rdv)
                            @php
                                $statusStyles = [
                                    'en_attente' => 'bg-amber-50 text-amber-700',
                                    'confirmé'   => 'bg-green-50 text-green-700',
                                    'termine'    => 'bg-slate-100 text-slate-600',
                                    'annulé'     => 'bg-red-50 text-red-700',
                                ];
                                $style = $statusStyles[$rdv->statut] ?? 'bg-slate-100 text-slate-600';
                                $labels = ['en_attente' => 'En attente', 'confirmé' => 'Confirmé', 'termine' => 'Terminé', 'annulé' => 'Annulé'];
                                $label = $labels[$rdv->statut] ?? ucfirst($rdv->statut);
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-4">
                                    <p class="text-sm font-bold text-on-surface">
                                        {{ \Carbon\Carbon::parse($rdv->date_rendez_vous)->format('d/m/Y') }}
                                    </p>
                                    <p class="text-xs text-slate-500">{{ substr($rdv->heure_rendez_vous, 0, 5) }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-on-surface">
                                    Dr. {{ $rdv->medecin->user->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-teal-100 text-teal-700 uppercase tracking-tighter">
                                        {{ $rdv->medecin->specialite->nom ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $style }}">
                                        {{ $label }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

    </main>

    {{-- Footer --}}
    <footer class="w-full py-6 mt-8 bg-white border-t border-slate-200 flex flex-col md:flex-row justify-between items-center px-8">
        <div class="text-xs text-slate-500 mb-4 md:mb-0">© 2026 Cabinet Médical. Tous droits réservés.</div>
        <div class="flex gap-6">
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Politique de confidentialité</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conditions d'utilisation</a>
            <a class="text-xs text-slate-500 hover:text-teal-500 transition-colors" href="#">Conformité HIPAA</a>
        </div>
    </footer>
</div>

</body>
</html>
