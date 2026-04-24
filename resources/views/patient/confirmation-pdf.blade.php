<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Confirmation de Rendez-vous</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --teal: #006876;
            --teal-mid: #008394;
            --teal-light: #e8f4f6;
            --text: #1a1c1e;
            --muted: #5a6a6d;
            --faint: #8fa3a6;
            --border: #d0dadc;
            --bg: #f7fafc;
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
            box-shadow: 0 4px 24px rgba(0, 0, 0, .09);
        }

        /* ── Header ── */
        .header {
            padding: 28px 36px 24px;
            border-bottom: 2px solid var(--teal);
        }

        .header-table,
        .logo-table,
        .row-table,
        .price-table,
        .footer-table,
        .contact-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--teal), var(--teal-mid));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
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

        .header-ref {
            text-align: right;
        }

        .ref-num {
            font-size: 15px;
            font-weight: 700;
            color: var(--teal);
        }

        .ref-date {
            font-size: 10px;
            color: var(--faint);
            margin-top: 3px;
        }

        /* ── Status bar ── */
        .status-bar {
            background: var(--teal-light);
            border-bottom: 1px solid #c2dde1;
            padding: 9px 36px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--teal);
        }

        .status-bar span {
            font-size: 11px;
            font-weight: 700;
            color: var(--teal);
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        /* ── Body ── */
        .body {
            padding: 30px 36px;
        }

        .section+.section {
            margin-top: 26px;
        }

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

        /* ── Data rows ── */
        .row {
            border-bottom: 1px dashed var(--border);
        }

        .row:last-child {
            border-bottom: none;
        }

        .row td {
            padding: 6px 0;
            vertical-align: top;
        }

        .row .key {
            color: var(--muted);
            font-size: 12px;
            width: 36%;
        }

        .row .val {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            text-align: right;
        }

        .row .val.teal {
            color: var(--teal);
        }

        /* ── Price inline ── */
        .price-row {
            background: var(--bg);
            border: 1px solid var(--border);
            border-left: 3px solid var(--teal);
            padding: 11px 16px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .price-row td {
            vertical-align: middle;
        }

        .price-row .price-label {
            font-size: 12px;
            color: var(--muted);
        }

        .price-row .price-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--teal);
        }

        /* ── Instructions ── */
        .instructions {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 14px 18px;
        }

        .instructions li {
            list-style: none;
            padding-left: 14px;
            position: relative;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .instructions li:last-child {
            margin-bottom: 0;
        }

        .instructions li::before {
            content: '—';
            position: absolute;
            left: 0;
            color: var(--teal);
            font-size: 11px;
        }

        /* ── Footer ── */
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

        .sig {
            text-align: right;
        }

        .sig-line {
            width: 120px;
            border-top: 1px solid #a0b0b3;
            margin-left: auto;
            margin-bottom: 5px;
        }

        .sig-name {
            font-size: 11px;
            font-weight: 700;
            color: var(--teal);
        }

        /* ── Contact strip ── */
        .contact-strip {
            background: var(--bg);
            border-top: 1px solid var(--border);
            padding: 8px 36px;
        }

        .contact-strip span {
            font-size: 10.5px;
            color: var(--faint);
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .page {
                box-shadow: none;
                max-width: 100%;
                border: none;
            }

            @page {
                size: A4;
                margin: 14mm 18mm;
            }
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- Header -->
        <header class="header">
            <table class="header-table">
                <tr>
                    <td style="width: 68%; vertical-align: middle;">
                        <table class="logo-table">
                            <tr>
                                <td style="width: 52px; vertical-align: middle;">
                                    <div class="logo-icon">
                                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="8" y="2" width="4" height="16" rx="1.5" fill="white" />
                                            <rect x="2" y="8" width="16" height="4" rx="1.5" fill="white" />
                                        </svg>
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">
                                    <div class="logo-name">Cabinet Médical</div>
                                    <div class="logo-sub">Marrakech</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 32%; vertical-align: middle;">
                        <div class="header-ref">
                            <div class="ref-num">RDV-{{ str_pad($rendezVous->id, 5, "0", STR_PAD_LEFT) }}</div>
                            <div class="ref-date">{{ ucwords(\Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('l, d F Y')) }}</div>
                        </div>
                    </td>
                </tr>
            </table>
        </header>

        <!-- Status -->
        <div class="status-bar">
            <span>Rendez-vous confirmé</span>
        </div>

        <!-- Body -->
        <div class="body">

            <!-- Patient -->
            <div class="section">
                <div class="section-title">Patient</div>
                <table class="row-table">
                    <tr class="row">
                        <td class="key">Nom</td>
                        <td class="val">{{ $rendezVous->patient->user->name }}</td>
                    </tr>
                    <tr class="row">
                        <td class="key">Email</td>
                        <td class="val">{{ $rendezVous->patient->user->email }}</td>
                    </tr>
                </table>
            </div>

            <!-- Rendez-vous -->
            <div class="section">
                <div class="section-title">Rendez-vous</div>
                <table class="row-table">
                    <tr class="row">
                        <td class="key">Médecin</td>
                        <td class="val teal">Dr.{{ $rendezVous->medecin->user->name }}</td>
                    </tr>
                    <tr class="row">
                        <td class="key">Spécialité</td>
                        <td class="val">{{ $rendezVous->medecin->specialite->nom }}</td>
                    </tr>
                    <tr class="row">
                        <td class="key">Date</td>
                        <td class="val">{{ ucwords(\Carbon\Carbon::parse($rendezVous->date_rendez_vous)->locale('fr')->translatedFormat('l, d F Y')) }}</td>
                    </tr>
                    <tr class="row">
                        <td class="key">Heure</td>
                        <td class="val">{{ substr($rendezVous->heure_rendez_vous, 0, 5) }}</td>
                    </tr>
                </table>

                <div class="price-row">
                    <table class="price-table">
                        <tr>
                            <td class="price-label">Honoraires de consultation</td>
                            <td class="price-value" style="text-align: right;">{{ number_format($rendezVous->medecin->specialite->prix_consultation, 2, ',', ' ') }} DH</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Instructions -->
            <div class="section">
                <div class="section-title">À noter</div>
                <div class="instructions">
                    <ul>
                        <li>Présentez-vous <strong>15 minutes avant</strong> l'heure du rendez-vous.</li>
                        <li>Munissez-vous de votre <strong>pièce d'identité</strong> et de vos anciens documents
                            médicaux si nécessaire.</li>
                        <li>En cas d'empêchement, contactez le cabinet <strong>au moins 24 h à l'avance</strong>.</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Contact -->
        <div class="contact-strip">
            <table class="contact-table">
                <tr>
                    <td style="text-align: center;"><span>123 Rue de Hassan 2, Guéliz, Marrakech</span></td>
                    <td style="text-align: center;"><span>+212 641 371 472</span></td>
                    <td style="text-align: center;"><span>contact@cabinet-medical.ma</span></td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <table class="footer-table">
                <tr>
                    <td style="width: 62%; vertical-align: bottom;">
                        <div class="footer-note">
                            Document généré automatiquement par le système de réservation.<br>
                            Valable uniquement pour la date et l'heure indiquées.
                        </div>
                    </td>
                    <td style="width: 38%; vertical-align: bottom;">
                        <div class="sig">
                            <div class="sig-line"></div>
                            <div class="sig-name">Cabinet Médical</div>
                        </div>
                    </td>
                </tr>
            </table>
        </footer>

    </div>
</body>

</html>
