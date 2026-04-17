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
        $id    = $_POST['id'];
        $title = $_POST['title'];
        $image = null;

        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExt, $allowed)) {
                $imageName = uniqid('film_') . '.' . $fileExt;
                $destination = __DIR__ . '/../image/' . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    $image = $imageName;
                }
            }
        }

        updateFilm($pdo, $id, $title, $image);
        header('Location: ../films.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $film = getFilm($pdo, $_GET['id'] ?? 0);
    
    if (!$film) {
        header('Location: ../films.php');
        exit;
    }
    
    $title = "Edit Film";
    ob_start();
    include '../templates/editfilms.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
?>