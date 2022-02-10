<?php 

include_once('../includes/dbConnection.php');

$categories = mysqli_query($conn, "SELECT * FROM categories WHERE status = 1");


if(isset($_POST['addStory']))
{
    $title = $_POST['title'];
    $category = $_POST['category_id'];
    $body = $_POST['body'];
    $date = date("j F Y");

    

    $insertStory = mysqli_query($conn, "INSERT INTO stories (user_id, category_id, title, body, date)
                                VALUES ('{$_SESSION["user_id"]}', '$category', '$title', '$body', '$date')");

    if($insertStory)
    {
        header("Location:viewStories.php");
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
        <form action="addStory.php" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="title">Story Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="write your story's title">
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="title">Categories</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">--Select Story Cateogy--</option>
                            <?php while($row = mysqli_fetch_assoc($categories)){?>
                            <option value="<?php echo $row['c_id'] ?>"><?php echo $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="title">Story Body</label>
                <textarea name="body" id="body" class="form-control" rows="6" placeholder="write your story"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="addStory" value="Add Story" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>

</body>

</html>