<?php


include 'homePage.html';
$firstName = addslashes($_GET['fNameInput']);
$lastName = addslashes($_GET['lNameInput']);
$personEmail = $_GET['emailInput'];
$personConfirmEmail = $_GET['confirmEmail'];
$personBirthday = $_GET['dobInput'];
$personUsername = $_GET['usernameInput'];
$personPassword = $_GET['passwordInput'];
$personConfirmPassword = $_GET['confirmPassword'];


//echo "Hello " . $firstName . ", welcome to the blog!";

$servername = "localhost";
$username = "root";
$password = "root";
$database_name = "registration_form";
$

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database_name);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";


$sql_statement = "INSERT INTO `heroTable` (`id`, `fName`, `lName`, `email`, `confirmEmail`, `birthday`, `username`, `password`, `confirmPassword`) VALUES (NULL, '$firstName', '$lastName', '$personEmail', '$personConfirmEmail', '$personBirthday', '$personUsername', '$personPassword', '$personConfirmPassword')";

if (mysqli_query($connection, $sql_statement)) {
//    echo "New record created successfully";
} else {
    echo "Error: " . $sql_statement . "<br>" . mysqli_error($connection);
}