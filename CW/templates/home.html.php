<?php
$imagePath = 'image/';
?>
<!-- HERO BANNER -->
<div style="background: linear-gradient(rgba(10,10,10,0.9), rgba(10,10,10,0.95)), url('<?= $imagePath . htmlspecialchars($films[0]['image'] ?? '') ?>'); 
            background-size: cover; background-position: center; height: 520px; 
            display: flex; align-items: center; color: white;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 30px; width: 100%;">
        <h1 style="font-size: 3.5rem; margin-bottom: 20px; text-shadow: 0 4px 20px rgba(0,0,0,0.9);">🎬 Movie Films Reviews</h1>
        <p style="font-size: 1.5rem; max-width: 650px; margin-bottom: 35px;">Discover great movies • Read real reviews • Share your thoughts</p>
        <a href="films.php" style="background: #ff6600; color: #000; padding: 18px 45px; font-size: 1.4rem; font-weight: bold; border-radius: 50px; text-decoration: none;">Browse All Movies →</a>
        
    </div>
</div>

<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <h2 style="color: #ff6600; font-size: 2rem;">📌 Featured Movies</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <?php foreach ($films as $film): ?>
            <div class="movie-card" style="background: #111; border-radius: 12px; width: 230px; overflow: hidden;">
                <?php if (!empty($film['image'])): ?>
                    <img src="<?= $imagePath . htmlspecialchars($film['image']) ?>" 
                         alt="<?= htmlspecialchars($film['title']) ?>" 
                         style="width: 100%; height: 320px; object-fit: cover;">
                <?php else: ?>
                    <div style="height: 320px; background: #222; display: flex; align-items: center; justify-content: center; color: #666;">No Poster</div>
                <?php endif; ?>
                <div style="padding: 18px;">
                    <h3><?= htmlspecialchars($film['title']) ?></h3>
                    <p style="color: #ccc;"><?= htmlspecialchars($film['genre'] ?? 'No genre') ?> • <?= htmlspecialchars($film['release_year'] ?? 'N/A') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>