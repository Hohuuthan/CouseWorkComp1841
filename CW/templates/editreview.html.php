<?php $imagePath = '../image/'; ?>

<div style="display: flex; gap: 30px; margin: 20px 0; align-items: flex-start;">
    <!-- Hình phim bên trái -->
    <div style="flex: 0 0 220px; text-align: center;">
        <?php
        $image_file = $review['film_image'] ?? '';
        $src = $imagePath . htmlspecialchars($image_file, ENT_QUOTES, 'UTF-8');
        ?>

        <?php if ($image_file): ?>
            <img src="<?= $src ?>"
                 alt="Poster của <?= htmlspecialchars($review['film_title'] ?? 'Film') ?>"
                 style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);"
                 onerror="this.src='https://via.placeholder.com/220x330?text=Image+Not+Found';">
        <?php else: ?>
            <div style="width: 220px; height: 330px; background: #333; color: #aaa; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1.1em;">Không có ảnh</div>
        <?php endif; ?>
    </div>

    <!-- Thông tin bên phải -->
    <div style="flex: 1;">
        <h3><?= htmlspecialchars($review['film_title'] ?? 'Unknown Film') ?></h3>
        <p style="color: #000; margin: 10px 0;">
            Posted by: <strong><?= htmlspecialchars($review['username'] ?? 'Unknown User') ?></strong><br>
            Date: <?= htmlspecialchars($review['reviewdate'] ?? 'N/A') ?>
        </p>

        <form action="" method="post">
            <input type="hidden" name="reviewid" value="<?= htmlspecialchars($review['id'], ENT_QUOTES, 'UTF-8') ?>">

            <label for="reviewtext" style="display: block; margin: 15px 0 8px; font-weight: bold;">Edit your review here:</label>
            <textarea name="reviewtext" id="reviewtext" rows="8" cols="60" style="width: 100%; max-width: 700px; padding: 10px;">
<?= htmlspecialchars($review['reviewtext'], ENT_QUOTES, 'UTF-8') ?>
            </textarea><br><br>

            <input type="submit" value="Save" style="padding: 10px 24px; background: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer;">
        </form>
    </div>
</div>