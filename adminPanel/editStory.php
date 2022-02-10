<?php 

include_once('../includes/dbConnection.php');

$edit_story_id = $_GET['id'];

$story = mysqli_query($conn, "SELECT stories.*, categories.*
                              FROM categories INNER JOIN stories
                              ON stories.category_id = categories.c_id
                              AND stories.s_id = '$edit_story_id'");
$row = mysqli_fetch_assoc($story);

$title = $row['title'];
$category = $row['name'];
$category_id = $row['category_id'];
$body = $row['body'];

$categories = mysqli_query($conn, "SELECT * FROM categories WHERE status = 1 AND c_id != '$category_id'");


if(isset($_POST['updateStory']))
{
    $title = $_POST['title'];
    $category = $_POST['category_id'];
    $body = $_POST['body'];

    echo $title.$category.$body;

    $updateStory = mysqli_query($conn, "UPDATE stories SET category_id = '$category', title = '$title', body = '$body'
                                        WHERE s_id = '$edit_story_id'");


    if($updateStory && $_SESSION['role'] == 1)
    {
        header("Location:viewStories.php");
    }
    elseif($updateStory && $_SESSION['role'] == 2)
    {
        header("Location:viewVendorStories.php");
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
        <h3>Add Story</h3>
        <form action="editStory.php?id=<?php echo $edit_story_id ?>" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="title">Story Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo $title ?>">
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="title">Categories</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="<?php echo $category_id ?>"><?php echo $category ?></option>
                            <?php while($row = mysqli_fetch_assoc($categories)){?>
                            <option value="<?php echo $row['c_id'] ?>"><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Story Body</label>
                <textarea name="body" id="body" class="form-control" ><?php echo $body ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="updateStory" value="Update Story" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>

</body>

</html>