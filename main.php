<?php

class Post
{
	// public $id;
	// public $message;
	// public $likes;
	//抽出したデータをそれぞれのプロパティにセットして結果を返してくれる
	//全て public の場合、自動的にカラム名のプロパティが作られるので、実はこちらは書かなくても OK
	//もし private にしたい場合などは書く

	public function show()
	{
		echo "$this->message ($this->likes)" . PHP_EOL;
	}
}

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

	$stmt = $pdo->query("SELECT * FROM posts");
	$posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'Post'); //fetchAll() するときにこちらで PDO::FETCH_CLASS としてあげて、どのクラスでデータを引っ張ってきたいかクラス名をそのあとに渡してあげます
	foreach ($posts as $post) {
		$post->show();
	}
} catch (PDOException $e) {
	echo $e->getMessage() . PHP_EOL;
	exit;
}