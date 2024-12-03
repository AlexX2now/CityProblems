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

    $show = $mysqli->prepare("SELECT * FROM `records`");
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

$sql = "SELECT `id records`, `time`, `name`, `IDuser`, `desctiption`, `IDcategory` as `categ`, `type` FROM `records` JOIN `categories` ON `IDcategory` = `id catagori`;";
$result = $connect->query($sql);

$allrec = mysqli_fetch_assoc($result);

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

function getCategName($db ,$categ_id)
{
		$namecateg = mysqli_query($db, "SELECT * FROM `categories` WHERE `id catagori` = $categ_id");

		$row = mysqli_fetch_assoc($namecateg);
		$categname = $row['NameOfCategori'];
		
		return $categname;
}

function getUserName($db ,$user_id)
{
	$nameszap = mysqli_query($db, "SELECT `name`, `surname`, `patr` FROM `users` WHERE `id user` = $user_id");

	$fullname = mysqli_fetch_assoc($nameszap);
	$name = $fullname['name'];
	$surname = $fullname['surname'];
	$patr = $fullname['patr'];
	$fullnametotable = $surname . " " . $name . " " . $patr;
	return $fullnametotable;
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Главная</a></li>
                <li><a href="index.php">Выйти</a></li>
                
            </ul>
        </div>
    </div>
</nav>

<div class="jumbotron">
        <div class="container">

            <h1>Все заявки</h1>
            
        <table class="table" id="issueTable">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Название и описание</th>
                    <th>Категория</th>
                    <th>Статус</th>
					<th>Пользователь</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $issue) : ?>
                    <tr data-status="<?= $issue['type'] ?>">
                        <td><?= htmlspecialchars($issue['time']) ?></td>
                        <td><?= htmlspecialchars($issue['name']) ?>: <?= $issue['desctiption'] ?></td>
                        <td><?= htmlspecialchars(getCategName($connect, $issue['categ'])) ?></td>
                        <td><?= htmlspecialchars(getStatusName($issue['type'])) ?></td>
						<td><?= htmlspecialchars(getUserName($connect, $issue['IDuser'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
</div>

<div class="jumbotron">
        <div class="container">

            <h2>Добавить категорию</h2>
            
        <form id="forma" method="post" action="addcateg.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Name">Название:</label>
                <input class="form-control in" type="text" id="Name" name="Name" placeholder="Введите название">
				<br>
				<button type="submit" id="form-sub" class="btn btn-primary">Добавить категорию</button>
            </div>

            
        </form>
</div>