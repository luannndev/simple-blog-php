<?php
global $pdo;
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $user_id]);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<h1>Neuen Beitrag erstellen</h1>
<form method="POST">
    <input type="text" name="title" placeholder="Titel" required>
    <textarea name="content" placeholder="Inhalt" required></textarea>
    <button type="submit">Beitrag erstellen</button>
</form>
<p><a href="index.php">Zurück zur Startseite</a></p>
</body>
</html>
