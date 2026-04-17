<?php
include 'includes/DatabaseConnection.php';
include 'includes/session.php';

$title = 'Login';
$output = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("
            SELECT id, username, password, role 
            FROM user 
            WHERE username = :username
        ");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $isValid = false;
        $role    = 'user';

        // Special admin account
        if ($username === 'admin' && $password === '123') {
            $isValid = true;
            $role = 'admin';
        }
        // Regular users (hashed password)
        elseif ($user && password_verify($password, $user['password'] ?? '')) {
            $isValid = true;
            $role = $user['role'] ?? 'user';
        }

        if ($isValid) {
            $_SESSION['user_id']   = $user['id'] ?? 0;
            $_SESSION['username']  = $username;
            $_SESSION['role']      = $role;

            header('Location: index.php');
            exit;
        } else {
            $output = '<p style="color:red; font-weight:bold; text-align:center;">
                        Username or password is incorrect!
                       </p>';
        }
    } catch (PDOException $e) {
        $output = '<p style="color:red; text-align:center;">Database error!</p>';
    }
}

ob_start();
?>
<h2>Login</h2>

<?php if ($output) echo $output; ?>

<?php if (isset($_GET['registered'])): ?>
<p style="color:green; font-weight:bold; text-align:center;">
    ✅ Account created successfully!<br>
    <small>You can now log in.</small>
</p>
<?php endif; ?>

<form action="login.php" method="post">
    <p>
        <label for="username"><strong>Username:</strong></label><br>
        <input type="text" name="username" id="username" required 
               style="width: 350px; padding: 12px; font-size: 16px;" 
               placeholder="admin or your new username">
    </p>
    <p>
        <label for="password"><strong>Password:</strong></label><br>
        <input type="password" name="password" id="password" required 
               style="width: 350px; padding: 12px; font-size: 16px;">
    </p>
    <p>
        <input type="submit" value="Login" 
               style="padding: 12px 40px; background: #27ae60; color: white; border: none; 
                      border-radius: 6px; cursor: pointer; font-size: 17px;">
    </p>
</form>

<!-- Create New Account button (Facebook style) -->
<p style="text-align: center; margin-top: 30px;">
    <a href="register.php" 
       style="background: #00a400; color: white; padding: 12px 40px; 
              text-decoration: none; border-radius: 6px; font-size: 17px; 
              box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block;">
        Create New Account
    </a>
</p>
<?php
$output = ob_get_clean();
include 'templates/layout.html.php';
?>