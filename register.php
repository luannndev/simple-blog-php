<?php
global $pdo;
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header('Location: index.php');
        exit();
    } else {
        echo "Fehler bei der Registrierung.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
</head>
<body>
<h1>Registrieren</h1>
<form method="POST">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="password" name="password" placeholder="Passwort" required>
    <button type="submit">Registrieren</button>
</form>
<p>Bereits registriert? <a href="login.php">Login</a></p>
</body>
</html>
