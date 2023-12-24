<?php
require_once __DIR__.'/boot.php';

$user = null;
$news = null;
if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    // $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    // $stmt->execute(['id' => $_SESSION['user_id']]);
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $stmt = pdo()->prepare("SELECT `id`, `header`, `body`, `author` FROM `news`");
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<a href="index.php">Home</a>
<?php

foreach ($news as $item) {
    echo "<h2>" . htmlspecialchars($item['header']) . "</h2>";
    echo "<p>" . htmlspecialchars($item['body']) . "</p>";
    echo "<p>Author: " . htmlspecialchars($item['author']) . "</p>";
    echo "<hr>";
}
?>