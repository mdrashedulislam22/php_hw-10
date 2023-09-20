<?php
session_start();
include "../database/evn.php";
$id = $_SESSION['auth']['id'];
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$profile_errors = [];
if(empty($fname)){
    $profile_errors['first_name'] = "First name missing";
}
if(empty($lname)){
    $profile_errors['last_name'] = "last name missing";
}
if(empty($email)){
    $profile_errors['email'] = "your email is missing";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $profile_errors['email'] = "your email is not valid";
}
}
if(count($profile_errors)>0){
    $_SESSION['profile_errors'] = $profile_errors;
    header("Location:../backend/profile.php");
} else{
$mydtinput = "UPDATE foods SET fname='$fname',lname='$lname',email='$email' WHERE id='$id'";
$result = mysqli_query($conn,$mydtinput);
$_SESSION['smg'] = $result;
header("Location:../backend/index.php");

}
?>
