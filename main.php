<?php

try {
	$pdo = new PDO(
		'mysql:host=db;dbname=myapp;charset=utf8mb4',
		'dbuser',
		'dbpass',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]
	);

	$stmt = $pdo->query("SELCT 5 + 3");
	var_dump($stmt->fetch());
} catch (PDOException $e) {
	echo $e->getMessage() . PHP_EOL;
	exit;
}