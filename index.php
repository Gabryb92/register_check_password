<?php

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';


$title = 'Test Login';
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $result = login($pdo, $email, $password,);

    if(is_array($result)){
        $_SESSION['user'] = $result;
        header("Location: profile.php");
        exit;
    } else {
        $error = $result;
    }
}

ob_start();
    include __DIR__ . '/templates/login.html.php';
$output = ob_get_clean();
if (isset($error))
    echo "<div class='container alert alert-danger mt-2'>$error</div>";
include __DIR__ . '/templates/layout.html.php';
