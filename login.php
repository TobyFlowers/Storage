<?php
session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
   <title> Login </title>
</head>
<body>

<?php
if(!(is_null($_SESSION["username"])))
{
  header("Location: http://tobyflowers.xyz/board.php");
} else {

$username = $_POST["username"];
$password = $_POST["password"];

$conn = mysqli_connect("localhost", "root", "", "users");

if($conn === false)
{
  die("FAILED TO CONNECT TO DATABASE");
}


$sql = "SELECT password FROM users WHERE username = '" . $username . "'";


if($result = mysqli_query($conn, $sql))
{
  if(mysqli_num_rows($result) === 0)
  {
    header("Location: http://tobyflowers.xyz/home.php");
  }else{

    while($row = mysqli_fetch_row($result))
    {

      if($row[0] === $password)
      {
        $_SESSION["username"] = $username;
        header("Location: http://tobyflowers.xyz/board.php");
      } else {
        header("Location: http://tobyflowers.xyz/home.php");
      }
    }
  }
/*
 while($row = mysqli_fetch_row($result))
   {
      if($row[0] === $password)
      {
         echo "Welcome " . $username . "!";
      }else{
        echo "Incorrect password!";
      }
   }*/
} else {
header("Location: http://tobyflowers.xyz/home.php");
}


/*
if($result = mysqli_query($conn, $sql))
{
  if(mysqli_num_rows($result) > 0){
    echo "<table>";
      echo"<tr>";
       echo "<th>username</th>";
       echo "<th>password</th>";
      echo "</tr";
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
          echo "<td>" . $row['username'] . "</td>";
          echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
   }

   echo "</table>";

   mysqli_free_result($result);

   } else {
      echo "No matching records";
  }

} else {
   echo "ERROR: FAILED TO EXECUTE";
}
*/


mysqli_close($conn);
}
?>

</body>
</html>
