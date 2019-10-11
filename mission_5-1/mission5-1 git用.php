<?php
$namae = $_POST[ 'name' ];
$comments = $_POST[ 'comment' ];
$edit = $_POST[ 'edit_number' ];
$editcomment = $_POST[ 'edit_comment'];
$delete = $_POST[ 'delete_number'];
$dsn = 'mysql:dbname=*************;host=localhost';
	$user = '***********';
	$password = '***********';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//データベース作成
$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);
//データ挿入
$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = $namae;
	$comment = $comments;
	$sql -> execute();
//データ編集
$id = $edit;
	$comment = $edit_comment;
	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
//データ削除
$id = $delete;
	$sql = 'delete from tbtest where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
//データ表示
$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}

?>