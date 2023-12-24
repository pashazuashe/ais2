<?php
require_once __DIR__.'/boot.php';
// Проверяем, передан ли ID пользователя в URL
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Выполняем SQL-запрос для получения данных о пользователе с указанным ID
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <a href="index.php">Home</a>
    <?php
    
    // Проверяем, найден ли пользователь с указанным ID
    if ($user) {
        // Выводим информацию о пользователе
        echo "<h1>Профиль пользователя</h1>";
        echo "<p><strong>ID:</strong> " . htmlspecialchars($user['id']) . "</p>";
        echo "<p><strong>Имя пользователя:</strong> " . htmlspecialchars($user['username']) . "</p>";
        echo "<p><strong>Роль:</strong> " . htmlspecialchars($user['role']) . "</p>";
        echo "<p><strong>Подписки:</strong> " . htmlspecialchars($user['subscriptions']) . "</p>";
    } else {
        echo "Пользователь с указанным ID не найден.";
    }
} else {
    echo "Не указан ID пользователя.";
}

?>