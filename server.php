<?php
//Project Name: Registration Page V111
//Module Name: php7_module
//Programmers: Jacob Taylor, Hermes Mimini, Isaiah Camacho, Isaiah DeBenedetto
//Date: 9/9/18
//Synopsis of php7_module: PHP 7 uses new Zend Engine 3.0 to improve application performance almost twice and 50% better memory consumption than PHP 5.6. It allows to serve more concurrent users without requiring any additional hardware.
//References: https://www.tutorialspoint.com/php7/index.htm, https://www.w3schools.com/php/,
// Welling, L., & Thomson, L. (2008). PHP and MySQL web development (4th ed.). Boston, MA: Addison-Wesley Professional. ISBN-13: 9780672329166

//Get Heroku ClearDB connection information
$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server   = $cleardb_url["us-cdbr-iron-east-01.cleardb.net"];
$cleardb_username = $cleardb_url["b68e314c37d579"];
$cleardb_password = $cleardb_url["980c8efd"];
$cleardb_db       = substr($cleardb_url["heroku_61e6cc90a4490bb"],1);


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'   => '',
    'hostname' => $cleardb_server,
    'username' => $cleardb_username,
    'password' => $cleardb_password,
    'database' => $cleardb_db,
    'dbdriver' => 'mysql',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);


// Create connection
$connection = new mysqli($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$errors = array();

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
    $user_check_query = "SELECT * FROM heroku_table WHERE username='$personUsername' OR email='$personEmail' LIMIT 1";
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

        $query = "INSERT INTO `heroku_table` (`id`, `fName`, `lName`, `email`, `confirmEmail`, `birthday`, `username`, `password`, `confirmPassword`) VALUES (NULL, '$firstName', '$lastName', '$personEmail', '$personConfirmEmail', '$personBirthday', '$personUsername', '$personPassword', '$personConfirmPassword')";
        mysqli_query($connection, $query);
        $_SESSION['username'] = $personUsername;
        $_SESSION['success'] = "You are now logged in";
        header('location: home.php');
    }
}
