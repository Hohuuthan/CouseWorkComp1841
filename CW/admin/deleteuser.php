<?php
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunction.php';
include '../includes/session.php';           

if (isset($_POST['id'])) {
    try {
        deleteUser($pdo, $_POST['id']);
        header('Location: users.php');       
        exit;
    } catch (PDOException $e) {
        $title = 'Cannot Delete User';
        
        if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
            $output = '<p style="color:red; font-weight:bold; padding:20px;">
                        ❌ Can Delete this User!<br><br>
                        User have a review.<br>
                        Delete all review from User!.
                       </p>';
        } else {
            $output = 'Unable to delete user: ' . htmlspecialchars($e->getMessage());
        }
        
        include '../templates/layout.html.php';
        exit;
    }
}
?>