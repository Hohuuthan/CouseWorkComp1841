<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';           // ← THÊM DÒNG NÀY

// Chỉ admin mới vào được
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../films.php?error=permission_denied');
    exit;
}

if (isset($_POST['name']) && isset($_POST['email'])) {
    try {
        // Nếu bạn muốn admin nhập password khi tạo user thì giữ nguyên
        // (hiện tại form chưa có trường password nên sẽ dùng chuỗi rỗng)
        insertUser($pdo, $_POST['name'], $_POST['email'], $_POST['password'] ?? '');
        
        header('Location: users.php');
        exit;
    } catch (PDOException $e) {
        $title = 'Error';
        $output = 'Unable to add user: ' . $e->getMessage();
        include '../templates/layout.html.php';
        exit;
    }
} else {
    $title = 'Add User';
    ob_start();
    include '../templates/adduser.html.php';
    $output = ob_get_clean();
}

include '../templates/layout.html.php';
?>