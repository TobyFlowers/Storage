<?php
session_start();
?>

<?php
if(empty($_SESSION["username"]))
{
header("Location: http://tobyflowers.xyz/home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<a href="http://tobyflowers.xyz/logout.php" class = "logoutButton">Logout</a>
<div class="mainPage">
<form action="upload.php" method="post" enctype="multipart/form-data">
  <input type="text" placeholder="File Title" name ="title">
  <br>
  <input type="text" placeholder="File Description" name="description">
  <br>
  <div class="upload">
  <input type="file" name= "file" id="fileToUpload">
  </div> 
<br>
  <input type="submit">
</form>

<?php
  if(!(empty($_SESSION["uploadError"])))
  {
   echo '<h5 style="color:red">';
   echo $_SESSION["uploadError"];
   echo "</h5>";
  }
?>
<div class="board">
<?php
echo  "<br>";
$conn = mysqli_connect("localhost", "root", "", "files");

if($conn === false)
{
   die("ERROR CONNECTING");
}

$sql = "SELECT * FROM files";

if($result = mysqli_query($conn, $sql))
{
  if(mysqli_num_rows($result)>0)
  {
    while($row = mysqli_fetch_assoc($result))
    {

       echo "Name: " . $row["title"] . " - Description: " . $row["description"] . " - Size: " . $row["fileSize"];
       echo "<a href = \"/uploads/". $row["uploadName"] . "\" download = \"". $row["uploadName"]  ."\">";
       echo "<div class=\"download\">";
       echo "<div class=\"opaque\">";
       echo "<button type=\"button\">Download</button>";
       echo "</div>";
       echo "</div>";
       echo "</a>";
       echo "<div style=\"display: inline-block;\">";
       echo  "<form action=\"delete.php\">";
       echo  "<input type=\"hidden\" name=\"fileName\" value = \"" . $row["title"] . "\">";
       echo "<input type  = \"hidden\" name = \"fileLocation\" value = \"" . $row["uploadName"] . "\">";
       echo "<div class=\"delete\">";
       echo "<div class=\"opaque\"\>";
       echo  "<input type=\"submit\" value = \"Delete\">";
       echo "</div>";
       echo "</div>";
       echo "</form>"; 
       echo "</div>";
       echo  "<br><br>";
    } 
 }else {
   echo "No Files!";
  }
}

mysqli_close($conn);
?>
</div>
</div>
</body>
</html>
