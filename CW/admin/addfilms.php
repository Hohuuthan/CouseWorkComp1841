<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../films.php?error=permission_denied');
    exit;
}

if (isset($_POST['title'])) {
    try {
        $image = null;
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif'];
            if (in_array($fileExt, $allowed)) {
                $imageName = basename($_FILES['image']['name']);           // ← DÙNG TÊN GỐC
                $destination = __DIR__ . '/../image/' . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    $image = $imageName;
                }
            }
        }
        insertFilm($pdo, $_POST['title'], $_POST['genre'] ?? null, $_POST['release_year'] ?? null, $image);
        header('Location: ../films.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to add film: ' . $e->getMessage();
    }
} else {
    $title = 'Add New Film';
    ob_start();
    include '../templates/addfilms.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
?>