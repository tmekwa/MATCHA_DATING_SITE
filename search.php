<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles/search.css">
  <link rel="stylesheet" href="index.css">
  <title><?php echo $firstname; ?> <?php echo $lastname; ?></title>
</head>
<body>
<ul>
<li><a class="active" href="home.php">Home</a></li>
  <!-- <li><a href="#news">News</a></li> -->
  <li><a href="setup_profile.php">Profile</a></li>
  <li><a href="search.php">Search</a></li>
  <li><a href="user_logout.php">Logout</a></li>
</ul>
<div class="field">
  <h1>Search</h1>
  <form action="searching_interest.php" method="GET">
    <input type="text" id="search" name="search">
    <input type="submit" id="submit" name="submit" value="search">
  </form>
</div>
</body>
</html>