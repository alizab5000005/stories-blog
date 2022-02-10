<?php
include_once('includes/dbConnection.php');

if(isset($_POST['login']))
{
    $emial = $_POST['email'];
    $password = $_POST['password'];

    $user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$emial' AND password = '$password'");
    if(mysqli_num_rows($user) > 0)
    {
        $row = mysqli_fetch_assoc($user);
        $fname = $row['firstName'];
        $lname = $row['lastName'];
        $user_id = $row['u_id'];
        
        $_SESSION['valid'] = true;
        $_SESSION['username'] = $fname." ".$lname;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $row['role'];
        if($row['role'] == 1){

            header("Location:adminPanel/viewStories.php");
        }
        elseif($row['role'] == 2){

            header("Location:adminPanel/viewVendorStories.php");
        }
        else{
            header("Location:index.php");
        }
    }
    else
    {
        echo "invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
<?php include_once('menubar.php'); ?>
    <div class="container">
        <h3>Login</h3>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
                <p class="text-center">Not Registered yet? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>

</body>

</html>