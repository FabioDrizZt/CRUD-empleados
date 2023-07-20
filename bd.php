<?php

$servidor="localhost"; // 127.0.0.1
$dbname="app";
$user="root";
$password=getenv('MYSQL_SECURE_PASSWORD');

try {
  $conexion = new PDO("mysql:host=$servidor;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
}
