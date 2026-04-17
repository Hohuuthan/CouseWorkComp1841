<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

$title = 'Add a New Review';
$output = '';

// Guest cannot add review
if ($_SESSION['role'] === 'guest') {
    header('Location: ../login.php');
    exit;
}

try {
    if (isset($_POST['reviewtext'])) {
        $reviewtext = trim($_POST['reviewtext']);
        $film_id    = (int)$_POST['film_id'];
        $image      = null;

        $user_id = ($_SESSION['role'] === 'admin') ? (int)$_POST['user_id'] : $_SESSION['user_id'];

        // Handle image upload
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExt, $allowed)) {
                $imageName = uniqid('img_') . '.' . $fileExt;
                $destination = __DIR__ . '/../image/' . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                    $image = $imageName;
                }
            }
        }

        addreview($pdo, $reviewtext, $user_id, $film_id, $image);
        header('Location: ../reviews.php');
        exit;
    } 
    else {
        $films = $pdo->query("SELECT id, title FROM film ORDER BY title")->fetchAll(PDO::FETCH_ASSOC);
        $users = ($_SESSION['role'] === 'admin') 
               ? $pdo->query("SELECT id, username FROM user ORDER BY username")->fetchAll(PDO::FETCH_ASSOC) 
               : [];

        ob_start();
        include '../templates/addreview.html.php';
        $output = ob_get_clean();
    }
}
catch (Exception $e) {
    $title = 'Error';
    $output = 'Error: ' . htmlspecialchars($e->getMessage());
}

include '../templates/layout.html.php';
?>