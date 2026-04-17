<h2>Edit User</h2>

<form action="" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">

    <p>
        <label for="username">User Name:</label><br>
        <input type="text" name="username" id="username" 
               value="<?= htmlspecialchars($user['username'] ?? '') ?>" 
               required style="width: 300px; padding: 8px;">
    </p>

    <p>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" 
               value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
               required style="width: 300px; padding: 8px;">
    </p>

    <p>
        <input type="submit" value="Save Changes" 
               style="padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
    </p>
</form>