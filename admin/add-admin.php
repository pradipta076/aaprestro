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
              <h1>Add Admin</h1>
              <br><br>
              
              <?php
              if(isset($_SESSION['add']))
              {
               echo $_SESSION['add'];
               unset($_SESSION['add']);
              }
               ?>    
              <form action="" method="POST">
                   <table class="tbl-30">
                       <tr>
                           <td>Full Name:</td>
                           <td><input type="text" name="full_name" placeholder="Enter your Full Name"></td>
                       </tr>
                               
                        <br><br> 

                       <tr>
                          <td>Username: </td>
                          <td>
                             <input type="text" name="username" placeholder="Your Username">
                          </td>
                       </tr>

                       <tr>
                          <td>Password: </td>
                          <td>
                             <input type="password" name="password" placeholder="Your password">
                          </td>
                       </tr>

                       <tr>
                          <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                          </td>
                       </tr>


                   </table>


              </form>


             </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
//Process the value from  form and save it in the database
//check wether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //Get the data from the form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);
    //SQL query to save the data into the database
    $sql= " INSERT INTO tbl_admin SET 
    full_name='$full_name',
    username='$username' ,
    password='$password' ";

   
//  Executing Query and saving Data into Database.

   $res = mysqli_query($conn, $sql) or die(mysqli_error());

   //  Chec Wether the Query is Executed data is inserted or not and display appropriate message.
    if($res==TRUE)
    {
      //echo" Data Inserted";
      //create a session variable to display the message.
       $_SESSION['add']="<div class='success'>ADMIN ADDED SUCCSESSFULLY.</div>";

      // Redirect page
      header("location:".SITEURL.'admin/manage-admin.php');

    }
    else
    {
      //echo" Data  not Inserted";
      // create a session variable to display the message.
      $_SESSION['add']="<div class='error'>FAILED TO ADD ADMIN. </div>";

      // Redirect page
      header("location:".SITEURL.'admin/manage-admin.php');
    }

}



?>