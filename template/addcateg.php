<?

require_once 'connect.php';

$name = $_POST['Name'];

if (!empty($name)){
$insertcat = $connect->prepare("INSERT INTO `categories`( `NameOfCategori`) VALUES (?)");
$insertcat->bind_param("s", $name);

$insertcat->execute();

Header("refresh: 0; url=adminpanel.php"); 
}


?>