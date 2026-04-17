<?php
$basePath = (isset($_SERVER['SCRIPT_NAME']) && strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) ? '../' : '';
$imagePath = $basePath . 'image/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= $basePath ?>reviews.css">
    <title><?= htmlspecialchars($title ?? 'User Review Film Database') ?></title>
    <style>
        .header-top { display: flex; justify-content: space-between; align-items: center; padding: 15px 25px; background: #2c3e50; color: white; }
        nav ul { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 10px; background: #443A5C; padding: 15px 25px; }
        nav ul li a { color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; }
        nav ul li a:hover { background: #555; }
    </style>
</head>
<body>
    <div class="header-top">
        <h1>Movie Films Reviews</h1>
        <div style="margin-left: auto; display: flex; align-items: center; gap: 20px;">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Hello, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 
                (<span style="color:#4CAF50;"><?= htmlspecialchars($_SESSION['role']) ?></span>)</span>
                <a href="<?= $basePath ?>logout.php" style="color: #ff4757; text-decoration: none; font-weight: bold;">Logout</a>
            <?php else: ?>
                <a href="<?= $basePath ?>login.php" style="background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <nav>
        <ul>
            <li><a href="<?= $basePath ?>index.php">Home</a></li>
            <li><a href="<?= $basePath ?>reviews.php">Reviews List</a></li>
            <li><a href="<?= $basePath ?>films.php">Films List</a></li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <li><a href="<?= $basePath ?>admin/addreview.php">Add a new review</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <li><a href="<?= $basePath ?>contact.php">Contact</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="<?= $basePath ?>admin/addfilms.php">Add Film</a></li>
                <li><a href="<?= $basePath ?>admin/users.php">Users List</a></li>
                <li><a href="<?= $basePath ?>admin/admin_contacts.php">View Contact Messages</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <?=$output ?? ''?>
    </main>

    <footer>&copy; IJDB 2023</footer>
</body>
</html>