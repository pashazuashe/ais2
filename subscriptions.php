<?php
require_once __DIR__.'/boot.php';

$user = null;
$role = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = pdo()->prepare("SELECT `subscriptions` FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $subscriptions = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
<a href="index.php">Home</a>
<?php echo "<ul>";
foreach ($subscriptions as $subscription) {
    $subscriptionArray = explode("\n", $subscription);
    foreach ($subscriptionArray as $sub) {
        echo "<li>" . htmlspecialchars($sub) . "</li>";
    }
}
echo "</ul>";
?>