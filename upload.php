<?php
session_start();
?>

<?php

if(empty($_SESSION["username"]))
{
   header("Location: http://tobyflowers.xyz/home.php");
} else { 

$errors = (bool)false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{

  if(empty($_POST["title"]))
  {
   $errors = true;
   $_SESSION["uploadError"] = "Fill in all fields!";
  }

  if(empty($_POST["description"]))
  {
    $errors = true;
    $_SESSION["uploadError"] = "Fill in all fields!";
  }
  
  if($_FILES["file"]["name"] == "")
  {
   $errors = true;
   $_SESSION["uploadError"] = "Please select a file!";
  }

  
  if($errors)
  {
    header("Location: http://tobyflowers.xyz/board.php");
  
  } else { 
  
   $_SESSION["uploadError"] = "";
   $target_file = 'uploads/' . basename($_FILES["file"]["name"]); 
    if(file_exists($target_file))
    {
      $_SESSION["uploadError"] = "File already exists!";
      header("Location: http://tobyflowers.xyz/board.php");
    }else { 
        
       if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
       {
          recordUpload();
          $_SESSION["uploadError"] = "";
          header("Location: http://tobyflowers.xyz/board.php");
          
       }else{
         $_SESSION["uploadError"] = "Error uploading file!";
          echo $target_file;
          echo $_FILES["file"]["error"];
          echo $_FILES["file"]["tmp_name"];
         header("Location: http://tobyflowers.xyz/board.php");
       }
    } 
   
   } 

  
}else{
 header("Location: http://tobyflowers.xyz/board.php");
}
  
}

function recordUpload(){
$conn = mysqli_connect("localhost", "root", "", "files");

if(!$conn)
{
die("Connection failed");
}

$sql = "INSERT INTO files VALUES('" . $_POST["title"] . "','" . $_POST["description"] . "','" . basename($_FILES["file"]["name"]) . "','" . $_FILES["file"]["size"] . "')";
$record = mysqli_query($conn, $sql);

mysqli_close($conn);
}
?>
