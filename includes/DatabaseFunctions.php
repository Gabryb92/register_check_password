<?php

include "DatabaseConnection.php";
include "check_password_violated.php";

function login($database,$email,$password){
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $database->prepare($sql);
    $values = [':email' => $email];

    $stmt->execute($values);
    $user = $stmt->fetch();
    if($user && password_verify($password,$user['password'])){
        $is_violated = check_password_violated($password);
        return ['user' => $user, 'is_violated' => $is_violated];
        
    } else {
        $error = 'Email o password errati';
        return $error;
    }
}

function register($database,$email,$password,$check_password){
    

    if(check_password_violated($password)){
        return $error = "Password violata, perfavore prova un'altra password!";
    }


    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $database->prepare($sql);

    $values = [':email' => $email,];

    $stmt->execute($values);
    $user = $stmt->fetch();
    if($user){
        return 'Utente già registrato';
    } else {
        if($check_password == $password){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)';
            $query = $database->prepare($sql);
            $values = [
                ':email' => $email,
                ':password' => $password
            ];

            $query->execute($values);

            $user = $database->prepare("SELECT * FROM `users` WHERE `email` = :email");
            $user->execute([':email' => $email]);
            $user = $user->fetch();

            return ['user' => $user , 'is_violated' => False];
        } else {
            return "Le password non coincidono";
        }
        
    }
}

function change_password($database,$password,$id){
    if(check_password_violated($password)){
        return $error = "La password è violata, perfavore riprova con un'altra password!";
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'UPDATE `users` SET `password` = :password WHERE `id_user` = :id';
    $stmt = $database->prepare($sql);
    $values = ['id' => $id,'password' => $password];
    $stmt->execute($values);

    //return $_SESSION['is_violated'] = False;
}