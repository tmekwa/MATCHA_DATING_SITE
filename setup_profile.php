<?php

session_start();
include './config/database.php';

try {
    $DB_DSN = $DB_DSN.';dbname=db_matcha';
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $conn->prepare('SELECT username, age, biography, interests, gender, sex_pref, latitude, longitude, hidden FROM `profiles`');
    $sql->execute();
    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['username'] == $_SESSION['logged_on_user']) {
            $age = $result['age'];
            $bio = $result['biography'];
            $gender = $result['gender'];
            $sex_pref = $result['sex_pref'];
            $lat = $result['latitude'];
            $long = $result['longitude'];
            $hidden = $result['hidden'];
            $interests = $result['interests'];
        }
    }
    $sql = $conn->prepare('SELECT username, meta FROM `users`');
    $sql->execute();
    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result['username'] == $_SESSION['logged_on_user']) {
            $meta = $result['meta'];
        }
    }
} catch (PDOException $e) {
    echo 'I\'m extremely sorry, but there was an unexpected ERROR: '.$e;
}

?>
<html>
<head>
  <title>Matcha Dating Site</title>
  <link rel="stylesheet" type="text/css" href="styles/profile.css">
  <link rel="stylesheet" href="index.css">
  <script type="text/javascript" src="script.js"></script>
  <script></script>
</head>
<body>
<ul>
<li><a class="active" href="home.php">Home</a></li>
  <li><a href="setup_profile.php">Profile</a></li>
  <li><a href="search.php">Search</a></li>
  <li><a href="user_logout.php">Logout</a></li>
</ul>
<div class="field">
  <h1>My Profile</h1>
        <header id="header">
        <section id="container">

  		<div id="error-messages"></div>

        <p style="margin-left:20px;margin-top:20px;">Account Setup:</p>
        <div id="header" style="height:35px;top:65px;">
        <button class="w3-btn" onclick="goBack()" style="font-size:20px">Go Back</button>
        <button class="w3-btn" onclick="goForward()" style="font-size:20px">Forward</button>
        </div>
        <script>
        function goForward() {
            window.history.forward();
        }
        function goBack() {
            window.history.back();
        }
        </script>
        </header>
        
        <form id="imageUploadForm" method="post" enctype="multipart/form-data">
        <progress class="during-upload" id="progress" max="100" value="0">
        </progress>
        <div class="image-upload-fields">
            <strong style="font-size:20px;">first one as profile picture</strong>:
            <br />
            <input type="file" name="userfile" id="file">
            <br />
            <input type="submit" value="Upload Image" name="submit">
            <br />
        </div>
        <button type="button" name="cancelUpload" id="cancelUploadBtn" class="during-upload btn icon l round danger">
          <i aria-hidden="true" title="Cancel Upload">Cancel Upload</i>
        </button>
      </form>


      <form id="profile" name="SetupProfile" method="post" enctype="multipart/form-data">
    <p style="color:#9C0234">First Name:</p><br />
    <input type="text" name="fname" id="fname" maxlength="30" required value="<?php echo $_SESSION['firstname']; ?>">
      <br />
      <br />
      <p style="color:#9C0234">Last Name:</p><br />
      <input type="text" name="lname" id="lname" maxlength="30" required value="<?php echo $_SESSION['lastname']; ?>">
      <br />
      <br />
      <p style="color:#9C0234">Email:</p><br />
      <input type="email" name="email" id="email" maxlength="50" required value="<?php echo $_SESSION['email']; ?>">
      <br />
      <br />
       <p style="color:#9C0234">Gender:</p><br />
    <input type="checkbox" id="genderm" name="gender"><label for="male">Male</label>
    <input type="checkbox" id="genderf" name="gender"><label for="female">female</label>
    <br>
    <br>
    <p style="color:#9C0234">Sexual Preference:</p><br />
      <input type="checkbox" id="sex_prefm" value="Males"><label for="male">Males</label>
      <input type="checkbox" id="sex_preff" value="Females"><label for="male">Females</label>
    <br>         
    <br>
    <p style="color:#9C0234">Age:</p><br />
    <input type="number" name="age" id="age" min="18" max="100" required value="<?php echo $age; ?>">
    <br>
    <br>
    <p style="color:#9C0234">Biography:</p><br />
    <textarea rows="3" cols="30" name="biography" id="biography" maxlength="10000" form="profile" required placeholder="Biography"><?php echo $bio; ?></textarea>
    <br />
    <br />
    <p style="color:#9C0234">Interests:</p><br />
    <textarea rows="3" cols="30" name="interests" id="interests" maxlength="10000" form="profile" required placeholder="e.g. #blonde#fat#gorgeous"><?php echo $interests; ?></textarea>
    <br />
    <br />
    <label for="Hiden">Hide IP address</label>
    <input type="radio" name="hiden_yes"><label for="hiden_yes">Yes</label>
    <input type="radio" name="hiden_no"><label for="hiden_no">No</label>
    <br>
   <br>
    <input type="submit" id="get_pos" onclick="get_coords()" name="location" value="Get My Location">
    <br>
    latitude:
    <input type="text" id="latitude" name="latitude" maxlength="4" value="<?php if ($hidden == 'yes') {
  echo '';
} else {
  echo $lat;
} ?>">
    <br />
    longitude:
    <input type="text" id="longitude" name="longitude" maxlength="4" value="<?php if ($hidden == 'yes') {
  echo '';
} else {
  echo $long;
} ?>">
        <br>
        <br>
        <input class="subbtn" type="submit" value="Save" name="submit">
  </form>
  </section>
  <footer id="footer">

 <button onclick="document.getElementById('id01').style.display='block'"
 class="w3-btn">Options</button>
  <div id="id01" class="w3-modal" style="display: none">
   <div class="w3-modal-content">

     <div class="w3-container">
       <button onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">Close tray</button>
       <div>

                <div style="float: left; width: 400px;">
                    <form method="post" id="delAccForm" enctype="application/x-www-form-urlencoded">
                        Delete Account:
                        <input type="password" style="background-color: Yellow;" id="delAccPwd" placeholder="password">
                        <input id="delacc" type="submit" style="background-color: #FE0001;" name="delaccount" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account?')">
                    </form>
                </div>
                <div style="float: left; width: 550px;">
                    <form id="modifyForm" method="post" enctype="application/x-www-form-urlencoded">
                      Change Password:
                      <input type="password" style="background-color: #015a5b;" id="oldpw" name="oldpwd" placeholder="old password">
                      <input type="password" style="background-color: #073d00;" id="newpw" name="newpwd" placeholder="new password">
                      <input type="submit" style="background-color: #FE0001;" name="submit" value="Change Password">
                    </form>
                </div>

                <a class="links" <?php if ($meta == 2): ?> href="home.php"<?php endif ?>>Home</a>

                <div style="float: right; width: 170px;">
                  <form method="get" action="logout.php">
                     <?php echo $_SESSION['logged_on_user'].':'; ?>
                  </form>
                  <p class="cright">
                         <a class="cright" Thato Mekwa | Matcha | 2017</a>
                 </p>
       </div>
     </div>

 </div>
</div>

</footer>
</div>

</body>
</html>
