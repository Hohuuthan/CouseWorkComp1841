<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';
include 'includes/session.php';
try {
    $films = allFilms($pdo);        
    $title = 'Films List';
    
    ob_start();
    include './templates/films.html.php';
    $output = ob_get_clean();
} 
catch (PDOException $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';
?>