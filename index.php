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

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$servername = "localhost";
$username = "b68e314c37d579";
$password = "980c8efd";
$database_name = "heroku_61e6cc90a4490bb";
$

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database_name, $url);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";


$sql_statement = "INSERT INTO `heroku_61e6cc90a4490bb` (`id`, `fName`, `lName`, `email`, `confirmEmail`, `birthday`, `username`, `password`, `confirmPassword`) VALUES (NULL, '$firstName', '$lastName', '$personEmail', '$personConfirmEmail', '$personBirthday', '$personUsername', '$personPassword', '$personConfirmPassword')";

if (mysqli_query($connection, $sql_statement)) {
//    echo "New record created successfully";
} else {
    echo "Error: " . $sql_statement . "<br>" . mysqli_error($connection);
}