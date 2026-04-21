<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cabinet Médical - Nouveau mot de passe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#006876","primary-container": "#008394","on-primary": "#ffffff",
                        "surface": "#f7f9fb","surface-container-lowest": "#ffffff","surface-container-low": "#f2f4f6",
                        "on-surface": "#191c1e","on-surface-variant": "#3e494b","outline": "#6e797c",
                    },
                    "borderRadius": { "DEFAULT": "0.25rem","lg": "0.5rem","xl": "0.75rem","full": "9999px" },
                    "fontFamily": { "headline": ["Inter"],"body": ["Inter"] }
                },
            },
        }
    </script>
    <style>
        .glass-card { background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen flex items-center justify-center p-4 md:p-6">
    <main class="w-full max-w-3xl bg-surface-container-lowest overflow-hidden flex flex-col md:flex-row shadow-2xl rounded-3xl">

        {{-- Left Side: same branding --}}
        <section class="relative w-full md:w-5/12 bg-primary-container p-5 md:p-6 flex flex-col justify-between text-on-primary overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-on-primary rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Cabinet Médical</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-5 leading-tight">Créez un nouveau mot de passe</h1>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">password</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Minimum 6 caractères</p>
                            <p class="text-white/70 text-sm">Choisissez un mot de passe fort pour protéger votre compte.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">shield_lock</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Stockage chiffré</p>
                            <p class="text-white/70 text-sm">Votre mot de passe est chiffré et jamais stocké en clair.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">task_alt</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Dernière étape</p>
                            <p class="text-white/70 text-sm">Après confirmation, vous serez redirigé vers la page de connexion.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-6 glass-card p-4 rounded-2xl flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">lock_open</span>
                </div>
                <div>
                    <p class="text-sm font-medium">Étape 3 sur 3</p>
                    <p class="text-xs text-white/70">Définition du nouveau mot de passe</p>
                </div>
            </div>
        </section>

        {{-- Right Side: New password form --}}
        <section class="w-full md:w-7/12 p-5 md:p-8 flex flex-col justify-center bg-surface-container-lowest">
            <div class="max-w-sm mx-auto w-full">
                <header class="mb-6">
                    <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-green-600 text-2xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface mb-2">Nouveau mot de passe</h2>
                    <p class="text-on-surface-variant text-sm">Code vérifié avec succès. Choisissez votre nouveau mot de passe.</p>
                </header>

                {{-- Error messages --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-5">
                        <span class="material-symbols-outlined text-base mt-0.5">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-sm font-semibold text-on-surface-variant ml-1" for="password">
                            Nouveau mot de passe <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">lock</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50"
                                id="password" name="password" placeholder="••••••••" required type="password" minlength="6" />
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-sm font-semibold text-on-surface-variant ml-1" for="password_confirmation">
                            Confirmer le mot de passe <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">lock_clock</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50"
                                id="password_confirmation" name="password_confirmation" placeholder="••••••••" required type="password" />
                        </div>
                    </div>

                    <div class="pt-2">
                        <button class="w-full py-4 px-6 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl shadow-[0_4px_20px_-2px_rgba(0,104,118,0.25)] hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
                            Réinitialiser le mot de passe
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
