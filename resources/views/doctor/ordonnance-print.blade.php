<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Ordonnance — Dr. {{ $ordonnance->consultation->medecin->user->name }}</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal:       #006876;
            --teal-mid:   #008394;
            --teal-light: #e8f4f6;
            --text:       #1a1c1e;
            --muted:      #5a6a6d;
            --faint:      #8fa3a6;
            --border:     #d0dadc;
            --bg:         #f7fafc;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #e8ecee;
            color: var(--text);
            padding: 48px 24px;
            font-size: 13px;
        }

        .page {
            max-width: 640px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid var(--border);
            box-shadow: 0 4px 24px rgba(0,0,0,.09);
        }

        /* Header */
        .header {
            padding: 28px 36px 24px;
            border-bottom: 2px solid var(--teal);
        }

        .header-table, .logo-table, .row-table, .footer-table, .contact-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
        }

        .logo-name {
            font-size: 17px;
            font-weight: 700;
            color: var(--teal);
            letter-spacing: .2px;
        }

        .logo-sub {
            font-size: 10px;
            color: var(--faint);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .header-ref { text-align: right; }
        .ref-label {
            font-size: 10px;
            color: var(--faint);
            text-transform: uppercase;
            letter-spacing: .8px;
        }
        .ref-date {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            margin-top: 3px;
        }

        /* Status bar */
        .status-bar {
            background: var(--teal-light);
            border-bottom: 1px solid #c2dde1;
            padding: 9px 36px;
        }
        .status-bar span {
            font-size: 11px;
            font-weight: 700;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        /* Body */
        .body { padding: 30px 36px; }

        .section + .section { margin-top: 22px; }

        .section-title {
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            color: var(--faint);
            margin-bottom: 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid var(--border);
        }

        /* Info rows */
        .row { border-bottom: 1px dashed var(--border); }
        .row:last-child { border-bottom: none; }
        .row td { padding: 6px 0; vertical-align: top; }
        .row .key { color: var(--muted); font-size: 12px; width: 38%; }
        .row .val { font-size: 13px; font-weight: 600; color: var(--text); text-align: right; }
        .row .val.teal { color: var(--teal); }

        /* Medication items */
        .med-item {
            background: var(--bg);
            border: 1px solid var(--border);
            border-left: 3px solid var(--teal);
            padding: 11px 16px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .med-item:last-child { margin-bottom: 0; }
        .med-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .med-meta {
            font-size: 11px;
            color: var(--muted);
        }
        .med-instructions {
            font-size: 11px;
            color: var(--muted);
            font-style: italic;
            margin-top: 4px;
        }

        /* Diagnostic */
        .diag-box {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 12px 16px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Signature */
        .sig { text-align: right; }
        .sig-line {
            width: 140px;
            border-top: 1px solid #a0b0b3;
            margin-left: auto;
            margin-bottom: 5px;
        }
        .sig-name { font-size: 11px; font-weight: 700; color: var(--teal); }
        .sig-role { font-size: 10px; color: var(--faint); margin-top: 2px; }

        /* Contact strip */
        .contact-strip {
            background: var(--bg);
            border-top: 1px solid var(--border);
            padding: 8px 36px;
        }
        .contact-strip span { font-size: 10.5px; color: var(--faint); }

        /* Footer */
        .footer {
            border-top: 1px solid var(--border);
            padding: 18px 36px;
        }
        .footer-note {
            font-size: 10px;
            color: var(--faint);
            line-height: 1.7;
            max-width: 300px;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .page { box-shadow: none; max-width: 100%; border: none; }
            @page { size: A4; margin: 14mm 18mm; }
        }
    </style>
</head>
<body>
<div class="page">

    {{-- Header --}}
    <header class="header">
        <table class="header-table">
            <tr>
                <td style="width:68%;vertical-align:middle;">
                    <table class="logo-table">
                        <tr>
                            <td style="width:52px;vertical-align:middle;">
                                <div class="logo-icon">
                                    <table width="40" height="40"><tr><td align="center" valign="middle">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="8" y="2" width="4" height="16" rx="1.5" fill="white"/>
                                            <rect x="2" y="8" width="16" height="4" rx="1.5" fill="white"/>
                                        </svg>
                                    </td></tr></table>
                                </div>
                            </td>
                            <td style="vertical-align:middle;padding-left:10px;">
                                <div class="logo-name">Cabinet Médical</div>
                                <div class="logo-sub">Ordonnance Médicale — Marrakech</div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:32%;vertical-align:middle;">
                    <div class="header-ref">
                        <div class="ref-label">Date</div>
                        <div class="ref-date">{{ \Carbon\Carbon::parse($ordonnance->date)->format('d/m/Y') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </header>

    {{-- Status bar --}}
    <div class="status-bar">
        <span>Ordonnance Médicale</span>
    </div>

    <div class="body">

        {{-- Médecin --}}
        <div class="section">
            <div class="section-title">Médecin Prescripteur</div>
            <table class="row-table">
                <tr class="row">
                    <td class="key">Nom</td>
                    <td class="val teal">Dr. {{ $ordonnance->consultation->medecin->user->name }}</td>
                </tr>
                <tr class="row">
                    <td class="key">Spécialité</td>
                    <td class="val">{{ $ordonnance->consultation->medecin->specialite->nom ?? '—' }}</td>
                </tr>
            </table>
        </div>

        {{-- Patient --}}
        @php
            $patient = $ordonnance->consultation->patient;
            $age = $patient->date_naissance
                ? \Carbon\Carbon::parse($patient->date_naissance)->age . ' ans'
                : '—';
        @endphp
        <div class="section">
            <div class="section-title">Patient</div>
            <table class="row-table">
                <tr class="row">
                    <td class="key">Nom</td>
                    <td class="val">{{ $patient->user->name }}</td>
                </tr>
                <tr class="row">
                    <td class="key">CIN</td>
                    <td class="val">{{ $patient->cin ?? '—' }}</td>
                </tr>
                <tr class="row">
                    <td class="key">Âge</td>
                    <td class="val">{{ $age }}</td>
                </tr>
                <tr class="row">
                    <td class="key">Téléphone</td>
                    <td class="val">{{ $patient->telephone ?? '—' }}</td>
                </tr>
            </table>
        </div>

        {{-- Médicaments --}}
        <div class="section">
            <div class="section-title">Médicaments Prescrits</div>
            @if($ordonnance->prescriptions->isEmpty())
                <p style="font-size:12px;color:var(--faint);font-style:italic;">Aucun médicament prescrit.</p>
            @else
                @foreach($ordonnance->prescriptions as $i => $prescription)
                <div class="med-item">
                    <div class="med-name">{{ $i + 1 }}. {{ $prescription->medicament }}</div>
                    <div class="med-meta">
                        Dosage : <strong>{{ $prescription->dosage }}</strong>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        Fréquence : <strong>{{ $prescription->frequence }}</strong>
                    </div>
                    @if($prescription->instructions)
                    <div class="med-instructions">{{ $prescription->instructions }}</div>
                    @endif
                </div>
                @endforeach
            @endif
        </div>

        {{-- Diagnostic --}}
        @if($ordonnance->consultation->diagnostic)
        <div class="section">
            <div class="section-title">Diagnostic</div>
            <div class="diag-box">{{ $ordonnance->consultation->diagnostic }}</div>
        </div>
        @endif

        {{-- Signature --}}
        <div class="section" style="margin-top:36px;">
            <div class="sig">
                <div class="sig-line"></div>
                <div class="sig-name">Dr. {{ $ordonnance->consultation->medecin->user->name }}</div>
                <div class="sig-role">{{ $ordonnance->consultation->medecin->specialite->nom ?? 'Médecin' }}</div>
            </div>
        </div>

    </div>

    {{-- Contact strip --}}
    <div class="contact-strip">
        <table class="contact-table">
            <tr>
                <td style="text-align:center;"><span>123 Rue de Hassan 2, Guéliz, Marrakech</span></td>
                <td style="text-align:center;"><span>+212 641 371 472</span></td>
                <td style="text-align:center;"><span>contact@cabinet-medical.ma</span></td>
            </tr>
        </table>
    </div>

    {{-- Footer --}}
    <footer class="footer">
        <table class="footer-table">
            <tr>
                <td style="width:62%;vertical-align:bottom;">
                    <div class="footer-note">
                        Document généré automatiquement par le système médical.<br>
                        Valable uniquement pour la date indiquée.
                    </div>
                </td>
                <td style="width:38%;vertical-align:bottom;text-align:right;">
                    <div style="font-size:10px;color:var(--faint);">© 2026 Cabinet Médical</div>
                </td>
            </tr>
        </table>
    </footer>

</div>
</body>
</html>
