
<?php
include '../includes/db.php';

$stmt = $pdo->query('SELECT * FROM patients');
$patients = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2 class="mb-4">Liste des Patients</h2>
    <a href="../patient.php?action=add" class="btn btn-success mb-3">Ajouter un patient</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $patient['nom'] ?></td>
                <td><?= $patient['prenom'] ?></td>
                <td><?= date('d/m/Y', strtotime($patient['date_naissance'])) ?></td>
                <td><?= $patient['adresse'] ?></td>
                <td>
                    <a href="../patient.php?action=edit&id=<?= $patient['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="../patient.php?action=delete&id=<?= $patient['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce patient ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
