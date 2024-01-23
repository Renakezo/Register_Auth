<form action="" method="post">
<input type="password" name="password">
<input type="submit" name="submit">
</form>

<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "authreg");
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);
$hash = $user['password'];
if (!empty($_POST['password'])) {
    if (password_verify($_POST['password'], $hash)) {
        $query = "DELETE FROM users WHERE id='$id'";
        mysqli_query($link, $query);
        $_SESSION['auth'] = null;
        $_SESSION['id'] = null;
        } else {
            echo 'Неправильный пароль!';
        }
}
?>

<a href="sessionAuth.php">Вернуться</a>