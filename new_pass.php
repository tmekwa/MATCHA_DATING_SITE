<?php

session_start();
  include './config/database.php';

  if (!$_POST['password'] || !$_POST['confirmpassword'] || !$_POST['email']) {
      $response = array('status' => false, 'statusMsg' => '<p class="warning">Please fill out all the required information</p>');
      die(json_encode($response));
  }

  if (strlen($_POST['confirmpassword']) < 4) {
      $response = array('status' => false, 'statusMsg' => '<p class="warning">Password must be at least 4 characters long</p>');
      die(json_encode($response));
  }

  $check_email = $_POST['email'];
  $password = hash('whirlpool', $_POST['password']);
  try {
    $DB_DSN = $DB_DSN.';dbname=db_matcha';
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare('SELECT email, hashed FROM `users`');
    $sql->execute();
    
    while ($result = $sql->fetch(PDO::FETCH_ASSOC))
    {
        if ($result['email'] == $check_email){
            $hashed = $result['hashed'];
            mail($check_email, 'Matcha account', "Hi There ,\nPlease verify your Matcha account " .":\nhttp://localhost:8080/home/fpass.php?h=$hashed&p=$password");
            $response = array('status' => true, 'statusMsg' => '<p class="warning">Check Email For New Link To Password</p>');
            die(json_encode($response));
        }
    } 
    $response = array('status' => false, 'statusMsg' => '<p class="warning">Sorry, That Email Does not Exists</p>');
    die(json_encode($response));
    echo "Email does not exist";
    header("location: forgot_pass.php");
}catch (PDOException $e)
{
    echo 'Error: ' . $e->getmessage();
    header('location: forgot_pass.php');
}