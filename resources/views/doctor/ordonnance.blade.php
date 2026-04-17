<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ordonnance Médicale</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 40px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Ordonnance Médicale</h2>

    <p><strong>Médecin :</strong> {{ $rendezVous->medecin->user->name }}</p>
    <p><strong>Patient :</strong> {{ $rendezVous->patient->user->name }}</p>
    <p><strong>Date :</strong> {{ $rendezVous->date_rendez_vous }}</p>

    <!-- هنا نعرض نوع المرض -->
    @if(!empty($diagnostic))
    <p><strong>Diagnostic :</strong> {{ $diagnostic }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Médicament</th>
                <th>Dosage</th>
                <th>Durée</th>
                <th>Remarques</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription['nom'] }}</td>
                    <td>{{ $prescription['dosage'] }}</td>
                    <td>{{ $prescription['duree'] }}</td>
                    <td>{{ $prescription['remarques'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:50px; text-align:right;">
        <p>Signature du médecin</p>
        <p>__________________________</p>
    </div>
</body>
</html>
