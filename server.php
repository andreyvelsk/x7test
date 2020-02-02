<?php
session_start();
require_once "dbconnect.php";

$email    = "";
$errors = array(); 

// РЕГИСТРАЦИЯ
if (isset($_POST['reg_user'])) {
    $email = htmlspecialchars($_POST['email']);
    $password_1 = htmlspecialchars($_POST['password1']);
    $password_2 = htmlspecialchars($_POST['password2']);

    // сбор ошибок в массив
    if (empty($email)) { array_push($errors, "Введите Email"); }
    if (empty($password_1)) { array_push($errors, "Введите пароль"); }
    if ($password_1 != $password_2) {
        array_push($errors, "Пароли не совпадают");
    }

    // проверка на уникальность
    $sql = "SELECT * FROM users WHERE email=:email";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row['email'] == $email) {
            array_push($errors, "Email уже существует");
        }
    }
    // если все ок, регистрация
    if (count($errors) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO users VALUES (default, :email, :pass)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':pass', $password);
            if($stmt->execute()){
                $_SESSION['username'] = $email;
                $_SESSION['success'] = "logged in";
                header('location: index.php');
            }
            else {
                array_push($errors, "Регистрация не удалась");
            }
        }
    }
}

// ЛОГИН
if (isset($_POST['login_user'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($email)) {
        array_push($errors, "Введите email");
    }
    if (empty($password)) {
        array_push($errors, "Введите пароль");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email=:email AND password=:pass";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':pass', $password);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row != null) {
                $_SESSION['username'] = $email;
                $_SESSION['success'] = "logged in";
                header('location: index.php');
            }
            else {
                array_push($errors, "Неверное имя/пароль");
            }
        }
    }
}
