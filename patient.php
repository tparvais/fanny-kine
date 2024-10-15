
        <?php
        include 'includes/db.php';

        $action = $_GET['action'];
        if ($action == 'add') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stmt = $pdo->prepare('INSERT INTO patients (nom, prenom, date_naissance, adresse, gsm, email, medecin_ref, registre_national) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
                $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse'], $_POST['gsm'], $_POST['email'], $_POST['medecin_ref'], $_POST['registre_national']]);
                header('Location: views/list_patients.php');
            }
        } elseif ($action == 'edit') {
            // Traitement de la modification
        } elseif ($action == 'delete') {
            $stmt = $pdo->prepare('DELETE FROM patients WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            header('Location: views/list_patients.php');
        }
        ?>
        