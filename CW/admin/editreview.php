<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

if ($_SESSION['role'] === 'guest') {
    header('Location: ../login.php');
    exit;
}

if (isset($_POST['reviewtext'])) {
    $review = getreview($pdo, $_POST['reviewid']);

    if ($_SESSION['role'] !== 'admin' && $review['user_id'] != $_SESSION['user_id']) {
        header('Location: ../reviews.php?error=permission_denied');
        exit;
    }

    updatereview($pdo, $_POST['reviewid'], $_POST['reviewtext']);
    header('Location: ../reviews.php');
    exit;
} 
else {
    $review = getreview($pdo, $_GET['id'] ?? 0);
    
    if (!$review) {
        header('Location: ../reviews.php?error=notfound');
        exit;
    }

    if ($_SESSION['role'] !== 'admin' && $review['user_id'] != $_SESSION['user_id']) {
        header('Location: ../reviews.php?error=permission_denied');
        exit;
    }

    $title = 'Edit Review';
    ob_start();
    include '../templates/editreview.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
?>