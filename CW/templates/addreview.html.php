<form action="" method="post" enctype="multipart/form-data">
    <label for="reviewtext">Enter your review:</label>
    <textarea name="reviewtext" rows="4" cols="50" required></textarea>
    
    <label for="image">Upload an image (optional):</label>
    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/gif">
    
    <!-- Chỉ admin mới thấy phần chọn user -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <p>
            <label for="user_id">Select an user:</label><br>
            <select name="user_id" id="user_id" required>
                <option value="">select an user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
    <?php endif; ?>

    <p>
        <label for="film_id">Select film:</label><br>
        <select name="film_id" id="film_id" required>
            <option value="">select film</option>
            <?php foreach ($films as $film): ?>
                <option value="<?= htmlspecialchars($film['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <input type="submit" value="Add review">
</form>