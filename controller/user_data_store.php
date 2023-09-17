<?php
session_start();
include "../database/evn.php";
$fname = $_REQUEST ['fname'];
$lname = $_REQUEST ['lname'];
$email = $_REQUEST ['email'];
$password = $_REQUEST ['password'];
$encpassword = password_hash($password, PASSWORD_BCRYPT);
$cpassword = $_REQUEST ['confirmpassword'];
$errors = [];


if(empty($fname)){
    $errors ['fname']= "please enter your first name";
}
if(empty($lname)){
    $errors ['lname']="please enter your last name";
}
if(empty($email)){
    $errors ['email']="please enter your email address";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors ['vemail']="please enter your valide emai address";
}
if(empty($password)){
    $errors ['password']="please enter your password";
}else if(empty($cpassword)){
    $errors ['cpassword']="please enter your confirm password";
}else if($password < 8){
    $errors ['cpassword']=" your  password is too short";
}else if($password != $cpassword){
    $errors ['cpassword']=" didn't match your confirm password";
}

if(count($errors) > 0){
    //  print_r($errors);
    $_SESSION["register_errors"]=$errors;
    header("Location:../backend/register.php");
}else {
   $dataissert = "INSERT INTO foods( fname, lname, email, password) VALUES ('$fname','$lname','$email','$encpassword')";
   $dtinquery = mysqli_query($conn,$dataissert);
if($dtinquery){
    header("location:../backend/login.php");

}}
?>