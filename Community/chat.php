<?php
session_start();

// Verifica se l'utente è autenticato, altrimenti reindirizza alla pagina di login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Funzione per caricare e visualizzare i messaggi dalla chat
function displayChatMessages() {
    if (file_exists('chat.txt')) {
        $messages = file('chat.txt');
        foreach ($messages as $message) {
            list($sender, $text) = explode(':', $message);
            echo "<strong>$sender:</strong> $text<br>";
        }
    }
}

// Gestisci l'invio di nuovi messaggi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $message = htmlspecialchars($message); // Evita l'iniezione di script
    $message = "$username:$message\n";

    // Aggiungi il messaggio al file della chat
    file_put_contents('chat.txt', $message, FILE_APPEND);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
</head>
<body>
    <h1>Benvenuto nella chat, <?php echo $username; ?>!</h1>
    
    <!-- Pannello di chat -->
    <div id="chat">
        <?php displayChatMessages(); ?>
    </div>
    
    <!-- Form per inviare un messaggio -->
    <form method="post" action="chat.php">
        <input type="text" name="message" placeholder="Scrivi un messaggio..." required>
        <input type="submit" value="Invia">
    </form>
    
    <!-- Link per effettuare il logout -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
