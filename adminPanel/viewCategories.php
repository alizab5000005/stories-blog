<?php 
include_once('../includes/dbConnection.php');
if($_SESSION['role'] != 1){
    header("Location:../index.php");
}

$allCategories = mysqli_query($conn, "SELECT * FROM categories");

if(isset($_GET['deleteCat']))
{
    $deleteCategory = $_GET['deleteCategory'];
    $delete_category = mysqli_query($conn, "DELETE FROM categories WHERE c_id = '$deleteCategory'");
    if($delete_category)
    {
        echo "deleted";
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
    <div class="container">
    <h3>All Categories

    <span class="float-right"><a href="addCategory.php" class="btn btn-primary btn-sm">Add Category</a></span>
    </h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($allCategories)){?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['status'] == 1 ? "<button class='btn btn-primary'>Active</button>" : "<button class='btn btn-danger'>Deactive</button>" ?></td>
                    <td class="d-flex">
                        <a href="editCategory.php?id=<?php echo $row['c_id']?>" class="btn btn-info"><i class="fa fa-edit"></i></a> 
                        <form action="viewCategories.php" method="get">
                            <input type="hidden" name="deleteCategory" value="<?php echo $row['c_id'] ?>">
                            <button type="submit" class="btn btn-danger ml-1" name="deleteCat"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </div>
</body>
</html>