<?php 

include_once('../includes/dbConnection.php');
if($_SESSION['role'] != 1){
    header("Location:../index.php");
}

if(isset($_POST['addCategory']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];

    echo $name;
  
    $insertCategory = mysqli_query($conn, "INSERT INTO categories (name, description)
                                VALUES ('$name', '$description')");

    if($insertCategory)
    {
        header("Location:viewCategories.php");
    }


}

?>

<!DOCTYPE html>
<head>
   <title>Document</title>
   <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <?php include_once('menubar.php') ?>

<body>
    <div class="container">
        <h3>Add Category</h3>
        <form action="addCategory.php" method="post">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
            </div>

            <div class="form-group">
                <label for="description">Category Description</label>
                <textarea name="description" id="description" class="form-control" rows="2" placeholder="Category Description"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="addCategory" value="Add Category" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>

</body>

</html>