тут контент для пользователя
<h1>Welcome back, <?=htmlspecialchars($user['username'])?>! You are User</h1>

здесь инфа только для User

<form class="mt-5" method="post" action="do_logout.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
