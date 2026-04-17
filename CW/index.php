<?php
include 'includes/session.php';
include 'includes/DatabaseConnection.php';
include 'includes/DataBaseFunction.php';

$title = 'Movie Films Reviews';

// Load featured films for homepage
$films = allFilms($pdo);

ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>