<?php include('partials/menu.php'); ?>
<style>
    .tbl-30{
        width: 30%;
    }
    .btn-secondary{
             
             background-color: #7bed9f ;
             padding: 1%;
             color:#2f3542;
             text-decoration:none;
             font-weight:bold;
     }
     
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
            <br><br>
              
            <?php
                //  get the id of selected admin
                $id=$_GET['id'];
                $sql="SELECT * FROM tbl_admin WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                     $row=mysqli_fetch_assoc($res);
                     $full_name = $row['full_name'];
                     $username = $row['username'];
                    }
                    else{
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                    echo "";
                }
                else{
                    echo "";
                }
            ?>

            <form action="" method="POST">
              <table class="tbl-30">
                <tr>
                     <td>Full Name: </td>
                     <td>
                          <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                     </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update admin" class="btn-secondary">
                    </td>
                    
                </tr>

              </table>
        </form>
    </div>
</div>


<?php
//    check wether the submit button clicked or not
if(isset( $_POST['submit']))
{
    // get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql= "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id = '$id'";

    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
      $_SESSION['update'] = "<div class='success'>ADMIN UPDATED SUCCESSFULLY.</div>";
      header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='success'>FAILED TO UPDATED ADMIN.</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
}

?>


<?php include('partials/footer.php') ?>