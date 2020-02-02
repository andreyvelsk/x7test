<?php
session_start(); 
require_once "dbconnect.php";
$username    = "";
$errors = array(); 

// РЕГИСТРАЦИЯ
if (isset($_POST['add_comment'])) {
    $username = htmlspecialchars($_POST['username']);
    $comment = htmlspecialchars($_POST['comment']);

    // сбор ошибок в массив
    if (empty($username)) { array_push($errors, "Введите имя"); }
    if (empty($comment)) { array_push($errors, "Введите комментарий"); }
    if (!isset($_SESSION['username'])) { array_push($errors, "Вы не авторизированы"); }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $sql = "INSERT INTO comment VALUES (default, :idpost, :commentuser, :commenttext, default)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindValue(':idpost', $postid);
            $stmt->bindValue(':commentuser', $username);
            $stmt->bindValue(':commenttext', $comment);
            if($stmt->execute()) {
                header('location: /post.php?id=' . $postid);
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                array_push($errors, "Не удалось добавить комментарий");
            }
        }
    }
}