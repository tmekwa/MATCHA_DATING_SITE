<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
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
	<div class="grandform">
		<div align="center" class="all_form">
		<div class="account-form">
		<h2>Login</h2>
		<form method="POST" action="user_login.php" enctype="multipart/from-data" autocomplete="off">
			<input type="text" id="userin" name="username" required placeholder="Username"/> 
				<br>
				<br/>
		<input type="password" id="pwdin" name="password" required placeholder="Password"/>
				<br>
				<br/>
				<br>
				<br/>
			<input type="submit" id="submit"  name="submit" value="OK" onclick="showAlert()">
			</div>
			<div class"extraform">
			<p>
			<a id="lost_account" href="create_pass.php">Forgot password</a>
			</p>
		</form>				
			</div>
			</div>
            <br>
        </div>
    </div>
    </body>
</html>