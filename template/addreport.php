<?php

require_once 'connect.php';

$get = $_GET['log'];

$neededid = mysqli_query($connect, "SELECT `id user` FROM `users` WHERE `login` = '$get'");

$row = mysqli_fetch_assoc($neededid);
$id = $row['id user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $_POST['Name']; 
$description = $_POST['desc']; 
$category = $_POST['category'];
$deftype = 1;  
  
$before_photo = $_FILES['before_photo']['name']; 
$before_photo_tmp = $_FILES['before_photo']['tmp_name'];
  
$upload_dir = 'img/'; 
  
$uploadfile = $upload_dir . basename($before_photo);

if (move_uploaded_file($before_photo_tmp, $uploadfile)) {
    //1 + 8
    $insertrep = $connect->prepare("INSERT INTO `records`(`name`, `desctiption`, `IDcategory`, `imgpathBefore`, `type`, `imgpathAfter`, `IDuser`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertrep->bind_param("ssissss",$name,$description,$category,$uploadfile, $deftype,$uploadfile,$id);

    if ($insertrep->execute()) { 
        header("Location: autindex.php?log=$get");
        echo "Заявка успешно добавлена!"; 
      } else { 
        echo "Ошибка при добавлении заявки: " . $insertrep->error; 
      } 

      $insertrep->close(); 
    } else { 
      echo "Ошибка при загрузке файла before_photo"; 
    } 
  }
  
  $connect->close();