<?php 

function check_password_violated($password){
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
        return True;
    } else {
        return False;
    }
}