<?php

include('./defines.php');

session_start();

if($conn->connect_error){
    die("connection failed ". $conn->connect_error);
}



$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$hashed = password_hash($password, PASSWORD_DEFAULT);


$sql2 = "insert into user_details (username, email) values ('$username', '$email')";
$sql = "insert into login_details (username, password) values ('$username', '$hashed')";
//echo $sql;

if ($conn->query($sql2) === TRUE && $conn->query($sql)===TRUE) {
    $_SESSION['username'] = $username;
    header("Location: ./dashboard.php");
    echo "New record created successfully";
} elseif($conn->error == "Duplicate entry 'spacewalker' for key 'PRIMARY'") {
    $_SESSION['error_title'] = "Invalid Username";
    $_SESSION['error_msg'] = "Username Already Exists!!";
    echo $conn->error;
    header('location: ./errorpage.php');
}
mysqli_close($conn);


?>


