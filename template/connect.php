<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'pgp');
if(!$connect){
    die('Error connect to Database');
}  