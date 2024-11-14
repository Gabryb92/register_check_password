<?php

include "DatabaseConnection.php";

function login($database,$email,$password){
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $database->prepare($sql);
    $values = [':email' => $email];

    $stmt->execute($values);
    $user = $stmt->fetch();
    if($user && password_verify($password,$user['password'])){
        
        return $user;
    } else {
        $error = 'Email o password errati';
        return $error;
    }
}

function register($database,$email,$password,$check_password){
    //Check password se non è stata violata:

    //Sha-1 password
    $sha_1 = sha1($password);

    //Api i have been pwned
    $api = 'https://api.pwnedpasswords.com/range/';

    //Concateno url

    $first_part = strtoupper(substr($sha_1, 0, 5));
    $second_part = strtoupper(substr($sha_1, 5));

    $url = $api . $first_part;


    $response = file_get_contents($url);

    

    if(str_contains($response, $second_part)){
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

            return $user;
        } else {
            return "Le password non coincidono";
        }
        
    }
}