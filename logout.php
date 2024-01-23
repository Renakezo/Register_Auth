<?php

session_start();
$_SESSION['auth'] = null;
$_SESSION['id'] = null;
$_SESSION['status'] = 'user';
header('Location: sessionAuth.php');

?>