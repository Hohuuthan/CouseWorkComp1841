<?php $imagePath = 'image/'; ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <p><?= count($films) ?> films have been submitted.</p>
<?php endif; ?>

<table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background:#443A5C; color:white;">
            <th>ID</th><th>Film Name</th><th>Genre</th><th>Release Year</th><th>Date Added</th><th>Poster</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($films as $film): ?>
        <tr>
            <td><?= $film['id'] ?></td>
            <td><?= htmlspecialchars($film['title']) ?></td>
            <td><?= htmlspecialchars($film['genre'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($film['release_year'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($film['created_at']) ?></td>
            <td>
                <?php if (!empty($film['image'])): ?>
                    <img src="<?= $imagePath . htmlspecialchars($film['image']) ?>" 
                         style="max-width:80px; max-height:60px; object-fit:cover; border-radius:4px;">
                <?php else: ?>
                    <em>No image</em>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="admin/editfilms.php?id=<?= $film['id'] ?>" class="btn btn-edit">Edit</a>
                    <form action="admin/deletefilms.php" method="post" style="display:inline;" onsubmit="return confirm('Delete?');">
                        <input type="hidden" name="id" value="<?= $film['id'] ?>">
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <p><a href="admin/addfilms.php" class="btn" style="background:#4CAF50; color:white; padding:10px 20px; text-decoration:none;">Add New Film</a></p>
<?php endif; ?>