<?php

$servidor = "localhost";
$db = "forodb";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$db;charset=utf8mb4", $user, $pass);

    if ($conn) {
        //echo "Conexión exitosa";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>