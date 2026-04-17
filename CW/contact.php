<?php

include 'includes/DatabaseConnection.php';
include 'includes/DataBaseFunction.php';
include 'includes/session.php';

if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'] ?? null;  

    addcontact($pdo, $content, $user_id);

    $title = 'Contact Sent';
    $output = 'Your message has been sent';
}
else {
    $title = 'Contact Page';

    ob_start();
    include './templates/contact.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
?>