<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cabinet Médical - Vérification de l'email</title>
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

        {{-- Left Side --}}
        <section class="relative w-full md:w-5/12 bg-primary-container p-5 md:p-6 flex flex-col justify-between text-on-primary overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-on-primary rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Cabinet Médical</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-5 leading-tight">Vérifiez votre adresse email</h1>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">mark_email_read</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Vérifiez votre boîte email</p>
                            <p class="text-white/70 text-sm">Un code à 6 chiffres a été envoyé à votre adresse email.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">timer</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Code valable 10 min</p>
                            <p class="text-white/70 text-sm">Le code expire après 10 minutes pour votre sécurité.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white">shield_lock</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Compte sécurisé</p>
                            <p class="text-white/70 text-sm">Cette étape garantit que vous êtes bien le propriétaire de l'email.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-6 glass-card p-4 rounded-2xl flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <div>
                    <p class="text-sm font-medium">Dernière étape</p>
                    <p class="text-xs text-white/70">Activation de votre compte</p>
                </div>
            </div>
        </section>

        {{-- Right Side --}}
        <section class="w-full md:w-7/12 p-5 md:p-8 flex flex-col justify-center bg-surface-container-lowest relative">
            <a href="{{ url('/') }}" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-colors" title="Retour à l'accueil">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </a>
            <div class="max-w-sm mx-auto w-full">
                <header class="mb-6">
                    <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">mark_email_read</span>
                    </div>
                    <h2 class="text-2xl font-bold text-on-surface mb-2">Confirmez votre email</h2>
                    <p class="text-on-surface-variant text-sm">
                        Saisissez le code à 6 chiffres envoyé à
                        <span class="font-semibold text-primary">{{ session('verify_email') }}</span>
                    </p>
                </header>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-5">
                        <span class="material-symbols-outlined text-base mt-0.5">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('info'))
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-5">
                        <span class="material-symbols-outlined text-base mt-0.5">info</span>
                        <span>{{ session('info') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2 mb-5">
                        <span class="material-symbols-outlined text-base mt-0.5">error</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form action="{{ route('email.verify.submit') }}" method="POST">
                    @csrf
                    <div class="space-y-1.5 mb-6">
                        <label class="text-sm font-semibold text-on-surface-variant ml-1" for="code">
                            Code à 6 chiffres <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">dialpad</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50 tracking-widest text-center font-bold text-lg"
                                id="code" name="code" placeholder="• • • • • •"
                                required type="text" inputmode="numeric" maxlength="6"
                                autocomplete="one-time-code" value="{{ old('code') }}" />
                        </div>
                    </div>

                    <button class="w-full py-4 px-6 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl shadow-[0_4px_20px_-2px_rgba(0,104,118,0.25)] hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
                        Activer mon compte
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <footer class="mt-6 text-center space-y-3">
                    <p class="text-sm text-on-surface-variant">Vous n'avez pas reçu le code ?</p>
                    <a class="text-sm text-primary font-semibold hover:underline" href="{{ route('email.verify.resend') }}">
                        Renvoyer un nouveau code
                    </a>
                    <div class="pt-2">
                        <a class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary transition-colors" href="{{ route('login') }}">
                            <span class="material-symbols-outlined text-base">arrow_back</span>
                            Retour à la connexion
                        </a>
                    </div>
                </footer>
            </div>
        </section>
    </main>
</body>
</html>
