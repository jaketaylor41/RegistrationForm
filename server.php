<?php

//$firstName = addslashes($_GET['fNameInput']);
//$lastName = addslashes($_GET['lNameInput']);
//$personEmail = $_GET['emailInput'];
//$personConfirmEmail = $_GET['confirmEmail'];
//$personBirthday = $_GET['dobInput'];
//$personUsername = $_GET['usernameInput'];
//$personPassword = $_GET['passwordInput'];
//$personConfirmPassword = $_GET['confirmPassword'];
//echo "Hello " . $firstName . ", welcome to the blog!";
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-01.cleardb.net"];
$username = $url["b97ff3bce68dc2"];
$password = $url["9a7484b1"];
$database_name = substr($url["heroku_2d121b77215d1b2"], 1);
$errors = array();


// Create connection
$connection = new mysqli($url, $server, $username, $password, $database_name);

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $firstName = mysqli_real_escape_string($connection, $_POST['fNameInput']);
    $lastName = mysqli_real_escape_string($connection, $_POST['lNameInput']);
    $personEmail = mysqli_real_escape_string($connection, $_POST['emailInput']);
    $personConfirmEmail = mysqli_real_escape_string($connection, $_POST['confirmEmail']);
    $personBirthday = mysqli_real_escape_string($connection, $_POST['dobInput']);
    $personUsername = mysqli_real_escape_string($connection, $_POST['usernameInput']);
    $personPassword = mysqli_real_escape_string($connection, $_POST['passwordInput']);
    $personConfirmPassword = mysqli_real_escape_string($connection, $_POST['confirmPassword']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($firstName)) { array_push($errors, "First name is required"); }
    if (empty($lastName)) { array_push($errors, "Last name is required"); }
    if (empty($personEmail)) { array_push($errors, "Email is required"); }
    if (empty($personConfirmEmail)) { array_push($errors, "Confirm Email is required"); }
    if (empty($personBirthday)) { array_push($errors, "DOB is required"); }
    if (empty($personUsername)) { array_push($errors, "Username is required"); }
    if (empty($personPassword)) { array_push($errors, "Password is required"); }
    if (empty($personConfirmPassword)) { array_push($errors, "Confirm password is required"); }
    if ($personPassword != $personConfirmPassword) {
        array_push($errors, "The two passwords do not match");
    }
    if ($personEmail != $personConfirmEmail) {
        array_push($errors, "The two emails do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM HerokuTable WHERE username='$personUsername' OR email='$personEmail' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $personUsername) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $personEmail) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($personPassword);//encrypt the password before saving in the database

        $query = "INSERT INTO `HerokuTable` (`id`, `fName`, `lName`, `email`, `confirmEmail`, `birthday`, `username`, `password`, `confirmPassword`) VALUES (NULL, '$firstName', '$lastName', '$personEmail', '$personConfirmEmail', '$personBirthday', '$personUsername', '$personPassword', '$personConfirmPassword')";
        mysqli_query($connection, $query);
        $_SESSION['username'] = $personUsername;
        $_SESSION['success'] = "You are now logged in";
        header('location: home.php');
    }
}


//
//// Check connection
//if (!$connection) {
//    die("Connection failed: " . mysqli_connect_error());
//}
////echo "Connected successfully";
//
//
//$sql_statement = "INSERT INTO `heroTable` (`id`, `fName`, `lName`, `email`, `confirmEmail`, `birthday`, `username`, `password`, `confirmPassword`) VALUES (NULL, '$firstName', '$lastName', '$personEmail', '$personConfirmEmail', '$personBirthday', '$personUsername', '$personPassword', '$personConfirmPassword')";
//
//if (mysqli_query($connection, $sql_statement)) {
////    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql_statement . "<br>" . mysqli_error($connection);
//}