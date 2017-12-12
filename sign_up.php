<html>
<head>
  <link rel="stylesheet" href="styles/sign_up.css">
  <link rel="stylesheet" href="index.css">
  <script type="text/javascript" src="script.js"></script>
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
	<body>
        <h1>Fill_In_Form_Matcha</h1>
        <form action="create.php" method="POST" enctype="multipart/from-data" autocomplete="off">
            <input type="text" id="fnameup"placeholder="Firstname" name="firstname" required>
            <input type="text" id="lnameup" placeholder="Lastname" name="lastname" required>
            <input type="text" id="userup" placeholder="Username" name="username" required>
            <input type="email" id="emialup" placeholder="Email" name="email" required>
            <input type="password" id="pwd1up" placeholder="Password" name="password" required>
            <input type="password" id="pwd2up" placeholder="Confirm Passwrd" name="confirmpassword" required>

            <input type="Submit" name="submit">
        </form>
    </body>
	</div>
</body>
</html>