<?php

    session_start();
    include "config/database.php";

    if (!$_POST['username'] || !$POST['password'])
    {
        echo "Please fill out all the textfield's above";
        header("location:login.php");
    }
        
        $user_check = $_POST['username'];
        $password_check = hash('whirlpool', $_POST['password']);
        try {
            $DB_DSN = $DB_DSN.';dbname=db_matcha';
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare('SELECT username, password, email, meta, fname, lname FROM `users`');
            $sql->execute();

            while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
                if ($result['username'] == $user_check && $result['password'] == $password_check) {
                    if ($result['meta'] == 0) {
                        $response = array('status' => false, 'statusMsg' => '<p class="info">Please verify your account via email first</p>');
                        die(json_encode($response));
                        header("location: login.php");
                    } elseif ($result['meta'] == 1) {
                        $_SESSION['email'] = $result['email'];
                        $_SESSION['logged_on_user'] = $user_check;
                        $_SESSION['firstname'] = $result['fname'];
                        $_SESSION['lastname'] = $result['lname'];
                        
                        $response = array('meta' => 1, 'status' => true, 'statusMsg' => '<p class="success">login successful</p>');
                       // die(json_encode($response));

                        header("location: setup_profile.php");
                    } else {
                        $_SESSION['email'] = $result['email'];
                        $_SESSION['logged_on_user'] = $user_check;
                        $_SESSION['firstname'] = $result['fname'];
                        $_SESSION['lastname'] = $result['lname'];

                        $response = array('meta' => $result['meta'], 'status' => true, 'statusMsg' => '<p class="success">login successful</p>');
                        //die(json_encode($response));


                        header("location: home.php");
                    }
                }
            }
            }catch (PDOException $e)
            {
                file_put_contents('errrr', $e->getmessage());
                echo 'Error Checking Database ' . $e->getmessage();
                header("location: profile.php");
            }

?>