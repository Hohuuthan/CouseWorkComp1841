<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';

if (isset($_POST['id'])) {
    try {
        deleteContact($pdo, $_POST['id']);
        header('Location: admin_contacts.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to delete message: ' . $e->getMessage();
        include '../templates/layout.html.php';
        exit;
    }
}
?>