<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Ordonnances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h3>Historique des Ordonnances</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Diagnostic</th>
                <th>Ordonnance PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rendezVousList as $rdv)
                @php
                    $parts = explode(' | ', $rdv->notes);
                    $diagnostic = str_starts_with($parts[0], 'Diagnostic:') ? str_replace('Diagnostic: ', '', $parts[0]) : '';
                @endphp
                <tr>
                    <td>{{ $rdv->date_rendez_vous }}</td>
                    <td>{{ $diagnostic }}</td>
                    <td>
                        <a href="{{ route('doctor.ordonnance', $rdv->id) }}" class="btn btn-success btn-sm">Voir PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
