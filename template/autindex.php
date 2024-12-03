<?php
require_once 'connect.php';

$get = $_GET['log'];

$names = mysqli_query($connect, "SELECT `surname`, `name` FROM `users` WHERE `login` = '$get'");

$row = mysqli_fetch_assoc($names);
$surname = $row['surname'];
$name = $row['name'];

$queryforuser = "SELECT COUNT(*) as total FROM users;";

$resultuser = mysqli_query($connect, $queryforuser);

if ($resultuser) {
    $row = mysqli_fetch_assoc($resultuser);
    $total_rows = $row['total'];  
}

$querysec = "SELECT COUNT(*) as total FROM records WHERE type = 2;";

$resultsec = mysqli_query($connect, $querysec);

if ($resultsec) {
    $rowsec = mysqli_fetch_assoc($resultsec);
    $total_rowssec = $rowsec['total'] - 1;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Улучши свой город</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
    <div class="navbar-header">
            <a class="navbar-brand" href="#">Городской портал</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Главная</a></li>
                <!--<li><a href="register.html">Зарегистрироваться</a></li>
                <li><a href="login.html">Войти</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                       <?php
                        echo "$name $surname";
                        ?>
                    </a>
                    
                    <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="list.php<?php echo "?log=$get";?>">Мои заявки</a></li>
                            <li><a href="new.php<?php echo "?log=$get";?>">Новая заявка</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="index.php">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="jumbotron">
    <div class="container">
        <h1>Привет, дорогой друг!</h1>
        <p>
            Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому мы
            предлагаем тебе помочь своему городу!
        </p>
        <p>
            Увидел проблему? Дай нам знать о ней и мы ее решим!
        </p>
        <p>
            <a class="btn btn-success btn-lg" href="new.php<?php echo "?log=$get";?>" role="button">Сообщить о проблеме</a>
     </p>
    </div>
</div>

<div class="container">
    <h2>Статистика</h2>
    <p>Количество пользователей на сайте: <?php echo "$total_rows" ?></p>
    <p>Количество решенных проблем: <?php echo "$total_rowssec"?></p>
    <br>

    <h2>Последние решенные проблемы</h2>
    <br>
    <div class="row" id="solvedIssues">
        
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/scriptmain.js"></script>
</body>
</html>
