<?php

$login = $_GET['log'];

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
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Городской портал</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">Главная</a></li>
                <li><a href="register.html">Зарегистрироваться</a></li>
                <li class="active"><a href="login.html">Войти</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        Гость
                    </a>
                    <!--                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="list.html">Мои заявки</a></li>
                            <li><a href="new.html">Новая заявка</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Выход</a></li>-->
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="jumbotron">
    <div class="container">
    <div class="alert alert-danger" id="error-message"  data-mdb-animation="fade-in" role="alert">
            Неверный логин или пароль!
          </div>
        <h2>Вход на портале городских услуг</h2>
        <form id="forma" action="login.php" method="post">
        <div class="form-group">
            <label for="Login">Логин:</label>
            <input class="form-control in" type="text" id="Login" name="Login" content="<?php echo $login;?>" placeholder="Введите логин">
        </div><div class="form-group">
            <label for="Password">Пароль:</label>
            <input class="form-control in" type="text" id="Password" name="Password" placeholder="Введите пароль">
        </div>
        <button type="submit" id="form-sub" class="btn btn-primary">Войти</button>
    </div>
</form>
</div>
<script src="js/scriptaut.js"></script>
</body>
</html>