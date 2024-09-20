<?php include('partials/menu.php'); ?>

<style>
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
        </style>


<div class="main-content">
    <div class="wrapper">
       <h1>Manage Food</h1>

       <br/><br/>
           <!-- Button to Add Admin -->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br/><br/>

                <?php
                    

                    // Display success/error message
                    if (isset($_SESSION['add'])) 
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); // Clear the message after displaying it
                    }


                    if (isset($_SESSION['unauthorize'])) 
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']); // Clear the message after displaying it
                    }




                    if (isset($_SESSION['delete'])) 
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); // Clear the message after displaying it
                    }


                    if (isset($_SESSION['upload'])) 
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']); // Clear the message after displaying it
                    }

                   
                   ?>




      

<table class="tbl-full">
  <tr>
    <th>sl.no.</th>
    <th>Title</th>
    <th>Price</th>
    <th>Image</th>
    <th>Featured</th>
    <th>Active</th>
    <th>Actions</th>
  </tr>

  
     <?php
      $sql = "SELECT * FROM tbl_food";

      $res = mysqli_query($conn,$sql);

      $count = mysqli_num_rows($res);

      $sn = 1;

      if($count>0)
      {
           while($row = mysqli_fetch_assoc($res))
           {
              $id = $row['id'];
              $title = $row['title'];
              $price = $row['price'];
              $image_name = $row['image_name'];
              $featured = $row['featured'];
              $active = $row['active'];
              
              ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>

                        <td><?php 
                             if($image_name=="")
                             {
                              echo "<div class='error'> Image Not Added. </div>";
                             }
                             else
                             {
                              ?>
                              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" alt="">
                              <?php
                             }
                        
                             ?></td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        
                        <td>
                          <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;  ?>" class="btn-secondary">Update Food</a>
                          <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
    
                        </td>

                     </tr>

              <?php

           }
      }
      else
      {
        echo "<tr>  <td colspan='7' class='error'> Food Not Added Yet. </td> </tr> ";
      }
           
     ?>
 
</table>



    </div>
</div>

<?php include('partials/footer.php') ?>