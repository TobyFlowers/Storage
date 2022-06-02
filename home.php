<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <title> Home </title>
   <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="mainPage">
<img src="loginIcon.png" alt="Login Icon" class="loginIcon">
<div class="home">
<br>
<div class="parent">
<?php

if(!(is_null($_SESSION["username"])))
{
  header("Location: http://tobyflowers.xyz/board.php");
}

?>

<form action="login.php" method="post">
<div class="form">
<input type="text" placeholder="Username" name="username"><br>
<input type="password" placeholder="Password" name="password"><br>
<input type ="submit">
</div>
</form>
</div>
</div>
<div class="stats">
<?php
$conn = mysqli_connect("localhost", "root", "", "files");
$sqlNumFiles = "SELECT count(*) FROM files";
$sqlTotalSize = "SELECT SUM(fileSize) FROM files";

if($recordNumFiles = mysqli_query($conn, $sqlNumFiles))
{
  $row = mysqli_fetch_assoc($recordNumFiles);
  echo "<br>Number of Files: " . $row["count(*)"] . "<br>";
}

if($recordTotalSize = mysqli_query($conn, $sqlTotalSize))
{
 $row = mysqli_fetch_assoc($recordTotalSize);
  echo "Storage Used: " . $row["SUM(fileSize)"] . "B";
}
?>

</div>
</div>
Copyright © Tobias Flowers - <?php echo date("Y")?>
</body>
</html>
