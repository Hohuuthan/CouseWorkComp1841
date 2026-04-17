<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../reviews.php?error=permission_denied');
    exit;
}

deletereview($pdo, $_POST['id']);
header('Location: ../reviews.php');
exit;
?>