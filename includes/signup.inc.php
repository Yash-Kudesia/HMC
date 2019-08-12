<?php
if (isset($_POST['signin_btn'])) {
    
    require 'dbh.inc.php';
    $username = $_POST['rollnumber'];
    $email    = $_POST['email'];
    $password  = $_POST['password'];
    $repeatPass =$_POST['repeatpassword'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];

    if($password!=$repeatPass){
        header("Location: ../index.php");
        exit();
    }
    
}
else{
    header("Location: ../index.php");
    exit();
}
?>