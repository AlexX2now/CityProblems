<?php
require_once 'connect.php';

$query = "SELECT COUNT(*) as total FROM users;";

$result = mysqli_query($connect, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_rows = $row['total'];
}

$querysec = "SELECT COUNT(*) as total FROM records WHERE type = 2;";

$resultsec = mysqli_query($connect, $querysec);

if ($resultsec) {
    $rowsec = mysqli_fetch_assoc($resultsec);
    $total_rowssec = $rowsec['total'] - 1;
}

$sql = "SELECT * FROM `records` WHERE `type` = 2 ORDER BY `records`.`time` ASC";
$resulttr = $connect->query($sql);

$count = 0;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Улучши свой город</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Городской портал</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Главная</a></li>
                <li><a href="register.html">Зарегистрироваться</a></li>
                <li><a href="login.html">Войти</a></li>
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
        <h1>Привет, дорогой друг!</h1>
        <p>
            Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому мы
            предлагаем тебе помочь своему городу!
        </p>
        <p>
            Увидел проблему? Дай нам знать о ней и мы ее решим!
        </p>
        <p>
            <a class="btn btn-success btn-lg" href="login.html" role="button">Войти и сообщить о проблеме</a>
            <a class="btn btn-primary btn-lg" href="register.html" role="button">Присоедениться к проекту</a>
        </p>
    </div>
</div>

<div class="container">
    
</div>

<div class="container">
    <h2>Статистика</h2>
    <p>Количество пользователей на сайте: <?php echo "$total_rows"?></p>
    <p>Количество решенных проблем: <?php echo "$total_rowssec"?></p>
    <br>

    <h2>Последние решенные проблемы</h2>
    <br>
    <div class="row">
    <?php foreach ($resulttr as $issue) : 
        if ($count < 9) {?>
    <div class="col-md-3" id="solvedIssues">
        <div class="сol-4 border issdiv">
            <h3 class="p-5 text-center text-break">Название: <?= htmlspecialchars($issue['name']) ?></h3>
            <p class="text-break text-center">Описание: <?= htmlspecialchars($issue['desctiption'])?></p>
            <p class="text-break text-center">Дата: <?= htmlspecialchars($issue['time'])?></p>
            <img src="<?= $issue['imgpathAfter']?>" class="imaga" alt="Описание"></img>
        </div>
    </div>
    <?php }
        endforeach; ?>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/scriptmain.js"></script>
</body>
</html>
