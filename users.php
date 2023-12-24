<?php
require_once __DIR__.'/boot.php';

$users = null;
if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    // $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    // $stmt->execute(['id' => $_SESSION['user_id']]);
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $stmt = pdo()->prepare("SELECT * FROM `users`");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<a href="index.php">Home</a>
<?php
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Role</th><th>Subscriptions</th></tr>";
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
    echo "<td>" . htmlspecialchars($user['role']) . "</td>";
    echo "<td>" . htmlspecialchars($user['subscriptions']) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>