


<?php


// Include constants.php file
include('../config/constants.php');



//  get the id of admin to be deleted
$id = $_GET['id'];


// Create SQL Query to Delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the Query
$res = mysqli_query($conn,$sql);

// check wether the query executed successfully or not
if($res==true)
{
    // echo " Admin Deleted";
    $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully. </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    // echo "Failed to Deleted Admin";
    $_SESSION['delete']= "<div class='error'>Failed to Deleted Admin. </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// Redirect to Manage Admin page with message


?>