<?php
global $pdo;
require 'db.php';
session_start();

$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Mein Blog</title>
</head>
<body>
<header>
    <h1>Willkommen zu meinem Blog!</h1>
    <nav>
        <a href="login.php">Login</a>
        <a href="register.php">Registrieren</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <h2>Beiträge</h2>
    <?php if (empty($posts)): ?>
        <p>Es gibt noch keine Beiträge.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($posts as $post): ?>
                <li>
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <small>Von <?php echo htmlspecialchars($post['username']); ?> am <?php echo $post['created_at']; ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Mein Blog</p>
</footer>
</body>
</html>
