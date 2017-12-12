<?php
    include 'config/database.php';

    // session_start();

    // if (!$_POST['email'])
    // {
    //     echo "Please Enter Your Email";
    // } else {}

    // $check_email = $_POST['email'];
    
    
  try {
    $DB_DSN = $DB_DSN.';dbname=db_matcha';
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare('SELECT hashed, password FROM `users`');
    $sql->execute();
    $hashed = $_GET['h'];
    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['hashed'] == $hashed) {
            $new_pass = $_GET['p'];
            $sql = $conn->prepare('UPDATE `users` SET password=? WHERE hashed=?');
            $sql->execute([$new_pass, $hashed]);

            date_default_timezone_set('Africa/Johannesburg');
            $date = date('d/m/Y');
            $time = date('h:i:sa');
            mail($email, 'Matcha account modified', "Your Matcha account password was recently changed on: \n".$date." \nat: \n".$time." \nas: \n".$user.'.');

            $response = array('status' => true, 'statusMsg' => '<p class="success">Password Successfully Changed.<br /> A notification email as also been sent ;)</p>');
            //die(json_encode($response));
            header("location: login.php");
        }
    }
    $response = array('status' => false, 'statusMsg' => '<p class="danger">Incorrect Password</p>');
    die(json_encode($response));
    header("location: create_pass.php");
} catch (PDOException $e) {
    $response = array('status' => false, 'statusMsg' => '<p class="danger">Unfortunately, There was an error. <br /><b><u>Error Message :</u></b><br />'.$e.'</p>');
    die(json_encode($response));
    header("location: create_pass.php");
}

?>