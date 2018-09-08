<?php
include('server.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/css/mdb.min.css" rel="stylesheet">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.9/js/mdb.min.js"></script>




    <style>
        .card{
            width: 500px;
            margin: 0 auto;
            margin-top: 25px;
            margin-bottom: 50px;

        }

        body{
            background-image: linear-gradient(to right, #11998e , #38ef7d);
        }


    </style>

</head>
<body>


<!-- Material form register -->
<div class="container">
    <div class="card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign up</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" method="post" action="index.php">
                <?php include('errors.php'); ?>
                <div class="form-row">
                    <div class="col">
                        <!-- First name -->
                        <div class="md-form">
                            <input type="text" name="fNameInput" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col">
                        <!-- Last name -->
                        <div class="md-form">
                            <input type="text" name="lNameInput" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <!-- E-mail -->
                <div class="md-form mt-0">
                    <input type="email" name="emailInput"class="form-control" placeholder="E-mail">
                </div>

                <div class="md-form mt-0">
                    <input type="email" name="confirmEmail" class="form-control" placeholder="Confirm E-mail">
                </div>

                <!-- DOB -->
                <div class="md-form">
                    <input type="date" name="dobInput" class="form-control" placeholder="Birthday">
                </div>

                <!-- Username -->
                <div class="md-form">
                    <input type="text" name="usernameInput" class="form-control" placeholder="Username">
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" name="passwordInput" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" placeholder="Password">
                </div>

                <!-- Confirm Password -->
                <div class="md-form">
                    <input type="password" name="confirmPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" placeholder="Confirm Password">
                </div>

                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="reg_user">Register</button>


            </form>
            <!-- Form -->

        </div>

    </div>
</div>
<!-- Material form register -->

</body>
</html>