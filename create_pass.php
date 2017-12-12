<html>
<head>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="styles/sign_up.css">
  <title>Matcha Dating Site</title>
</head>
<style>
  body
  {
    background: lightblue;
  }
  h2
  {
    color: white;
  }
</style>
<body>
<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <!-- <li><a href="#news">News</a></li> -->
  <li><a href="login.php">Login</a></li>
  <li><a href="sign_up.php">signin</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
</ul>
<div class="field">
  <h2>Create New Password</h2>
  <div class="new_pass">
      <form action="new_pass.php" method="POST">
        <input type="text" id="email" name="email" placeholder="Email">
        <br>
        <br>
        <input type="password" id="password" name="password" placeholder="New Password">
        <br>
        <br>
        <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
        <br>
        <br>
        <input type="submit" name="submit" value="Change">
      </form>
  </div>
  </body>
</head>
  