<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle Ordonnance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 p-4 bg-white shadow rounded">
    <h2 class="mb-4">Établir une ordonnance</h2>

    
    <form action="{{ route('doctor.ordonnance.store', $rendezVous->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="diagnostic" class="form-label"><strong>Diagnostic / Type de maladie</strong></label>
            <input type="text" name="diagnostic" id="diagnostic" class="form-control" placeholder="Ex: Grippe, Hypertension, etc.">
        </div>
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>Médicament</th>
                <th>Dosage</th>
                <th>Durée</th>
                <th>Remarques</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="ordonnance-table">
            <tr>
                <td><input type="text" name="medicaments[0][nom]" class="form-control"></td>
                <td><input type="text" name="medicaments[0][dosage]" class="form-control"></td>
                <td><input type="text" name="medicaments[0][duree]" class="form-control"></td>
                <td><input type="text" name="medicaments[0][remarques]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">Supprimer</button></td>
            </tr>
        </tbody>
    </table>

    <button type="button" id="add-row" class="btn btn-warning mb-3">Ajouter ligne</button>
    <button type="submit" class="btn btn-success">Générer Ordonnance PDF</button>
</form>
</div>

<script>
    let rowCount = 1;
    document.getElementById('add-row').addEventListener('click', function() {
        let table = document.getElementById('ordonnance-table');
        let newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="medicaments[${rowCount}][nom]" class="form-control"></td>
            <td><input type="text" name="medicaments[${rowCount}][dosage]" class="form-control"></td>
            <td><input type="text" name="medicaments[${rowCount}][duree]" class="form-control"></td>
            <td><input type="text" name="medicaments[${rowCount}][remarques]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">Supprimer</button></td>
        `;
        table.appendChild(newRow);
        rowCount++;
    });

    // supprimer ligne
    document.addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>

</body>
</html>
