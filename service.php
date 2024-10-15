
        <?php
        include 'includes/db.php';

        $action = $_GET['action'];
        $patient_id = $_GET['patient_id'];

        $stmt = $pdo->prepare('SELECT nom, prenom, date_naissance FROM patients WHERE id = ?');
        $stmt->execute([$patient_id]);
        $patient = $stmt->fetch();

        if ($action == 'add') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stmt = $pdo->prepare('INSERT INTO prestations (patient_id, date_prestation, commentaires, code_inami, montant, paye) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$patient_id, $_POST['date_prestation'], $_POST['commentaires'], $_POST['code_inami'], $_POST['montant'], isset($_POST['paye'])]);
                header("Location: views/list_services.php?patient_id=$patient_id");
            }
        }
        ?>
        