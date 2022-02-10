<?php 
include_once('../includes/dbConnection.php');



$allStories = mysqli_query($conn, "SELECT stories.*, categories.*,users.*
                                   FROM categories INNER JOIN stories INNER JOIN users
                                   ON stories.category_id = categories.c_id 
                                   AND stories.user_id = users.u_id
                                   AND stories.user_id = '{$_SESSION["user_id"]}'
                                   ORDER BY stories.s_id DESC");

if(isset($_GET['deleteStory']))
{
    $deleteStoryID = $_GET['deleteStoryID'];
    $delete_story = mysqli_query($conn, "DELETE FROM stories WHERE s_id = '$deleteStoryID'");
    if($delete_story)
    {
        echo "deleted";
        header("Location:viewStories.php");
    }
}

?>
<!DOCTYPE html>
<head>
   <title>Stories</title>
   <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <?php include_once('menubar.php') ?>
    <div class="container">
    <h3>All Stories

    <span class="float-right"><a href="addStory.php" class="btn btn-primary btn-sm">Add Story</a></span>
    </h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($allStories)){?>
                <tr>
                    <td><?php echo $row['title'] ?></td>
                    <td width="50%">
                        <textarea class="form-control"><?php echo $row['body'] ?></textarea>
                    </td>
                    <td width="15%"><?php echo $row['name'] ?></td>
                    <td><?php echo $row['status'] == 1 ? "<button class='btn btn-primary'>Active</button>" : "<button class='btn btn-danger'>Deactive</button>" ?></td>
                    <td class="d-flex">
                        <a href="editStory.php?id=<?php echo $row['s_id']?>" class="btn btn-info mr-1"><i class="fa fa-edit"></i></a>
                        <form action="viewStories.php" method="get">
                            <input type="hidden" name="deleteStoryID" value="<?php echo $row['s_id'] ?>">
                            <button type="submit" name="deleteStory" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </div>
</body>
</html>