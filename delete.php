<?php
session_start();
?>

<?php

if(empty($_SESSION["username"]))
{
header("Location: http://tobyflowers.xyz/home.php");
}


if(empty($_GET["fileName"])){
header("Location: http://tobyflowers.xyz/board.php");
}

if(empty($_GET["fileLocation"])){
header("Location: http://tobyflowers.xyz/board.php");
}

deleteRecord($_GET["fileName"]);
deleteFile($_GET["fileLocation"]);




function deleteRecord($fileName)
{
$conn = mysqli_connect("localhost", "root", "", "files");

if(!$conn)
{
die("Error connecting to DB for delete record!");
}

$sql =  "DELETE FROM files WHERE title = '". $fileName . "'";
mysqli_query($conn, $sql);
//echo $sql;
mysqli_close($conn);
}

function deleteFile($fileLocation)
{
  unlink("/opt/lampp/htdocs/uploads/" . $fileLocation);
}


header("Location: http://tobyflowers.xyz/board.php");



?>
