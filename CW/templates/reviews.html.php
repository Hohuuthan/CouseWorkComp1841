<?php
$imagePath = 'image/';
?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <p><strong><?= htmlspecialchars($reviewCount ?? 0) ?> reviews have been submitted to the Internet Review Database</strong></p>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background: #443A5C; color: white;">
            <th>ID</th>
            <th>Review</th>
            <th>Film</th>
            <th>Posted By</th>
            <th>Date</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?= htmlspecialchars($review['id'] ?? '') ?></td>
            <td style="max-width: 400px;"><?= htmlspecialchars($review['reviewtext'] ?? '') ?></td>
            <td><?= htmlspecialchars($review['film_title'] ?? 'Unknown film') ?></td>
            <td><?= htmlspecialchars($review['username'] ?? 'Anonymous') ?></td>
            <td><?= date('d/m/Y', strtotime($review['reviewdate'] ?? 'now')) ?></td>
            <td>
                <?php if (!empty($review['image'])): ?>
                    <img src="<?= $imagePath . htmlspecialchars($review['image']) ?>" 
                         alt="review image" style="max-width: 120px; display: block;">
                <?php else: ?>
                    <em>No image</em>
                <?php endif; ?>
            </td>
            <td style="white-space: nowrap; display: flex; gap: 8px; align-items: center;">
                <?php 
                $isLoggedIn = isset($_SESSION['user_id']);
                $isOwner    = $isLoggedIn && isset($review['user_id']) && ($review['user_id'] == $_SESSION['user_id']);
                $isAdmin    = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
                ?>

                <?php if ($isAdmin || $isOwner): ?>
                    <a href="admin/editreview.php?id=<?= urlencode($review['id']) ?>" class="btn btn-edit">Edit</a>
                <?php endif; ?>

                <?php if ($isAdmin): ?>
                    <form action="admin/deletereview.php" method="post" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($review['id']) ?>">
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                <?php endif; ?>

                <?php if (!$isLoggedIn): ?>
                    <span style="color: #888; font-size: 0.9em;">Login to edit</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>