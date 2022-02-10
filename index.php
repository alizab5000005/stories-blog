<?php


include_once('includes/dbConnection.php');
$allStories = mysqli_query($conn, "SELECT stories.*, users.*
                                   FROM stories INNER JOIN users 
                                   ON stories.user_id = users.u_id 
                                   WHERE stories.status = 1");


$popularStories = mysqli_query($conn, "SELECT stories.*, users.*
								   FROM stories INNER JOIN users 
								   ON stories.user_id = users.u_id 
								   WHERE stories.status = 1
								   AND stories.popular = 1");


$categories = mysqli_query($conn, "SELECT * FROM categories WHERE status = 1");

$users = mysqli_query($conn, "SELECT * FROM users WHERE status = 1 AND role = 1");


if (isset($_GET['category'])) {
	$category = $_GET['category'];
	$allStories = mysqli_query($conn, "SELECT stories.*, users.*
                                   FROM stories INNER JOIN users 
                                   ON stories.user_id = users.u_id 
                                   WHERE stories.status = 1
								   AND stories.category_id = '$category' ");
}

$comments = mysqli_query($conn, "SELECT comments.*, stories.*
 								 FROM comments INNER JOIN stories
								  ON stories.s_id = comments.story_id");


if(isset($_GET['searchbtn']))
{
	$searchInput = $_GET['searchInput'];
	$allStories = mysqli_query($conn, "SELECT stories.*, users.*
	FROM stories INNER JOIN users 
	ON stories.user_id = users.u_id 
	WHERE stories.status = 1
	AND stories.title LIKE '%$searchInput%' ");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>dftg</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body style="padding: 0; margin: 0" class="bg-light">
	<?php include_once('menubar.php'); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php while ($row = mysqli_fetch_assoc($allStories)) { ?>
					<div class="card my-3">
						<div class="card-header bg-dark text-light">
							<h4><?php echo $row['title'] ?></h4>
						</div>
						<div class="card-body">
							<p><?php echo substr($row['body'], 0, 300) ?> ....<a href="fullStory.php?s_id=<?php echo $row['s_id'] ?>">Read More</a></p>
							<p class="text-center ">
								<span class="bg-dark text-light p-2 mt-2 rounded-pill">
									<i class="fa fa-user mx-1"></i> <?php echo $row['firstName'] . " " . $row['lastName'] .
																		"  <i class='fa fa-calendar mx-1'></i>" . $row['date'] ?>
								</span>
							</p>

						</div>

					</div>
				<?php } ?>
			</div>
			<div class="col-lg-4">

				<div class="my-3">
					
					<form action="" method="get" class="d-flex">
						<input type="text" name="searchInput" class="form-control" placeholder="Search your favorite Stoies">
						<button type="submit" class="btn btn-dark" name="searchbtn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="my-3">
					<h4>All Categories</h4>


					<form action="" method="get">
						<?php while ($row = mysqli_fetch_assoc($categories)) { ?>
							<button type="submit" name="category" value="<?php echo $row['c_id'] ?>" class="btn btn-dark btn-block"><?php echo $row['name'] ?></button>
						<?php } ?>
					</form>
				</div>



				<div class="my-3">
					<h4>Popular Stories</h4>


					<form action="" method="get">
						<?php while ($row = mysqli_fetch_assoc($popularStories)) { ?>
							<div class="card my-3">
								<div class="card-header  bg-dark text-light">
									<h5><?php echo $row['title'] ?></h5>
								</div>
								<div class="card-body">
									<p><?php echo substr($row['body'], 0, 100) ?> ....<a href="fullStory.php?s_id=<?php echo $row['s_id'] ?>">Read More</a></p>
									<p class="text-center ">
										<span class="bg-dark text-light p-2 mt-2 rounded-pill">
											<i class="fa fa-user mx-1"></i> <?php echo $row['firstName'] . " " . $row['lastName'] .
																				"  <i class='fa fa-calendar mx-1'></i>" . $row['date'] ?>
										</span>
									</p>
								</div>
							</div>
						<?php } ?>
					</form>
				</div>

				<div>
					<h4>Popular Authors</h4>
					<form action="" method="get">
						<?php while ($row = mysqli_fetch_assoc($users)) { ?>
							<button type="submit" name="user" value="<?php echo $row['u_id'] ?>" class="btn btn-dark btn-block"><?php echo $row['firstName'] . " " . $row['lastName'] ?></button>
						<?php } ?>
					</form>
				</div>



			</div>
		</div>
	</div>


	<footer class="bg-dark p-3 text-light">
		<h5 class="text-center ">All Rights Reserved</h5>
	</footer>

</body>

</html>