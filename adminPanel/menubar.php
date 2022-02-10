<?php 
if(!isset($_SESSION['valid']))
{
  header("Location:../login.php");
}
elseif($_SESSION['role'] == 0){
  header("Location:../index.php");
}


?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      
      <li class="nav-item active">
        <a class="nav-link" href="addStory.php">Add Story</a>
      </li>
      <?php if($_SESSION['role'] == 2){ ?>
        <li class="nav-item active">
        <a class="nav-link" href="viewVendorStories.php">Stories</a>
      </li>
      <?php } ?>
      <?php if($_SESSION['role'] == 1){ ?>
        <li class="nav-item active">
        <a class="nav-link" href="viewStories.php">Stories</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="viewCategories.php">Categories </a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" href="addCategory.php">Add Category </a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" href="viewUsers.php">Users </a>
      </li>
      <?php } ?>
    
      
     
    </ul>
    <div class="my-2 my-lg-0">
     
      <a href="../logOut.php" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>
    </div>
  </div>
</nav>