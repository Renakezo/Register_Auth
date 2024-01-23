<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "authreg");
$id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($result);
?>

<form action="" method="post">
    <label for="">Сменить имя:</label>
<input name="name" value="<? echo $user['name']; ?>">
<input type="submit" name="submit">
</form>

<?php
if (!empty($_POST['submit'])) {
$name = $_POST['name'];
$query = "UPDATE users SET name='$name' WHERE id=$id";
mysqli_query($link, $query);
}
?>

<a href="changePassword.php">Сменить пароль</a>
<a href="delete.php">Удалить аккаунт</a>
<a href="sessionAuth.php">Вернуться</a>
