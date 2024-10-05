<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);
    
    // Validation
    if (!empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $message]);
    }
}

// Récupération des messages
$messages = $pdo->query("SELECT m.id, m.message, m.created_at, u.username FROM messages m JOIN users u ON m.user_id = u.id ORDER BY m.created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'Or</title>
</head>
<body>
    <h2>Livre d'Or</h2>
    <p>Bienvenue, <?php echo $_SESSION['username']; ?> <a href="logout.php">Déconnexion</a></p>
    
    <form method="POST">
        <textarea name="message" placeholder="Votre message" required></textarea>
        <button type="submit">Soumettre</button>
    </form>

    <h3>Messages</h3>
    <?php foreach ($messages as $msg): ?>
        <div>
            <strong><?php echo htmlspecialchars($msg['username']); ?>:</strong>
            <p><?php echo htmlspecialchars($msg['message']); ?></p>
            <small><?php echo $msg['created_at']; ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
