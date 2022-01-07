<?php

$username = '';
$email = '';
$errors = false;

$emailError = '';
$emailErr = false;
$noEmail = false;

$userError = false;
$passwordError = false;
$passwordMatch = false;

$userMsg = '';
$passwordMsg = '';
$password2Msg = '';


include "dblink.php";

if(isset($_POST['register-user'])) {

    $username = mysqli_real_escape_string($link, $_POST['username']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $password_1 = mysqli_real_escape_string($link, $_POST['pswd']);
    $password_2 = mysqli_real_escape_string($link, $_POST['pswd2']);

    $username = trim($username);
    $email = trim($email);
    $password_1 = trim($password_1);
    $password_2 = trim($password2);

    if($username != $_POST['username']){
        $errors = true;
        $userError = true;
        $userMsg = "Käyttäjänimi saa sisältää vain kirjaimia ja numeroita!";
        $errorsArr['userError'] = "Käyttäjänimi saa sisältää vain kirjaimia ja numeroita!";
    }else if(empty($username)){
        $errors = true;
        $userError = true;
        $userMsg = "Käyttäjänimi on pakollinen!";
    }else if(strlen($username) < 5){
        $errors = true;
        $userError = true;
        $userMsg = "Käyttäjänimessä on oltava vähintään 5 merkkiä!";
    }

    if(empty($email)){
        $noEmail = true;
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors = true;
        $emailErr = true;
        $emailError = 'Sähköpostiosoite ei ole oikea!';
    }


    if(empty($password_1)){
        $errors = true;
        $passwordError = true;
        $passwordMsg = "Salasana on pakollinen!";
    }else if(strlen($password_1) < 5){
        $errors = true;
        $passwordError = true;
        $passwordMsg = "Salasanasssa on oltava vähintään 5 merkkiä!";
    }
    
    if($password_1 != $password_2){
        $errors = true;
        $passwordMatch = true;
        $password2Msg = "Salasanat eivät täsmää!";
    }
    
    if(checkLength($username)){
        $errors = true;
        $userError = true;
        $userMsg = 'Käyttäjänimi on liian pitkä! Max. 100 merkkiä!';
    }
    if(checkLength($email)){
        $errors = true;
        $emailErr = true;
        $emailError = 'Sähköpostiosoite on liian pitkä! Max. 100 merkkiä!';
    }
    
    if(checkLength($password_1)){
        $errors = true;
        $passwordError = true;
        $passwordMsg = 'Salasana on liian pitkä! Max. 100 merkkiä!';
    }
    if($userError){
        
    }else{
        $user_check_query = "SELECT * FROM members WHERE username='$username' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if($user) {
            if ($user['username'] === $username) {
                $errors = true;
                $userError = true;
                $userMsg = "Kyseinen käyttäjänimi on varattu! Valitse toinen.";
            }
        }
    }

    if($errors) {

    }else {
        $password = md5($password_1);
        
        if($noEmail){
            $query = "INSERT INTO members (username, password, email) 
            VALUES('$username', '$password', 'NULL')";
            mysqli_query($link, $query);
            $_SESSION['username'] = $username;
            $_SESSION['type'] = "member";
            $_SESSION['logged'] = true;
            header('location: index.php');
        }else{
            $query = "INSERT INTO members (username, password, email) 
                  VALUES('$username', '$password', '$email')";
            mysqli_query($link, $query);
            $_SESSION['username'] = $username;
            $_SESSION['type'] = "member";
            $_SESSION['logged'] = true;
            header('location: index.php');
        }

    }
}


function checkLength($str){
    if(strlen($str) <= 100){
        return false;
    } else {
        return true;
    }
}



$username = '';
$email = '';
$errors = false;

$emailError = '';
$emailErr = false;
$noEmail = false;

$userError = false;
$passwordError = false;
$passwordMatch = false;

$userMsg = '';
$passwordMsg = '';
$password2Msg = '';

$wrongMsg = '';
$wrongError = false;
if(isset($_POST['login-user'])){
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['pswd']);

    $username = trim($username);
    $password = trim($password);
  
    if(empty($username)){
        $errors = true;
        $userError = true;
        $userMsg = "Käyttäjänimi on pakollinen!";
    }
    if(empty($password)){
        $errors = true;
        $passwordError = true;
        $passwordMsg = "Salasana on pakollinen!";
    }
  
    if(!$errors){
        $password = md5($password);
        $query = "SELECT * FROM members WHERE username='$username' AND password='$password'";
        $results = mysqli_query($link, $query);
        if(mysqli_num_rows($results) == 1) {
            $query2 = "SELECT type FROM members WHERE username='$username' AND password='$password'";
            $result = mysqli_query($link, $query2);
            $lastStep = mysqli_fetch_row($result);
            $type = $lastStep[0];
            $_SESSION['username'] = $username;
            $_SESSION['type'] = $type;
            $_SESSION['logged'] = true;
            header('location: index.php');
        }else {
            $wrongError = true;
            $wrongMsg = "Käyttäjänimi tai salasana väärin! Yritä uudelleen.";
        }
    }
}


?>
