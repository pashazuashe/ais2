<?php
require_once __DIR__.'/boot.php';

$user = null;
$role = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $role = $user['role'];
}
?>
<?php if ($role == 'user') {?>
    <h1>Welcome back, <?=htmlspecialchars($user['username'])?>! You are User</h1>
    <ul>
        <li><a href="news.php">News</a></li>
        <?php echo `<li><a href="subscriptions.php">Subscriptions</a></li>`;?>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="subscriptions.php">Subscriptions</a></li>
    </ul>

    <form class="mt-5" method="post" action="do_logout.php">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>

<?php } else if ($role == 'admin') { ?>
    <h1>Welcome back, <?=htmlspecialchars($user['username'])?>! You are Admin</h1>

    <ul>
        <li><a href="users.php">Users</a></li>
        <li><a href="statistic.php">Statistic</a></li>
    </ul>

    <form class="mt-5" method="post" action="do_logout.php">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
<?php } else if ($role == 'moderator') { ?>
    <h1>Welcome back, <?=htmlspecialchars($user['username'])?>! You are Moderator</h1>

    <ul>
        <li><a href="users.php">Users</a></li>
        <li><a href="requests.php">Requests</a></li>
    </ul>

    <form class="mt-5" method="post" action="do_logout.php">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
<?php }else { ?>

    <h1 class="mb-5">Registration</h1>

    <?php flash(); ?>

    <form method="post" action="do_register.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a class="btn btn-outline-primary" href="login.php">Login</a>
    </form>
<?php } ?>
