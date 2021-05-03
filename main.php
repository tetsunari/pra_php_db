<?php

try {
	$pdo = new PDO(
		'mysql:host=db;dbname=myapp;charset=utf8mb4',
		'dbuser',
		'dbpass',
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		]
	);

	$pdo->query("DROP TABLE IF EXISTS posts");
	$pdo->query(
		"CREATE TABLE posts (
      id INT NOT NULL AUTO_INCREMENT,
      message VARCHAR(140), 
      likes INT,
      PRIMARY KEY (id)
    )"
	);
	$pdo->query(
		"INSERT INTO posts (message, likes) VALUES
      ('Thanks', 12), 
      ('thanks', 4),
      ('Arigato', 15)"
	);

	// $n = 10;
	$n = '10 OR 1=1';

	// $pdo->query("DELETE FROM posts WHERE likes < 10");
	// $pdo->query("DELETE FROM posts WHERE likes < $n");
	$stmt = $pdo->prepare("DELETE FROM posts WHERE likes < ?");
	$stmt->execute([$n]);

	// DELETE FROM posts WHERE likes < 10 OR 1=1
	// DELETE FROM posts WHERE likes < '10 OR 1=1'
	// DELETE FROM posts WHERE likes < 1　executeを使うことで最初の値だけ使用

	$stmt = $pdo->query("SELECT * FROM posts");
	$posts = $stmt->fetchAll();
	foreach ($posts as $post) {
		printf(
			'%s (%d)' . PHP_EOL,
			$post['message'],
			$post['likes']
		);
	}
} catch (PDOException $e) {
	echo $e->getMessage() . PHP_EOL;
	exit;
}