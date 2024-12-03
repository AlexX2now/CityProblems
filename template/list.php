<?php
require_once 'connect.php';

$get = $_GET['log'];

$names = mysqli_query($connect, "SELECT `surname`, `name` FROM `users` WHERE `login` = '$get'");

$neededid = mysqli_query($connect, "SELECT `id user` FROM `users` WHERE `login` = '$get'");

$row = mysqli_fetch_assoc($neededid);
$id = $row['id user'];

$row = mysqli_fetch_assoc($names);
$surname = $row['surname'];
$name = $row['name'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_issue'])) {
    $issue_id = $_POST['delete_issue'];

    $show = $mysqli->prepare("SELECT `id records`, `type` FROM `records` WHERE application_id = ? AND user_id = ? AND `type` = 1");
    $show->bind_param("ii", $issue_id, $id);
    $show->execute();
    $result = $show->get_result();

    if ($result->num_rows === 1) {
        $delete_stmt = $connect->prepare("DELETE FROM `records` WHERE `id records` = ?");
        $delete_stmt->bind_param("i", $issue_id);
        if ($delete_stmt->execute()) {
            echo "<script>alert('Заявка успешно удалена');</script>";
        } else {
            echo "<script>alert('Ошибка при удалении заявки');</script>";
        }
        $delete_stmt->close();
    } else {
        echo "<script>alert('Невозможно удалить эту заявку');</script>";
    }

    $show->close();
}

$sql = "SELECT `id records`, `time`, `name`, `desctiption`, `IDcategory` as `categ`, `type` FROM `records` JOIN `categories` ON `IDcategory` = `id catagori` WHERE `IDuser` = $id;";
$result = $connect->query($sql);

$row = mysqli_fetch_assoc($result);



$issues = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $issues[] = $row;
    }
}

function getStatusName($status_id)
{
    switch ($status_id) {
        case 1:
            return "На рассмотрении";
        case 2:
            return "Решена";
        case 3:
            return "Отклонена";
    }
}

$connect->close();
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
            <a class="navbar-brand" href="#">Городской портал <? echo "$row[0]";?></a>
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
                            <li>Мои заявки</a></li>
                            <li><a href="list.php<?php echo "?log=$get";?>">Новая заявка</a></li>
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

            <h1>Мои заявки</h1>
            
            <form id="filterForm">
            <label for="status_filter">Фильтр по статусу:</label>
            <select name="status_filter" id="status_filter">
                <option value="">Все</option>
                <option value="1">На рассмотрении</option>
                <option value="2">Решена</option>
                <option value="3">Отклонена</option>
            </select>
            <button type="submit">Применить</button>
        </form>
        <br>
        <table class="table" id="issueTable">
            <thead>
                <tr>
                    <th>Временная ветка</th>
                    <th>Название с описанием</th>
                    <th>Категория заявки</th>
                    <th>Статус заявки</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($issue = $result->fetch_assoc()) { ?>
                    <tr data-status="<?= $issue["type"] ?>">
                        <td><?= $issue["time"] ?></td>
                        <td><?= $issue["name"] ?>: <?= $issue["desctiption"] ?></td>
                        <td><?= $issue["categ"] ?></td>
                        <td><?= getStatusName($issue["type"]) ?></td>
                        <td>
                            <?php if ($issue["type"] == 1) { ?>
                                <form method="post">
                                    <input type="hidden" name="delete_issue" value="<?= $issue["id records"] ?>">
                                    <button class="btn btn-primary" type="submit" onclick="return confirm('Удалить заявку?')">Удалить</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/scriptmain.js"></script>
<script src="js/scriptshow.js"></script>
</body>
</html>