<?php

include './config/database.php';

try {
    $hashed = $_GET['hashed'];
    $DB_DSN = $DB_DSN.';dbname=db_matcha';
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare('SELECT hashed, meta FROM `users`');
    $sql->execute();

    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['hashed'] == $hashed) {
          if ($result['meta'] == 0) {
            $sql = $conn->prepare('UPDATE `users` SET meta=1 WHERE hashed=?');
            $sql->execute([$hashed]);
          }
          $response = array('status' => true, 'statusMsg' => '<h2s class="success">Please verify your Email</h2>');
            header('Location: login.php');
        }
    }

} catch (PDOException $e) {
    die('unfortunately ther was an error: '.$e);
}

header('Location: login.php');

?>