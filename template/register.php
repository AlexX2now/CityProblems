<?php
require_once 'connect.php';

$full_name = $_POST['Name'];
list($name, $surname, $patr) = explode(" ", $full_name);
$login = $_POST['login'];
$email = $_POST['Email'];
$password = $_POST['Password'];

mysqli_query($connect, "INSERT INTO `users` (`id user`, `surname`, `login`, `Email`, `Password`, `name`, `patr`, `IDrole`) VALUES (NULL, '$surname', '$login', '$email', '$password', '$name', '$patr', '1')");

?>
