<?php

$pdo = new PDO(
  'mysql:host=db;dbname=myapp;charset=utf8mb4',
  'dbuser',
  'dbpass',
  [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]
);

$stmt = $pdo->query("SELECT 5 + 3");
$result = $stmt->fetch();
var_dump($result);