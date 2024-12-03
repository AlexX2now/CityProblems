<?php
require_once 'connect.php';

$get = $_GET['log'];

$names = mysqli_query($connect, "SELECT `surname`, `name` FROM `users` WHERE `login` = '$get'");

$row = mysqli_fetch_assoc($names);
$surname = $row['surname'];
$name = $row['name'];

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
                <li class="active"><a href="autindex.php<?php echo "?log=$get";?>">Главная</a></li>
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
                            <li><a href="">Новая заявка</a></li>
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
        <h2>Оставьте свою заявку</h2>
        <form id="forma" method="post" enctype="multipart/form-data" action="addreport.php<?php echo "?log=$get";?>">
            <div class="form-group">
                <label for="Name">Название:</label>
                <input class="form-control in" type="text" required id="Name" name="Name" placeholder="Введите название">
            </div>
            <div class="form-group">
                <label for="desc">Описание:</label>
                <input class="form-control in" type="text" required id="desc" name="desc" placeholder="Введите описание">
            </div>
            <div class="form-group">
                <label for="category">Категория:</label>
                <select id="category" name="category" required>
                <?php 
                    
                $sql = "SELECT `id catagori`, `NameOfCategori` FROM `categories`";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    echo "<option selected hidden disabled></option>";
        
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id catagori"] . "'>" . $row["NameOfCategori"] . "</option>";
                }
                } else {
                    echo "<option value=''>0 results</option>";
                }
                    ?>
                </select>
            </div>
            <div class="form-group">
                    <label for="before_photo">Загрузите фото:</label>
                    <input type="file" class="form-control-file" id="before_photo" name="before_photo" accept="image/*"
                        required>
                </div>
            <button type="submit" id="form-sub" class="btn btn-primary">Оставить заявку</button>
        </form>
    </div>
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/scriptzayav.js"></script>
</body>
</html>
