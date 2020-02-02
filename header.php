<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
require_once "dbconnect.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:600|Playfair+Display:700|Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
</head>
<body>
<!-- logged in user information -->
<div class="wrapper">
<nav class="top-navbar">
    <div class="container">
        <div class="row mainnavbar">
            <div class="mainnavbar-logo col-2">
                <a class="menu-item" href="/">Logo</a></li>
            </div>
            <div class="col-10">
                <ul class="mainnavbar-menu">
                <?php  
                    if (isset($_SESSION['username'])) { ?>
                        <li class="menu-item"><a><?php echo $_SESSION['username']; ?></a></li>
                        <li> <a href="index.php?logout='1'">Выход</a> </li>
                <?php 
                }
                else {
                    ?>
                    <li class="menu-item"><a href="/login.php">Вход</a></li>   
                    <li class="menu-item"><a href="/register.php">Регистрация</a></li>   
                    <?php
                }                
                ?>
                </ul>
            </div>
        </div>
    </div>
</nav>