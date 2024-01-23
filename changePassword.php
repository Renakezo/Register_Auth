<form action="" method="post">
<input type="password" name="old_password" placeholder="Старый пароль">
<input type="password" name="new_password" placeholder="Норвый пароль">
<input type="password" name="new_password_confirm" placeholder="Повторите новый пароль">
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
if (!empty($_POST['old_password']) && $_POST['new_password'] && $_POST['new_password_confirm']) {
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];
$new_password_confirm = $_POST['new_password_confirm'];
if (password_verify($oldPassword, $hash)) {
    if ($newPassword == $new_password_confirm) {
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password='$newPasswordHash' WHERE id='$id'";
    mysqli_query($link, $query);
    }
    else {
        echo 'Пароли не совпадают';
    }
    } else {
        echo 'Неправильный старый пароль';
    }
}
?>

<a href="sessionAuth.php">Вернуться</a>