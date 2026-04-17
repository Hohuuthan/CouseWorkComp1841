<?php $imagePath = '../image/'; ?>

<h2>Edit Film</h2>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($film['id'] ?? '') ?>">

    <p>
        <label for="title">Film Name:</label><br>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($film['title'] ?? '') ?>" required style="width: 400px; padding: 8px;">
    </p>

    <?php if (!empty($film['image'])): ?>
        <p>
            <strong>Current Poster:</strong><br>
            <img src="<?= $imagePath . htmlspecialchars($film['image']) ?>" 
                 alt="Current poster" 
                 style="max-width: 200px; border-radius: 8px; margin: 10px 0;">
        </p>
    <?php endif; ?>

    <p>
        <label for="image">New Poster (optional - leave empty to keep current):</label><br>
        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/gif">
    </p>

    <p>
        <input type="submit" value="Save Changes" 
               style="padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
    </p>
</form>