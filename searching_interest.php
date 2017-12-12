<!DOCTYPE html>
<html>
<head>
 
  <title><?php echo $username ?></title>
  <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <link rel="stylesheet" href="css/modulr.css" />
        <link rel="stylesheet" href="index.css">
		<link rel="stylesheet" type="text/css" href="css/all_styles.css">
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="get_users.js"></script>
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
  
    <?php
      include 'config/database.php';

      session_start();

      if (isset($_GET['submit']))
      {
        //$check_interets = $_GET['search'];
        $check_user = $_GET['search'];
        try
        {
          $DB_DSN = $DB_DSN.';dbname=db_matcha';
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare('SELECT username, gender, sex_pref, age, biography, interests, latitude, longitude FROM `profiles`');
            $sql->execute();

            while ($result = $sql->fetch(PDO::FETCH_ASSOC))
            {
                if ($result['username'] == $check_user || $result['interests'] == $check_user)
                {
      ?>
                    <h2><?php echo $result['username']; ?></h2>
                    <table>
                    <tr><td>Username: </td><td><?php echo $result['username']; ?></td></tr>
                    <tr><td>Gender: </td><td><?php echo $result['gender']; ?></td></tr>
                    <tr><td>Gender Preference: </td><td><?php echo $result['sex_pref']; ?></td></tr>
                    <tr><td>Age: </td><td><?php echo $result['age']; ?></td></tr>
                    <tr><td>Biography: </td><td><?php echo $result['biography']; ?></td></tr>
                    <tr><td>Interests: </td><td><?php echo $result['interests']; ?></td></tr>
                    </table>
                    <input type="submit" id="chat" value="Chat">
                    </body>
                    </html>
                  
      <?php       
                }
                else  
                  return ;
          }
        }
        catch (PDOExcpetion $e)
        {
          echo "Could not connect to database " . $e->getmessage();
        }
      }
      ?>