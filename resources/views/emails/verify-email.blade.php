<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de votre email</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f9fb; margin: 0; padding: 40px 20px; }
        .container { max-width: 480px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #006876, #008394); padding: 32px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; font-weight: 700; }
        .header p { color: rgba(255,255,255,0.75); margin: 6px 0 0; font-size: 13px; }
        .body { padding: 32px; }
        .greeting { color: #191c1e; font-size: 15px; margin-bottom: 20px; }
        .code-box { background: #f2f4f6; border-radius: 12px; text-align: center; padding: 24px; margin: 24px 0; }
        .code-label { font-size: 12px; font-weight: 600; color: #6e797c; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .code { font-size: 42px; font-weight: 800; letter-spacing: 10px; color: #006876; font-family: monospace; }
        .expiry { text-align: center; font-size: 13px; color: #6e797c; margin-bottom: 24px; }
        .expiry span { color: #ba1a1a; font-weight: 600; }
        .warning { background: #fff8e1; border-left: 3px solid #f59e0b; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #78350f; margin-top: 16px; }
        .footer { border-top: 1px solid #e0e3e5; padding: 20px 32px; text-align: center; font-size: 11px; color: #6e797c; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Cabinet Médical</h1>
            <p>Vérification de votre adresse email</p>
        </div>
        <div class="body">
            <p class="greeting">Bonjour <strong>{{ $userName }}</strong>,</p>
            <p style="color:#3e494b; font-size:14px;">Merci de vous être inscrit. Utilisez le code ci-dessous pour vérifier votre adresse email et activer votre compte :</p>

            <div class="code-box">
                <div class="code-label">Votre code de vérification</div>
                <div class="code">{{ $code }}</div>
            </div>

            <p class="expiry">Ce code expire dans <span>10 minutes</span>.</p>

            <div class="warning">
                Si vous n'avez pas créé de compte sur Cabinet Médical, ignorez cet email.
            </div>
        </div>
        <div class="footer">
            © {{ date('Y') }} Cabinet Médical · Cet email est envoyé automatiquement, ne pas répondre.
        </div>
    </div>
</body>
</html>
