<?php

include 'config/database.php';
session_start();

    if (isset($_POST['submit']))
    {
        if (!$_POST['username'] || !$_POST['email'] || !$_POST['password'] || !$_POST['confirmpassword'] || !$_POST['firstname'] || !$_POST['lastname']) {
         $response = array('status' => false, 'statusMsg' => '<p class="warning">Please fill out all the required information correctly</p>');
            die(json_encode($response));
        }
        if ($_POST['password'] != $_POST['confirmpassword']) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Passwords Do Not Match!</p>');
            die(json_encode($response));
            //header("Location: sign_up.php");
        }
        if (strlen($_POST['username']) > 30) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Usename can\'t exceed 30 characters</p>');
            die(json_encode($response));
            //header("Location: sign_up.php");
        }
        if (strlen($_POST['password']) < 4) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Password must be at least 4 characters long</p>');
            die(json_encode($response));
            //header("Location: sign_up.php");
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Incorrect Email! Stop Messing Around! :(</p>');
            die(json_encode($response));
            //header("Location: sign_up.php");
        }

        $login = $_POST['username'];
        $pwd = hash('whirlpool', $_POST['password']);
        $email = $_POST['email'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $hashed = md5("$login");

try {
    $DB_DSN = $DB_DSN.';dbname=db_matcha';
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare('SELECT username, email FROM `users`');
    $sql->execute();
    
    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['username'] == $login) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Sorry, That Username Already Exists</p>');
            
              die(json_encode($response));
            //header("location: sign_up.php");
        } elseif ($result['email'] == $email) {
            $response = array('status' => false, 'statusMsg' => '<p class="warning">Sorry, That Email Already Exists</p>');
            die(json_encode($response));

          // header("location: sign_up.php");
        }
    }
    $sql = $conn->prepare('INSERT INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, 0);');
    $sql->execute([$login, $fname, $lname, $pwd, $email, $hashed]);
    //echo "user registration success";

    $sql = $conn->prepare('INSERT INTO profiles (username) VALUES (?)');
    $sql->execute([$login]);

    $sql = $conn->prepare('INSERT INTO public (username) VALUES (?)');
    $sql->execute([$login]);

    mail($email, 'Matcha account', "Hi $fname $lname,\nPlease verify your Matcha account as ".$login.":\nhttp://localhost:8080/home/verify.php?hashed=$hashed");
    //header("Location: login.php");
    $response = array('status' => true, 'statusMsg' => '<p class="success">Check your email to verify your account.</p>');
    die(json_encode($response));

    //header("Location: login.php");
    
}
     catch (PDOException $e) {
    $response = array('status' => false, 'statusMsg' => '<p class="danger">Please run config/setup.php file to create database</p>');
    die(json_encode($response));
}
    }
?>
