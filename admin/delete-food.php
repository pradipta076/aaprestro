<?php
include('../config/constants.php');

// check wether the value is passed on url or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // process to Delete
//    Get id and image_name
$id = $_GET['id'];
$image_name = $_GET['image_name'];

// remove the image if available
if($image_name != "")
{
    // Get the Image path
    $path = "../images/food/".$image_name;

    // remove img file from folder
    $remove = unlink($path);

// check wether the img is removed or not
if($remove==false)
{
    $_SESSION['upload'] = "<div class='error'> Failed To Remove Image File. </div>";
    header('location:'.SITEURL.'admin/manage-food.php');
    die();
}
}

// Delete food from database
$sql = "DELETE FROM tbl_food WHERE id=$id";

$res = mysqli_query($conn,$sql);

// Redirect to manage-food with session message
if($res==true)
{
    $_SESSION['delete'] = "<div class='success'> Food Deleted Successfully. </div>";
    header('location:'.SITEURL.'admin/manage-food.php');  
}
else
{
    $_SESSION['delete'] = "<div class='error'> Failed To Delete Food. </div>";
    header('location:'.SITEURL.'admin/manage-food.php');    
}


}
else
{
    // Redirect to Manage-food page
    $_SESSION['unauthorize'] = "<div class='error'> Unauthorized Access. </div>";
    header('location:'. SITEURL .'admin/manage-food.php');
}
?>