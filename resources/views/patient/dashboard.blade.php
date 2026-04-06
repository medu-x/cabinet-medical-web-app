<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cabinet Médical - Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#006876",
                        "primary-container": "#008394",
                        "on-primary": "#ffffff",
                        "surface": "#f7f9fb",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#3e494b",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "surface-container": "#eceef0",
                        "outline": "#6e797c",
                    },
                    fontFamily: {
                        body: ["Inter"],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen">
    {{-- Top Navigation Bar --}}
    <nav class="bg-surface-container-lowest shadow-sm border-b border-outline/10 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">medical_services</span>
            </div>
            <span class="text-xl font-bold tracking-tight">Cabinet Médical</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-on-surface-variant text-sm">{{ Auth::user()->name }}</span>
            <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase">{{ Auth::user()->role }}</span>
            {{-- Logout Button --}}
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-1 text-sm text-outline hover:text-red-500 transition-colors">
                    <span class="material-symbols-outlined text-lg">logout</span>
                    Déconnexion
                </button>
            </form>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto mt-10 px-6">
        <div class="bg-surface-container-lowest rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold mb-2">
                Bienvenue, {{ Auth::user()->name }} 
            </h1>
            <p class="text-on-surface-variant mb-8">
                Vous êtes connecté en tant que <strong class="text-primary">{{ Auth::user()->role }}</strong>.
            </p>
        </div>
    </main>
</body>
</html>
