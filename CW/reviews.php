<?php
include 'includes/DatabaseConnection.php';
include 'includes/DataBaseFunction.php';
include 'includes/session.php';

try {
    $reviews = getAllReviews($pdo);
    $reviewCount = reviewCount($pdo);

    $title = 'Reviews';

    ob_start();
    include './templates/reviews.html.php';
    $output = ob_get_clean();
}
catch (PDOException $e) {
    $title = 'Database error';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';
?>