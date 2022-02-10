<?php
include_once('includes/dbConnection.php');

$s_id = $_GET['s_id'];

$story = mysqli_query($conn, "SELECT stories.*, users.*
                              FROM stories INNER JOIN users
                              ON stories.user_id = users.u_id
                              AND stories.s_id = '$s_id'");
$row = mysqli_fetch_assoc($story);


$category_id = $row['category_id'];
$stories_you_may_like = mysqli_query($conn, "SELECT stories.*, users.*, categories.*
                                             FROM stories INNER JOIN users INNER JOIN categories
                                             ON stories.user_id = users.u_id
                                             AND stories.category_id = categories.c_id
                                             AND stories.category_id = '$category_id'
                                             AND stories.s_id <> '$s_id'
                                             AND stories.status = 1");



if(isset($_POST['submitComment']))
{
    $comment = $_POST['comment'];
    
    $u_id = $_SESSION['user_id'];
    $date = date("j F Y");

    $insertComment = mysqli_query($conn, "INSERT INTO comments (story_id, user_id, comment, date)
                                           VALUES ('$s_id','$u_id','$comment','$date')");
    
}

$comments = mysqli_query($conn, "SELECT comments.*, users.* 
                                 FROM comments INNER JOIN users
                                 ON comments.story_id = '$s_id'");


?>

<!DOCTYPE html>
<html>

<head>
    <title>dftg</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body style="padding: 0; margin: 0" class="bg-light ">
    <?php include_once('menubar.php'); ?>

    <div class="container">
        <div class="card my-2">
            <div class="card-header bg-dark text-light">
                <h4><?php echo $row['title'] ?></h4>
            </div>
            <div class="card-body">
                <p><?php echo $row['body'] ?></p>
                <p class="text-center " >
							<span class="bg-dark text-light p-2 mt-2 rounded-pill">	
						    <i class="fa fa-user mx-1"></i> 	<?php echo $row['firstName'] . " " . $row['lastName'].
							 "  <i class='fa fa-calendar mx-1'></i>" . $row['date'] ?>
							</span>
							</p>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Leave a Comment </h5>
                        <form action="fullStory.php?s_id=<?php echo $s_id ?>" method="post">
                            <textarea name="comment" class="form-control" rows="8"></textarea>
                            <button type="submit" name="submitComment" class="btn btn-primary my-2 btn-block">Send</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <h5>Read Comments</h5>
                        <div style="height:260px; overflow:scroll; overflow-x:hidden">
                        <?php while($row = mysqli_fetch_assoc($comments)) { ?>
                        <p> <strong><?php echo $row['firstName']." ".$row['lastName'] ?> : </strong>
                        <?php echo $row['comment'] ?>
                        </p>
                        <hr>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-4">
            <div class="row">
                <?php while ($r = mysqli_fetch_assoc($stories_you_may_like)) { ?>
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h4><?php echo $r['title'] ?></h4>
                            </div>
                            <div class="card-body">
                                <p><?php echo substr($r['body'], 0, 150) ?><a href="fullStory.php?s_id=<?php echo $r['s_id'] ?>">Read More</a></p>
                                <p class="text-center " >
							<span class="bg-dark text-light p-2 mt-2 rounded-pill">	
						    <i class="fa fa-user mx-1"></i> 	<?php echo $r['firstName'] . " " . $r['lastName'].
							 "  <i class='fa fa-calendar mx-1'></i>" . $r['date'] ?>
							</span>
							</p>
                         </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <footer class="bg-dark p-3 text-light">
		<h5 class="text-center ">All Rights Reserved</h5>
	</footer>
</body>

</html>