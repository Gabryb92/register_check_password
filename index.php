<?php

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';


$title = 'Test Login';
session_start();

if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if(isset($_SESSION['user'])){
    header('Location: profile.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $result = login($pdo, $email, $password,);
    
    
    if(is_array($result)){
        $_SESSION['user'] = $result['user'];
        $_SESSION['is_violated'] = $result['is_violated'];
        
        if($_SESSION['is_violated']) {
            $_SESSION['error'] = 'La tua password è stata violata. Per favore cambiala.';
            header('Location: change.php');
            exit;
        } else{

            header("Location: profile.php");
            exit;
        }
    } else {
        $error = $result;
    }
}

ob_start();
    include __DIR__ . '/templates/login.html.php';
$output = ob_get_clean();

include __DIR__ . '/templates/layout.html.php';
