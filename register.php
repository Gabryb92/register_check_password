<?php
include __DIR__ . '/includes/DatabaseConnection.php';
include __DIR__ . '/includes/DatabaseFunctions.php';
$title = 'Register';
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check_password = $_POST['check_password'];

    $result = register($pdo, $email, $password, $check_password);

    if(is_array($result)){
        $_SESSION['user'] = $result;
        header("Location: profile.php");
        exit;
    } else {
        $error = $result;
    }
}

ob_start();
    include __DIR__ . '/templates/register.html.php';
$output = ob_get_clean();
if (isset($error))
    echo "<div class='container-sm mt-3 alert alert-danger'>$error</div>";
include __DIR__ . '/templates/layout.html.php';