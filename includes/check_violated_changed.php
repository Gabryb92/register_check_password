<?php 
function check_violated_changed($violated){
    if($violated) {
        $_SESSION['error'] = 'La tua password è violata. Devi aggiornarla prima di continuare';
        header("Location: change.php");
        exit;
    } else {
        return False;
    }
}