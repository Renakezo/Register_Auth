<form action="" method="post">
<input name="login" placeholder="Логин">
<input name="password" type="password" placeholder="Пароль">
<input type="password" name="confirm" placeholder="Повторите пароль">
<input type="submit">
</form>

<a href="sessionAuth.php">Вернуться</a>

<?php
session_start();

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {
    $link = mysqli_connect("localhost", "root", "", "authreg");

    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password == $confirm) {
        $login = $_POST['login'];
        $query = "SELECT * FROM users WHERE login='$login'";
        $user = mysqli_fetch_assoc(mysqli_query($link, $query));
        if (empty($user)) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO users SET login='$login', password='$password', status_id='1'";
            mysqli_query($link, $query);
            $_SESSION['auth'] = true;
            $id = mysqli_insert_id($link);
            $_SESSION['id'] = $id;
            echo 'Успешно!';
        } else {
        echo 'Логин занят';
        }
    } else {
        echo 'Пароли не совпадают';
    }
    }

?>