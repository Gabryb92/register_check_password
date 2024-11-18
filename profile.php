<?php

include __DIR__ . '/includes/check_violated_changed.php';

$title = 'Profilo';

session_start();

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location index.php");
};

if(isset($_SESSION['user'])){
    check_violated_changed($_SESSION['is_violated']);
    ob_start();
        include __DIR__ . '/templates/profile.html.php';
    $output = ob_get_clean();


} else {
    header("Location: index.php");
}

include __DIR__ . '/templates/layout.html.php';
