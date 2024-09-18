<?php include('partials/menu.php') ?>


<style>
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
        <h1>Change Password</h1>
        <br><br>
         <?php
         if(isset($_GET['id']))
         {
            $id=$_GET['id'];
         }
         ?>
          
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                     <td>Current Password: </td>
                     <td>
                         <input type="password" name="current_password" placeholder="Current Password">
                     </td>
                </tr>

                <tr>
                     <td>New Password: </td>
                     <td>
                         <input type="password" name="new_password" placeholder="New Password">
                     </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                         <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td  colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                     <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                     </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit']))
{
    // echo " Clicked";  
    // 1. get the data from the form

              $id=$_POST['id'];
              $current_password = md5($_POST['current_password']);
              $new_password = md5($_POST['new_password']);
              $confirm_password = md5($_POST['confirm_password']);

              // 2. check wether the user with current id and current password exists or not
              $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
              // Execute the Query
              $res = mysqli_query($conn, $sql);

              if($res==true)
              {
                  //check wethere data is available or not.
                  $count=mysqli_num_rows($res);
        
                  if($count==1)
                  {
                      // user exist and password can be changed
                     // echo "user found";
                     //check wether the new password and confirm password match or not
                     if($new_password==$confirm_password)
                     {
                        //update password 
                       $sql2 = "UPDATE tbl_admin SET
                                 password='$new_password'
                                 WHERE id=$id";
                                 $res2 = mysqli_query($conn,$sql2);

                                //  check wethere the query execute or not
                                if($res2==true)
                                {
                                    //display succes message
                                     //redirect to manage admin page with the success message.
                                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                    header("location:".SITEURL.'admin/manage-admin.php'); 
                                }
                                else
                                {
                                    //display Error message
                                    //redirect to manage admin page with the error message.
                                    $_SESSION['change-pwd'] = "<div class='error'>Failed To CHange Password. </div>";
                                    header("location:".SITEURL.'admin/manage-admin.php'); 
                                }

                     }
                     else{
                        //redirect to manage admin page with the error message.
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password did not matched. </div>";
                        header("location:".SITEURL.'admin/manage-admin.php'); 

                     }


                  }
                  else
                  {
                       $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                       header("location:".SITEURL.'admin/manage-admin.php'); 
                  }
              }
    // 3. check wether the new password and confirm password match or not
    // 4. change password if all above is true
                  
}   

?>
            




<?php include('partials/footer.php'); ?>