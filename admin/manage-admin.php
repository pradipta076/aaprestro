<?php include('partials/menu.php') ?>
<style>
  .tbl-30{
        width: 30%;
    }
       .tbl-full{
         width: 100%;
               }

      table tr th{
        border-bottom: 1px solid black;
        padding: 1%;
        text-align:left;
                 }
      table tr td{
        padding: 1%;
              }
      .btn-primary{
             
           background-color: #1e90ff;
           padding: 1%;
           color:white;
           text-decoration:none;
           font-weight:bold;

           }
          .btn-primary:hover{
            background-color:#3742fa;
          }

          .btn-secondary{
             
             background-color: #7bed9f ;
             padding: 1%;
             color:#2f3542;
             text-decoration:none;
             font-weight:bold;
  
             }
            .btn-secondary:hover{
              background-color:#2ed573;


            }
            .btn-danger{
             
             background-color: #ff4757;
             padding: 1%;
             color:white;
             text-decoration:none;
             font-weight:bold;
  
             }
            .btn-danger:hover{
              background-color:#ff6348;
            }
            .success{
        color:#2ed573;
    }
    .error{
        color: #ff4757;
    }
    
           </style>
          <!-- Main Content section starts -->
        <div class="main-content">
           <div class="wrapper">
           <h1>Manage Admin</h1>
            <br/><br/>


            <?php
            if(isset($_SESSION['add']))
            {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }
             
            if(isset($_SESSION['user-not-found']))
            {
              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
              echo $_SESSION['pwd-not-match'];
              unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
              echo $_SESSION['change-pwd'];
              unset($_SESSION['change-pwd']);
            }
            
            

            

            ?>

<br/><br/> <br>
           <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br/><br/>

           <table class="tbl-full">
             <tr>
               <th>sl.no.</th>
               <th>Full Name</th>
               <th>username</th>
               <th>Action</th>
             </tr>

                <?php
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                  $count = mysqli_num_rows($res);
                   
                  $sn=1; //create avariable and assign the value
                  // check the number of rows
                  if($count>0)
                  {
                    // we have Data in Database
                         while($rows=mysqli_fetch_assoc($res))
                          {

                          $id=$rows['id'];
                          $full_name=$rows['full_name'];
                          $username = $rows['username'];

                          // Display the values in our table
                          ?>
                           
                           <tr>
                                 <td><?php echo $sn++; ?></td>
                                 <td><?php echo $full_name; ?></td>
                                 <td><?php echo $username; ?></td>
                                 <td>
                                     <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary"> Change Password</a>
                                     <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                     <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
               
                                 </td>

                                </tr>

                   


                          <?php
                        }
                  }
                  else{
                    // we do not have any Data in Database
                  }
                }
                ?>
 


             
             </table>
        </div>

     </div>
         <!-- Main Content section ends-->


         <?php include('partials/footer.php') ?>