<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord du médecin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h2>Tableau de bord du médecin</h2>

    <!-- Cards statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5>Total Patients</h5>
                    <p class="fs-3">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5>Consultations terminées</h5>
                    <p class="fs-3">{{ $totalConsultations }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-warning text-dark">
                <div class="card-body">
                    <h5>En attente</h5>
                    <p class="fs-3">{{ $waiting }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des rendez-vous -->
    <h4>Liste des Rendez-vous</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Statut</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medecin->rendezVous as $rdv)
                <tr>
                    <td>{{ $rdv->patient->user->name }}</td>
                    <td>{{ $rdv->date_rendez_vous }}</td>
                    <td>{{ $rdv->heure_rendez_vous }}</td>
                    <td>{{ $rdv->statut }}</td>
                    <td>{{ $rdv->notes }}</td>
                    <td>
                        <a href="{{ route('doctor.ordonnance', $rdv->id) }}" class="btn btn-success btn-sm">Ordonnance PDF</a>
                        <a href="{{ route('doctor.ordonnance.form', $rdv->id) }}" class="btn btn-warning btn-sm">Nouvelle Ordonnance</a>
                        <a href="{{ route('doctor.ordonnance.history', $rdv->patient->id) }}" class="btn btn-info btn-sm">Historique</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
