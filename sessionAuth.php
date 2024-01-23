<?php
session_start();

if (empty($_SESSION['auth'])) {
    echo 'Пользователь не авторизирован';
} else {
    echo 'Пользователь авторизирован<br>';
    echo '<a href="account.php">Личный кабинет</a><br>';
    echo '<a href="logout.php">Выйти</a>';
}

?>

<form action="" method="post">
<input name="login" placeholder="Логин">
<input name="password" type="password" placeholder="Пароль">
<input type="submit">
</form>
<a href="register.php">Регистрация</a>

<?php
if (!empty($_POST['password']) && !empty($_POST['login'])) {
    $link = mysqli_connect("localhost", "root", "", "authreg");
$login = $_POST['login'];
$query = "SELECT users.*, role.name as status FROM users LEFT JOIN role ON users.status_id=role.id WHERE login='$login'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);

if (!empty($user)) {
$hash = $user['password'];
        if (password_verify($_POST['password'], $hash)) {
    $_SESSION['auth'] = true;
    $_SESSION['status'] = $user['status'];
    $_SESSION['id'] = $user['id'];
    echo "<meta http-equiv='refresh' content='0'>";
    } else {
    echo 'Неправильный пароль!';
    }
} else {
    echo 'Пользователя с таким логином нет';
}
}
?>