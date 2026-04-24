<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cabinet Médical - Mot de passe oublié</title>
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
                        "surface-container": "#eceef0","on-surface": "#191c1e","on-surface-variant": "#3e494b",
                        "outline": "#6e797c","outline-variant": "#bdc8cb","error": "#ba1a1a","error-container": "#ffdad6",
                    },
                    "borderRadius": { "DEFAULT": "0.25rem","lg": "0.5rem","xl": "0.75rem","full": "9999px" },
                    "fontFamily": { "headline": ["Inter"],"body": ["Inter"],"label": ["Inter"] }
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

        {{-- Left Side: same as login --}}
        <section class="relative w-full md:w-5/12 bg-primary-container p-5 md:p-6 flex flex-col justify-between text-on-primary overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-on-primary rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Cabinet Médical</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-5 leading-tight">Bienvenue au Cabinet Médical</h1>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">event_available</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Rendez-vous 24h/24</p>
                            <p class="text-white/70 text-sm">Planifiez vos consultations à tout moment depuis votre espace sécurisé.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">lock_reset</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Récupération sécurisée</p>
                            <p class="text-white/70 text-sm">Un code à 6 chiffres vous est envoyé par email pour protéger votre compte.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">monitoring</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Suivi personnalisé</p>
                            <p class="text-white/70 text-sm">Un tableau de bord intelligent pour piloter votre santé au quotidien.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-6 glass-card p-4 rounded-2xl flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">shield_lock</span>
                </div>
                <div>
                    <p class="text-sm font-medium">Code valable 10 minutes</p>
                    <p class="text-xs text-white/70">Pour votre sécurité, le code expire automatiquement.</p>
                </div>
            </div>
        </section>

        {{-- Right Side: Email form --}}
        <section class="w-full md:w-7/12 p-5 md:p-8 flex flex-col justify-center bg-surface-container-lowest">
            <div class="max-w-sm mx-auto w-full">
                <header class="mb-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-2xl">lock_reset</span>
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface mb-2">Mot de passe oublié ?</h2>
                    <p class="text-on-surface-variant text-sm">Entrez votre adresse email et nous vous enverrons un code à 6 chiffres.</p>
                </header>

                {{-- Success message --}}
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-4">
                        <span class="material-symbols-outlined text-base mt-0.5">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Error messages --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-4">
                        <span class="material-symbols-outlined text-base mt-0.5">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="space-y-5" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-sm font-semibold text-on-surface-variant ml-1" for="email">Adresse email <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">mail</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50"
                                id="email" name="email" placeholder="nom@exemple.com" required type="email" value="{{ old('email') }}" />
                        </div>
                    </div>

                    <div class="pt-2">
                        <button id="forgot-btn" class="w-full py-4 px-6 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl shadow-[0_4px_20px_-2px_rgba(0,104,118,0.25)] hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
                            Envoyer le code
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">send</span>
                        </button>
                    </div>
                </form>

                <footer class="mt-8 text-center">
                    <a class="inline-flex items-center gap-1 text-sm text-primary font-semibold hover:underline" href="{{ route('login') }}">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Retour à la connexion
                    </a>
                </footer>
            </div>
        </section>
    </main>
<script>
    document.querySelector('form').addEventListener('submit', function () {
        const btn = document.getElementById('forgot-btn');
        btn.disabled = true;
        btn.classList.add('opacity-60', 'cursor-not-allowed');
        btn.classList.remove('hover:scale-[1.02]', 'active:scale-95');

        let seconds = 5;
        const tick = () => {
            btn.innerHTML = `Veuillez patienter... (${seconds}s) <span class="material-symbols-outlined">hourglass_empty</span>`;
            if (seconds-- <= 0) {
                clearInterval(timer);
                btn.disabled = false;
                btn.classList.remove('opacity-60', 'cursor-not-allowed');
                btn.classList.add('hover:scale-[1.02]', 'active:scale-95');
                btn.innerHTML = `Envoyer le code <span class="material-symbols-outlined">send</span>`;
            }
        };
        tick();
        const timer = setInterval(tick, 1000);
    });
</script>
</body>
</html>
