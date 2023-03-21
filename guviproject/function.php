<?php
session_start();
require 'config.php';

// IF
if(isset($_POST["action"])){
  if($_POST["action"] == "register"){
    register();
  }
  else if($_POST["action"] == "login"){
    login();
  }
  else if($_POST["action"] == "edit"){
    edit();
  }
}

// EDIT
function edit(){
  global $conn;

  $id = $_POST["id"];
  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "UPDATE tb_user SET name = ?, username = ?, password = ? WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt,$sql);
  mysqli_stmt_bind_param($stmt,"ssss",$name,$username,$password,$id);
  mysqli_stmt_execute($stmt);
  echo "Updated Successfully";
}

// REGISTER
function register(){
  global $conn;

  $name = $_POST["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  if(empty($name) || empty($username) || empty($password)){
    echo "Please Fill Out The Form!";
    exit;
  }

  $sql = "SELECT * from tb_user WHERE username=?;";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt,$sql);
  mysqli_stmt_bind_param($stmt,"s",$username);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);

  if(($row = mysqli_fetch_assoc($user)) > 0)
  {
    echo "Username Has Already Taken";
    exit;
  }

  $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$password')";
  mysqli_query($conn, $query);
  echo "Registration Successful";
}

// LOGIN
function login(){
  global $conn;

  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * from tb_user WHERE username=?;";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt,$sql);
  mysqli_stmt_bind_param($stmt,"s",$username);
  mysqli_stmt_execute($stmt);
  $user = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($user))
  {
    if($password == $row['password']){
      echo "Login Successful";
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
    }
    else{
      echo "Wrong Password";
      exit;
    }
  }
  else{
    echo "User Not Registered";
    exit;
  }
}
?>
