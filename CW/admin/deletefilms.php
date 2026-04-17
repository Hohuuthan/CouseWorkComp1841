<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';

try {
    deleteFilm($pdo, $_POST['id']);
    header('Location: ../films.php');
    exit;
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete film: ' . $e->getMessage();
}

include '../templates/layout.html.php';
?>