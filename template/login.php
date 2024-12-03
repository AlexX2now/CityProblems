<?php 

require_once 'connect.php';

$login = $_POST['Login'];
$password = $_POST['Password'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `Password` = '$password'");
	$user = mysqli_fetch_assoc($check_user);
	
	if ($user != null)
	{
		if ($login == 'admin') {

    if(mysqli_num_rows($check_user) > 0){
        
        
        Header("refresh: 2; url=adminpanel.php?log=$login");  
    }
}
else{

    if(mysqli_num_rows($check_user) > 0){
        
        Header("refresh: 2; url=autindex.php?log=$login");  
    }
}
	}
	else
	{
		Header("refresh: 2; url=index.php");  
	}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Улучши свой город</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Главная</a></li>
                <li><a href="#">Зарегистрироваться</a></li>
                <li><a href="#">Войти</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        Гость
                    </a>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="jumbotron">
    <div class="container">
        <div class="alert alert-danger d-none" id="error-message"  data-mdb-animation="fade-in" role="alert">
            Произошла ошибка!
          </div>
        <h2>Подождите одно мгновение и вы будете в своем аккаунте!</h2>
</div>
</body>
</html>