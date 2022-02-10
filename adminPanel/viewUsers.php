<?php 
include_once('../includes/dbConnection.php');
if($_SESSION['role'] != 1){
    header("Location:../index.php");
}


$allUsers = mysqli_query($conn, "SELECT * FROM users WHERE role <> 1");

if(isset($_GET['deleteUser']))
{
    $deleteUserID = $_GET['deleteUserID'];
    echo $deleteUserID;
    $delete_user = mysqli_query($conn, "DELETE FROM users WHERE u_id = '$deleteUserID'");
    if($delete_user)
    {
        echo "deleted";
        header("Location:viewUsers.php");
    }

}


if(isset($_GET['changeRole']))
{
    $changeRoleID = $_GET['changeRoleID'];
    $check = mysqli_query($conn, "SELECT * FROM users WHERE u_id = '$changeRoleID'");
    $row = mysqli_fetch_assoc($check);
    if($row['role'] == 2)
    {

        $change_role = mysqli_query($conn, "UPDATE users SET role = 0 WHERE u_id = '$changeRoleID'");
        if($change_role)
        {
            echo "deleted";
            header("Location:viewUsers.php");
        }
    }
    elseif($row['role'] == 0)
    {

        $change_role = mysqli_query($conn, "UPDATE users SET role = 2 WHERE u_id = '$changeRoleID'");
        if($change_role)
        {
            echo "deleted";
            header("Location:viewUsers.php");
        }
    }

} 

if(isset($_GET['changeStatus']))
{
    $changeStatusID = $_GET['changeStatusID'];
    $check = mysqli_query($conn, "SELECT * FROM users WHERE u_id = '$changeStatusID'");
    $row = mysqli_fetch_assoc($check);
    if($row['status'] == 1)
    {
        $change_status = mysqli_query($conn, "UPDATE users SET status = 0 WHERE u_id = '$changeStatusID'");
        if($change_status)
        {
            echo "deleted";
            header("Location:viewUsers.php");
        }
    }
    elseif($row['status'] == 0)
    {
        $change_status = mysqli_query($conn, "UPDATE users SET status = 1 WHERE u_id = '$changeStatusID'");
        if($change_status)
        {
            echo "deleted";
            header("Location:viewUsers.php");
        }
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
    <h3>All Users</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Change Role</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($allUsers)){?>
                <tr>
                    <td><?php echo $row['firstName']." ".$row['lastName'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php if($row['status'] == 1){ ?> 
                    
                    <form action="viewUsers.php" method="get">
                    <input type="hidden" name="changeStatusID" value="<?php echo $row['u_id'] ?>">
                        <button name="changeStatus" class="btn btn-success">Activate</butto>
                    </form> 
                    <?php } else { ?>
                        
                    <form action="viewUsers.php" method="get">
                    <input type="hidden" name="changeStatusID" value="<?php echo $row['u_id'] ?>">
                    <button name="changeStatus" class="btn btn-warning">Deactivate</butto>
                    </form> 

                    <?php } ?>
                
                     </td>
                    <td><?php echo $row['role'] == 0 ? "Normal User" : "Vendor User" ?></td>
                    <td>
                        <form action="viewUsers.php" method="get">
                            <input type="hidden" name="changeRoleID" value="<?php echo $row['u_id'] ?>">
                            <button type="submit" class="btn btn-primary ml-1" name="changeRole">Change</button>
                        </form>
                    </td>
                    <td>
                        <form action="viewUsers.php" method="get">
                            <input type="hidden" name="deleteUserID" value="<?php echo $row['u_id'] ?>">
                            <button type="submit" class="btn btn-danger ml-1" name="deleteUser"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </div>
</body>
</html>