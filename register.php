<?php
include_once('includes/dbConnection.php');

if(isset($_POST['register']))
{
  $fname = $_POST['firstName'];
  $lname = $_POST['lastName'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cPassword = $_POST['cPassword'];

  if($password == $cPassword)
  {
    $insertUser = mysqli_query($conn, "INSERT INTO users (firstName, lastName, phone, email, password)
                                        VALUES('$fname','$lname','$phone','$email','$password')");
    if($insertUser)
    {
      $user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
      $row = mysqli_fetch_assoc($user);
      $user_id = $row['u_id'];
      $_SESSION['valid'] = true;
      $_SESSION['username'] = $fname." ".$lname;
      $_SESSION['user_id'] = $user_id;
      header("Location:index.php");
    }
  }
  else
  {
    echo "Passwords did not match!";
  }

}


?>


<!DOCTYPE html>
<html>

<head>
  <title>dftg</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body style="padding: 0; margin: 0">
  <?php include_once('menubar.php'); ?>


  
  <div class="container">
    <h3>Register</h3>
    <form action="register.php" method="post">
      <div class="row">
        <div class="form-group col-lg-6">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" id="name" class="form-control" placeholder="Enter your first name">
        </div>
        <div class="form-group col-lg-6">
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" id="name" class="form-control" placeholder="Enter your last name">
        </div>

      </div>
      <div class="row">
        <div class="form-group  col-lg-6">
          <label for="phone">Phone Number</label>
          <input type="phone" name="phone" id="phone" class="form-control" placeholder="Enter your phone">
        </div>
        <div class="form-group col-lg-6">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-lg-6">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="type your password">

        </div>
        <div class="form-group col-lg-6">
          <label for="cPassword">Confirm Password</label>
          <input type="password" name="cPassword" id="password" class="form-control" placeholder="type your password again">

        </div>
      </div>
      <div class="form-group">
        <input type="submit" name="register" value="Register" class="btn btn-primary btn-block">
        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
      </div>
    </form>
  </div>

</body>

</html>