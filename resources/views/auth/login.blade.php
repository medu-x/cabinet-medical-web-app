<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cabinet Médical - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-tint": "#006876",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#d5e3fc",
                        "primary-fixed-dim": "#75d4e7",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#ffb782",
                        "primary": "#006876",
                        "tertiary": "#8d4e16",
                        "primary-fixed": "#a0efff",
                        "on-tertiary-fixed": "#301400",
                        "on-tertiary-fixed-variant": "#703800",
                        "surface-container-high": "#e6e8ea",
                        "primary-container": "#008394",
                        "error": "#ba1a1a",
                        "surface-bright": "#f7f9fb",
                        "on-primary-container": "#000608",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-surface": "#191c1e",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary": "#ffffff",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed": "#001f25",
                        "surface-container": "#eceef0",
                        "tertiary-fixed": "#ffdcc5",
                        "outline-variant": "#bdc8cb",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-container": "#ab662d",
                        "on-surface-variant": "#3e494b",
                        "surface": "#f7f9fb",
                        "secondary-container": "#d5e3fc",
                        "on-tertiary-container": "#0c0300",
                        "surface-variant": "#e0e3e5",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-background": "#191c1e",
                        "background": "#f7f9fb",
                        "inverse-primary": "#75d4e7",
                        "surface-dim": "#d8dadc",
                        "outline": "#6e797c",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-fixed-variant": "#004e59",
                        "on-error-container": "#93000a",
                        "secondary": "#515f74",
                        "on-secondary-container": "#57657a"
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
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body class="bg-surface text-on-surface antialiased min-h-screen flex items-center justify-center p-4 md:p-6">
    <main class="w-full max-w-3xl bg-surface-container-lowest overflow-hidden flex flex-col md:flex-row shadow-2xl rounded-3xl">
        <!-- Left Side: Branding & Value Props -->
        <section class="relative w-full md:w-5/12 bg-primary-container p-5 md:p-6 flex flex-col justify-between text-on-primary overflow-hidden">
            <!-- Background Texture -->
            <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-on-primary rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">medical_services</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Cabinet Médical</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-5 leading-tight">
                    Bienvenue au Cabinet Médical
                </h1>
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
                            <span class="material-symbols-outlined text-white">description</span>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Accès ordonnances</p>
                            <p class="text-white/70 text-sm">Retrouvez l'historique de vos prescriptions et documents médicaux.</p>
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
            <!-- Floating Badge Card -->
            <div class="relative z-10 mt-6 glass-card p-4 rounded-2xl flex items-center gap-3">
                <img alt="Portrait du Dr Martin Rousseau" class="w-12 h-12 rounded-full object-cover border-2 border-white/20" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFbjCStiG_XPEAtJM0q6CuqpJebap61-F0hcCdRXtvLf3aBiBVUgTtuSb3bmlJIQso8pR87DNO2Kp09uPq2pat2RK9odIhJBRc1Kp2gpAykhQf-pMdL8m1z_IOzEM1t3DhadyDeGc4OMkUzC-cok3wQQ1lf6ZEfpf7xqdGgP7hVzCU0klOVZECTylEY1023XLf8NhvxpgDe-VT7tJP6SQhUKJc6WFqH-JB9KBmeCi9mN0Nsh-FjLmlvB3Nid1DenubEuZjZGCYmVs" />
                <div>
                    <p class="text-sm font-medium">Dr. Martin Rousseau</p>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="text-xs font-bold">4.9/5 satisfaction patient</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- Right Side: Login Form -->
        <section class="w-full md:w-7/12 p-5 md:p-8 flex flex-col justify-center bg-surface-container-lowest">
            <div class="max-w-sm mx-auto w-full">
                <header class="mb-6">
                    <h2 class="text-2xl font-bold text-on-surface mb-2">Se connecter</h2>
                    <p class="text-on-surface-variant">Accédez à votre espace patient sécurisé.</p>
                </header>
                <form class="space-y-5" action="/login" method="POST">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="text-sm font-semibold text-on-surface-variant ml-1" for="email">Adresse email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">mail</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50" id="email" name="email" placeholder="nom@exemple.com" required="" type="email" />
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-sm font-semibold text-on-surface-variant" for="password">Mot de passe</label>
                            <a class="text-xs font-bold text-primary hover:underline" href="#">Oublié ?</a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-lg">lock</span>
                            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl border-none ring-1 ring-outline/10 focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50" id="password" name="password" placeholder="••••••••" required="" type="password" />
                        </div>
                    </div>
                    <div class="flex items-center px-1">
                        <input class="w-4 h-4 rounded border-outline/30 text-primary focus:ring-primary cursor-pointer" id="remember" name="remember" type="checkbox" />
                        <label class="ml-3 text-sm text-on-surface-variant cursor-pointer" for="remember">Se souvenir de moi</label>
                    </div>
                    <div class="pt-4">
                        <button class="w-full py-4 px-6 bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold rounded-xl shadow-[0_4px_20px_-2px_rgba(0,104,118,0.25)] hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 group" type="submit">
                            Se connecter
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">login</span>
                        </button>
                    </div>
                </form>
                <!-- Alternative Login Methods -->
                <div class="relative my-8 text-center">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline/10"></div>
                    </div>
                    <span class="relative bg-surface-container-lowest px-4 text-[10px] uppercase tracking-widest font-bold text-outline">Ou continuer avec</span>
                </div>
    
                <footer class="mt-10 text-center">
                    <p class="text-on-surface-variant text-sm">
                        Vous n'avez pas encore de compte ?
                        <a class="text-primary font-bold hover:underline ml-1 cursor-pointer" href="register">S'inscrire</a>
                    </p>
                    <div class="mt-8 pt-8 border-t border-outline/5">
                        <a class="inline-flex items-center gap-2 text-xs text-outline hover:text-primary transition-colors" href="">
                            <span class="material-symbols-outlined text-sm">help_outline</span>
                            Besoin d'aide ? Contacter le support
                        </a>
                    </div>
                </footer>
            </div>
        </section>
    </main>
    <!-- Content Footer (Legal) -->
    <footer class="fixed bottom-4 left-0 right-0 hidden md:block">
        <div class="max-w-6xl mx-auto px-8 flex justify-between items-center text-[10px] uppercase tracking-widest text-on-surface-variant opacity-40 font-bold">
            <span>© 2024 CABINET MÉDICAL</span>
            <div class="flex gap-4">
                <span>POLITIQUE DE CONFIDENTIALITÉ</span>
                <span>MENTIONS LÉGALES</span>
            </div>
        </div>
    </footer>
</body>

</html>
