<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

try {
    $users = allUsers($pdo);
    $title = 'Users List';
    ob_start();
    include '../templates/users.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

include '../templates/layout.html.php';
?>