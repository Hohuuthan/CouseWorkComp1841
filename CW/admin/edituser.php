<?php
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunction.php';
include '../includes/session.php';           

if (isset($_POST['username']) && isset($_POST['email'])) {
    try {
        updateUser($pdo, $_POST['id'], $_POST['username'], $_POST['email']);
        
        header('Location: users.php');     
        exit;
        
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to update user: ' . $e->getMessage();
        include '../templates/layout.html.php';
        exit;
    }
} else {
    $user = getUser($pdo, $_GET['id'] ?? 0);
    
    if (!$user) {
        header('Location: users.php');
        exit;
    }

    $title = 'Edit User';
    ob_start();
    include '../templates/edituser.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
?>