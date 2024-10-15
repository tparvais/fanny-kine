
<?php
include '../includes/db.php';

$patient_id = $_GET['patient_id'];

$stmt = $pdo->prepare('
    SELECT p.nom, p.prenom, p.date_naissance, pr.*
    FROM prestations pr
    JOIN patients p ON p.id = pr.patient_id
    WHERE pr.patient_id = ?
');
$stmt->execute([$patient_id]);
$prestations = $stmt->fetchAll();

$patient = $prestations[0];
?>

<div class="container mt-5">
    <h2>Liste des Prestations pour <?= $patient['nom'] ?> <?= $patient['prenom'] ?> (né le <?= date('d/m/Y', strtotime($patient['date_naissance'])) ?>)</h2>
    <a href="../service.php?action=add&patient_id=<?= $patient_id ?>" class="btn btn-primary mb-3">Ajouter une prestation</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Commentaires</th>
                <th>Code INAMI</th>
                <th>Montant</th>
                <th>Payé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestations as $prestation): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($prestation['date_prestation'])) ?></td>
                <td><?= $prestation['commentaires'] ?></td>
                <td><?= $prestation['code_inami'] ?></td>
                <td><?= $prestation['montant'] ?> €</td>
                <td><?= $prestation['paye'] ? 'Oui' : 'Non' ?></td>
                <td>
                    <a href="../service.php?action=edit&id=<?= $prestation['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="../service.php?action=delete&id=<?= $prestation['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette prestation ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
