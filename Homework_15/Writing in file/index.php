<!DOCTYPE html>
<html>
<head>
    <title>Task 3</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <h1 id="heading">Sign Up</h1>
            <form action="index.php">
                <input class="form-control" name="name" placeholder="First name">
                <input class="form-control" name="surname" placeholder="Last name">
                <input class="form-control" name="email" placeholder="E-mail">
                <input class="form-control" type="password" name="password" placeholder="Password">
                <div class="row">
                    <div class="col-md-12 btn-row">
                        <input class="btn btn-lg" type="submit" value="Submit" onclick="validate()">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    $myfile = fopen("det.txt", "w") or die("Unable to open file!");
    $name = $_GET['name'];
    $surname = $_GET['surname'];
    $email = $_GET['email'];
    $password = $_GET['password'];
    $line = "Name: " . $name . ", Surname: " . $surname . ", Email: " . $email . ", Password: " . $password . ".";
    fwrite($myfile, $line);
    fclose($myfile);
    echo '<script>alert("Your files were written in file")</script>';
?>

<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: samvel
 * Date: 6/10/16
 * Time: 10:27 AM
 */