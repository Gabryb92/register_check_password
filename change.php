<?php

include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';
include __DIR__ . '/includes/check_violated_changed.php';
session_start();

$title = 'Cambia Password';



if(isset($_SESSION['error'])){
    $error = $_SESSION['error']; 
    unset($_SESSION['error']);
}

if(isset($_SESSION['user'])){
    ob_start();
        include __DIR__ . '/templates/change.html.php';
    $output = ob_get_clean();

    if(isset($_POST['password'], $_POST['check_password']) && $_POST['password'] !== '' && $_POST['check_password'] !== ''){
        $password = $_POST['password'];
        $check_password = $_POST['check_password'];
        if($password === $check_password){
            $error = change_password($pdo,$password,$_SESSION['user']['id_user']);
            if($error){
                $_SESSION['error'] = $error;
                header("Location: change.php");
                exit;
            }
            $_SESSION['message'] = 'Password cambiata correttamente!';
            $_SESSION['is_violated'] = False;
            header("Location: profile.php");
            exit;
        } else {
            $_SESSION['error'] = 'Le password non sono uguali';
            $_SESSION['error'] = $error;

            header("Location: change.php");
            exit;
        }
        
    }
} else {
    
    header('Location: index.php');
}

include __DIR__ . '/templates/layout.html.php';