<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Salvare i dati dell'utente nel file txt
    $userData = "$username:$password\n";
    file_put_contents('utenti.txt', $userData, FILE_APPEND);

    // Reindirizza l'utente a una pagina di login
    header('Location: login.php');
    exit();
}
?>
