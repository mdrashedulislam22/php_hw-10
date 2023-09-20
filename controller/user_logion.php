<?php 
session_start();
$mydt = include "../database/evn.php";
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$errors = [];
if(empty($email)){
    $errors['email_errors'] = "please enter your email address";
}
if(empty($password)){
    $errors['password_errors'] = "please enter your password";
}
if(count($errors)>0){
    $_SESSION['form_errors']= $errors;
    header("Location:../backend/login.php");
}else{
    
    $usersemail = "SELECT * FROM foods WHERE email = '$email'";
    $emailrespons = mysqli_query($conn, $usersemail);   
    $datafatch = mysqli_fetch_assoc($emailrespons);
    $password_v =password_verify($password,$datafatch['password']);

    if(mysqli_num_rows($emailrespons)> 0){
    if($password_v){
        $_SESSION['auth']= $datafatch;
        header("Location:../backend/index.php");
    } else {
        $errors['password_errors'] = "wrong password";
        $_SESSION['form_errors']= $errors;
        header("Location:../backend/login.php");
    }
       
    } else{
        $errors['email_errors'] = "wrong email address";
        $_SESSION['form_errors']= $errors;
        header("Location:../backend/login.php");

    }
}

?>
