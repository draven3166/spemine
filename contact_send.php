<?php
require_once 'db.php';
global $conn;

$name = @trim(stripslashes($_POST['name']));
$email = @trim(stripslashes($_POST['email']));
$subject = @trim(stripslashes($_POST['subject']));
$message = @trim(stripslashes($_POST['message']));

if($name && $email && $subject && $message){

//Insert on DB
    $stmt = $conn->prepare("INSERT into contact (name,email,subject,message) VALUES (:name,:email,:subject,:message)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    if($stmt->rowCount()==1){
        echo "success";
    }else{
        echo 'Something wrong with your submited data. Try again.';
    }
}else{
    echo 'All fields are required!';
}