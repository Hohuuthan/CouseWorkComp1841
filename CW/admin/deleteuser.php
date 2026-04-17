<?php
include '../includes/DatabaseConnection.php';
include '../includes/DatabaseFunction.php';
include '../includes/session.php';           // ← Thêm dòng này

if (isset($_POST['id'])) {
    try {
        deleteUser($pdo, $_POST['id']);
        header('Location: users.php');       // ← Sửa thành users.php (không có ../)
        exit;
    } catch (PDOException $e) {
        $title = 'Cannot Delete User';
        
        if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
            $output = '<p style="color:red; font-weight:bold; padding:20px;">
                        ❌ Không thể xóa user này!<br><br>
                        User này đang có review.<br>
                        Hãy xóa hết review của user trước khi xóa.
                       </p>';
        } else {
            $output = 'Unable to delete user: ' . htmlspecialchars($e->getMessage());
        }
        
        include '../templates/layout.html.php';
        exit;
    }
}
?>