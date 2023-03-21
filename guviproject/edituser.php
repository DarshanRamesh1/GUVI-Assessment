<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit User</title>
    <!--- Boostrap ----->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--- CSS ----->
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="login">
    <!-- <h2>Edit User</h2> -->
    <h1 class="text-center">Edit User</h1>
    <form autocomplete="off" action="" method="post">
      <?php
      require 'config.php'; 
      $id = $_GET["id"];
      //$rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id"));
      $sql = "SELECT * from tb_user WHERE id=?;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,"s",$id);
      mysqli_stmt_execute($stmt);
      $user = mysqli_stmt_get_result($stmt);
      $rows = mysqli_fetch_assoc($user);
      ?>
      <div class="form-group was-validated">
      <input type="hidden" id="id" value="<?php echo $rows['id']; ?>">
      
      <label class="form-label" for="">Name</label>
        <input class="form-control" type="text" id="name" value="<?php echo $rows['name']; ?>"> 
        <div class="invalid-feedback">
            Please enter your Name
          </div>
        
        <label class="form-label" for="">Username</label>
        <input class="form-control" type="text" id="username" value="<?php echo $rows['username']; ?>"> 
        <div class="invalid-feedback">
            Please enter your username
          </div>
        
        <label class="form-label" for="">Password</label>
        <input class="form-control" type="text" id="password" value="<?php echo $rows['password']; ?>"> 
        <div class="invalid-feedback">
            Please enter your password
          </div>
             
        <button class="btn btn-success w-100" type="button" onclick="submitData('edit');">Edit</button>
          <a class="btn w-100 mt-2" href="profile.html" role="button">Go To Profile</a>
      </form>
    <br>
    <?php require 'script.php'; ?> 
   </body>
</html> 
