<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappel de rendez-vous</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f9fb; margin: 0; padding: 40px 20px; }
        .container { max-width: 520px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #8d4e16, #ab662d); padding: 32px; text-align: center; }
        .header h1 { color: #fff; margin: 0 0 4px; font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
        .header p { color: rgba(255,255,255,0.75); margin: 0; font-size: 13px; }
        .body { padding: 32px; }
        .greeting { color: #191c1e; font-size: 15px; margin: 0 0 20px; }
        .reminder-badge { display: inline-block; background: #fff8e1; color: #78350f; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 5px 14px; border-radius: 999px; margin-bottom: 24px; border: 1px solid #f59e0b; }
        .details-box { background: #f7f9fb; border-radius: 12px; padding: 24px; margin-bottom: 24px; border: 1px solid #e0e3e5; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #e0e3e5; }
        .detail-row:last-child { border-bottom: none; padding-bottom: 0; }
        .detail-label { font-size: 11px; font-weight: 700; color: #6e797c; text-transform: uppercase; letter-spacing: 0.5px; }
        .detail-value { font-size: 14px; font-weight: 600; color: #191c1e; text-align: right; }
        .note { background: #fff8e1; border-left: 3px solid #f59e0b; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #78350f; margin-top: 4px; }
        .contact-strip { background: #f7f9fb; border-top: 1px solid #e0e3e5; padding: 16px 32px; text-align: center; font-size: 12px; color: #6e797c; }
        .footer { border-top: 1px solid #e0e3e5; padding: 20px 32px; text-align: center; font-size: 11px; color: #6e797c; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🗓 Rappel — Cabinet Médical</h1>
            <p>Votre rendez-vous est demain</p>
        </div>
        <div class="body">
            <p class="greeting">Bonjour <strong>{{ $rendezVous->patient->user->name }}</strong>,</p>
            <p style="color:#3e494b; font-size:14px; margin-bottom: 20px;">
                Nous vous rappelons que vous avez un rendez-vous prévu <strong>demain</strong>. Voici le récapitulatif :
            </p>

            <span class="reminder-badge">⏰ Rendez-vous demain</span>

            <div class="details-box">
                <div class="detail-row">
                    <span class="detail-label">Médecin</span>
                    <span class="detail-value">Dr. {{ $rendezVous->medecin->user->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Spécialité</span>
                    <span class="detail-value">{{ $rendezVous->medecin->specialite->nom }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('l j F Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Heure</span>
                    <span class="detail-value">{{ substr($rendezVous->heure_rendez_vous, 0, 5) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Lieu</span>
                    <span class="detail-value">123 Rue de Hassan 2, Guéliz, Marrakech</span>
                </div>
            </div>

            <div class="note">
                Présentez-vous <strong>10 minutes avant</strong> votre heure de rendez-vous. En cas d'empêchement, contactez-nous dès que possible.
            </div>
        </div>
        <div class="contact-strip">
            📞 +212 641 371 472 &nbsp;&middot;&nbsp; ✉ contact@cabinet-medical.ma
        </div>
        <div class="footer">
            © {{ date('Y') }} Cabinet Médical &middot; Cet email est envoyé automatiquement, ne pas répondre.
        </div>
    </div>
</body>
</html>
