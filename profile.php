<?php
$title = 'Profilo';

session_start();

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location index.php");
};

if(isset($_SESSION['user'])){
    $output =
        "<h2>Utente loggato</h2>
        <form method='POST'>
            <button name='logout' class='btn btn-danger'>Logout</button>
        </form>";
} else {
    header("Location: index.php");
}

include __DIR__ . '/templates/layout.html.php';
