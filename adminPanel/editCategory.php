<?php
include_once('../includes/dbConnection.php');

if($_SESSION['role'] != 1){
    header("Location:../index.php");
}

$edit_category_id = $_GET['id'];
$category = mysqli_query($conn, "SELECT * FROM categories WHERE c_id = '$edit_category_id'");
$row = mysqli_fetch_assoc($category);

if(isset($_POST['updateCategory']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];

    $updateCategory = mysqli_query($conn, "UPDATE categories SET name = '$name', description = '$description'
                                          WHERE c_id = '$edit_category_id'");
    if($updateCategory)
    {
        header("Location: viewCategories.php");
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
        <h3>Edit Cateogy</h3>
        <form action="editCategory.php?id=<?php echo $edit_category_id?>" method="post">
            <div class="form-group">
                <label for="name">Cateogy Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name'] ?>">
            </div>

            <div class="form-group">
                <label for="description">Cateogy Description</label>
                <textarea name="description" id="description" class="form-control" rows="2"><?php echo $row['description'] ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="updateCategory" value="Update Category" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>

</body>

</html>