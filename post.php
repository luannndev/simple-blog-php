<?php
global $pdo;
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $title, $content]);
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Create Post</title>
</head>
<body>
<form method="POST">
    <input type="text" name="title" required placeholder="Post Title">
    <textarea name="content" required placeholder="Post Content"></textarea>
    <button type="submit">Create Post</button>
</form>
</body>
</html>
