<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Leggi i dati degli utenti dal file txt
    $utenti = file('utenti.txt', FILE_IGNORE_NEW_LINES);

    foreach ($utenti as $utente) {
        list($storedUsername, $storedPassword) = explode(':', $utente);
        if ($username === $storedUsername && password_verify($password, $storedPassword)) {
            // Accesso riuscito: reindirizza l'utente a chat.php
            session_start();
            $_SESSION['username'] = $username;
            header('Location: chat.php');
            exit();
        }
    }

    // Nome utente o password errati: mostra un messaggio di errore
    echo "Nome utente o password errati!";
}
?>
