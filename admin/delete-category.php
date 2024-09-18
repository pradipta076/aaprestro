<?php

include('../config/constants.php');
// check wether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // get the value and Delet
    $id = $_GET['id'];
    $image_name = $_get['image_name'];

    // remove the physical img file is available
    if($image_name !="")
    {
        // img is available so 
        $path = "../images/category/".$image_name;
        // Remove the img
        $remove = unlike($path);
        //   If failed to remove img then add an error message and stop the process
        if($remove==false)
        {
            // Set the SESSION Message
            $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image. </div>";
            // Redirect to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');
            // Stop the Process
            die();
        }
    }

    // delete data feom Database
    // sql query to Delete  Data from Database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
      $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully. </div>";
      header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'> Failed to Delete Category. </div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    // Redirect to manage category page

}
else
{
    // Redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>