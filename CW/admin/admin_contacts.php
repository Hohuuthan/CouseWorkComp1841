<?php
include '../includes/DatabaseConnection.php';
include '../includes/DataBaseFunction.php';
include '../includes/session.php';

try {
    $contacts = $pdo->query("
        SELECT 
            c.id, 
            c.content,
            u.username
        FROM contact c
        LEFT JOIN user u ON c.user_id = u.id
        ORDER BY c.id DESC
    ")->fetchAll(PDO::FETCH_ASSOC);

    $title = 'Contact Messages';

    ob_start();
    ?>
    <h2>Contact Messages</h2>

    <?php if (empty($contacts)): ?>
        <p>No messages yet.</p>
    <?php else: ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($contacts as $msg): ?>
                <li style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                    <strong>From:</strong> <?= htmlspecialchars($msg['username'] ?? 'Unknown User') ?><br>
                    <strong>Content:</strong><br>
                    <?= nl2br(htmlspecialchars($msg['content'])) ?>

                    <form action="deletecontact.php" method="post" style="display: inline; margin-left: 20px;" 
                          onsubmit="return confirm('Are you sure you want to delete this message?');">
                        <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                        <button type="submit" 
                                style="background: #f44336; color: white; border: none; padding: 6px 12px; 
                                       cursor: pointer; border-radius: 4px; font-size: 0.9em;">
                            Delete
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . htmlspecialchars($e->getMessage());
}

include '../templates/layout.html.php';
?>