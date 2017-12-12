<?php

  include 'config/database.php';

  if (isset($_POST['submit']))  
  {
    try
    {
      $DB_DSN = $DB_DSN.';dbname=db_matcha';
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $conn->prepare('SELECT first_name, last_name, continent, comment FROM `contacts`');

      //while ($result = $sql->fetch(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION))
      
        $cfname = $_POST['firstname'];
        $clname = $_POST['lastname'];
        $ccontinent = $_POST['continent'];
        $csubject = $_POST['subject'];
    
        $sql = $conn->prepare('INSERT INTO contacts (first_name, last_name, continent, comment) VALUES (?, ?, ?, ?);');
        $sql->execute([$cfname, $clname, $ccontinent, $csubject]);

        //$response = array('status' => true, 'statusMsg' => '<p class="success"> Message has been sent to admin</p>');
        //die(json_encode($response));

        $to = "tmekwa36@gmail.com";
        $subject = "Matcha Crew";
        $message = "$cfname $clname" . " From " . "$ccontinent  Message:  $csubject";
        mail($to, $subject, $message);
        
        //$response = array('status' => false, 'statusMsg' => '<p class="danger">Please type in message for administration</p>');

      header("location: response.php");
    }
    catch (PDOException $e)
    {
      echo 'ERROR:' . $e->getMessage();
      $response = array('status' => false, 'statusMsg' => '<p class="danger">Please run config/setup.php file to create database</p>');
      die(json_encode($response));
    }
  }
?>

<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="styles/contact.css">
	<title>Matcha Dating Site</title>
</head>
<body>
<ul>
  <li><a class="active" href="index.php">Matcha</a></li>
  <!-- <li><a href="#news">News</a></li> -->
  <li><a href="login.php">Login</a></li>
  <li><a href="sign_up.php">sign_up</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
</ul>
<div class="field">
  <h3>Contact Form</h3>
<div class="container">
  <form action="contact.php" method="POST">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" required placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" required placeholder="Your last name..">

    <label for="continent">Continent</label>
    <select id="continent" name="continent">
      <option value="Africa">Africa</option>
      <option value="Asia">Asia</option>
      <option value="North America">North America</option>
      <option value="South America">South America</option>
      <option value="Europe">Europe</option>
      <option value="Australia">Australia</option>
       <option value="Antarctica">Antarctica</option>
    </select>

    <label for="subject">Subject</label>
    <textarea id="subject" name="subject" required placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" name="submit" value="Submit">
  </form>
</div>
<p></p>
</div>


</body>
</html>