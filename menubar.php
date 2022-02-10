<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Read Stories</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      
 
     
    </ul>
    
    <div class="my-2 ml-auto my-lg-0">
        <?php if(isset($_SESSION['valid'])) { ?>
            <a href="logOut.php" name="logOut" class="text-light text-decoration-none">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="text-light text-decoration-none mr-2">SignIn</a>
            <a href="register.php" class="text-light text-decoration-none mr-2">SignUp</a>
        <?php } ?>
    </div>
    

    </div>
</nav>