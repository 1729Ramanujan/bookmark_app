<?php
$title = $_POST['title'];
$url = $_POST['url'];
$comments = $_POST['comments'];

try {
$pdo = new PDO('mysql:host=localhost;dbname=database_bookmark;charset=utf8', 'root', '');
} catch (PDOException $e){
    exit('DBConnectError:' . $e->getMessage());
}

$stmt = $pdo->prepare("INSERT INTO
gs_bm_table(unique_value,title,url,comments,date)
VALUES (NULL, :title,:url,:comments,now())");

$stmt->bindvalue(':title', $title, PDO::PARAM_STR);
$stmt->bindvalue(':url', $url, PDO::PARAM_STR);
$stmt->bindvalue(':comments', $comments, PDO::PARAM_STR);

$status = $stmt->execute();

if($status === false){
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . $error[2]);
} else{
    header("Location: index.php");
}