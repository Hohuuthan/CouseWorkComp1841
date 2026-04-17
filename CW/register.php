<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';
include 'includes/session.php';

$title = 'Register New Account';
$output = '';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $output = '<p style="color:red; font-weight:bold; text-align:center;">Password confirmation does not match!</p>';
    } else {
        try {
            insertUser($pdo, $name, $email, $password);
            header('Location: login.php?registered=1');
            exit;
        } catch (PDOException $e) {
            $output = '<p style="color:red; font-weight:bold; text-align:center;">
                        Unable to create account: ' . htmlspecialchars($e->getMessage()) . '
                       </p>';
        }
    }
}

ob_start();
include 'templates/register.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>