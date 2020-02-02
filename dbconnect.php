<?php
$username = "root";
$password = "";

set_time_limit(0);
// Create connection

try {
    $conn = new PDO('mysql:host=localhost;dbname=testx7;charset=UTF8', $username, $password);
}
catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

?>
