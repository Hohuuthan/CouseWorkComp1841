<?php
// Hardcode đường dẫn cho admin (không dùng $basePath nữa)
$basePath = '';
?>

<p><?= count($users) ?> users have been registered in the Film Review Database.</p>

<table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background: #443A5C; color: white;">
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Register Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['created_at']) ?></td>
            <td style="white-space: nowrap; text-align: center;">
                
                <!-- EDIT -->
                <form action="edituser.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" class="btn btn-edit">Edit</button>
                </form>
                
                <!-- DELETE -->
                <form action="deleteuser.php" method="post" style="display:inline;" 
                      onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" class="btn btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="adduser.php" 
       style="display: inline-block; margin-top: 15px; padding: 10px 20px; 
              background: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">
        Add New User
    </a>
</p>