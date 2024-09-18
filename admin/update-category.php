<?php include('partials/menu.php'); ?>

<style>
    .wrapper{
    padding: 1%;
    width: 80%;
    margin: 0 auto;
    }
    .main-content{
        background-color: #f1f2f6;
        padding: 3% 0;
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
</style>

<div class="main-content">
     <div class="wrapper">

     
     <h1>Update Category</h1>

     <br><br>


     <?php
       if(isset($_GET['id']))
       {
        // Get the id and all other details
           $id = $_GET['id'];
           $sql = "SELECT *FROM tbl_category WHERE id=$id";

        //    execute the query
        $res = mysqli_query($conn,$sql);

        // count the rows
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //  get all the data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        }
        else
        {
            $_SESSION['no-categroy-found'] = "<div class='error'> Category not found. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
       }
       else
       {
        header('location:'.SITEURL.'admin/manage-category.php');
       }
     ?>
       <form action="" method="POST" enctype="multipart/form-data">

       <table>
          <tr>
              <td>Title: </td>
              <td>
                 <input type="text" name="title" value="<?php echo $title; ?>">
              </td>
          </tr>

          <tr>
             <td>Current Image: </td>
             <td>
               <?php
               if($current_image !="")
               {
                 ?>
                 <img src="<?php echo SITEURL ; ?>images/category/<?php echo $current_image ?>" width="150px">
                 <?php
               }
               else
               {
                echo "<div class='error'> Image Not Added. </div>";
               }


               ?>
             </td>
          </tr>

          <tr>
            <td>New Image: </td>
            <td>
                <input type="file" name="image">
            </td>
          </tr>

          <tr>
            <td>Featured: </td>
            <td>
                 <input <?php  if($featured=="Yes"){echo "checked";}  ?>  type="radio" name="featured" value="Yes">Yes
                 <input <?php  if($featured=="No"){echo "checked";}  ?>  type="radio" name="featured" value="No">No
                 
            </td>
          </tr>

          <tr>
             <td>Active: </td>
             <td>
             <input <?php  if($active=="Yes"){echo "checked";}  ?> type="radio" name="active" value="Yes">Yes
             <input <?php  if($active=="No"){echo "checked";}  ?>   type="radio"  name="active" value="No">No
            </td>
          </tr>
          <tr>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <td><input type="submit" name="submit" value="update category" class="btn-secondary"></td>
             
          </tr>
       </table>
       </form>
        
          <?php
            if(isset($_POST['submit']))
            {
              // Get all the values from our form
              $id = $_POST['id'];
              $title =  $_POST['title'];
              $current_image = $_POST['current_image'];
              $featured = $_POST['featured'];
              $active = $_POST['active'];

              // updating new img if selected
              // check wether the img is selected or not
              if(isset($_FILES['image']['name']))
              {
                // get the img details
                $image_name = $_FILES['image']['name'];

                if($image_name !="")
                {
                  // img available
                  //1.  Upload the new img

                    // auto rename our image
            
            $ext = end(explode(".", $image_name));

            // rename the image
           $image_name = "Food_Category_".rand(000,999).'.'.$ext;  //eg. Food_Category_876

              $source_path = $_FILES['image']['tmp_name'];
              $destination_path = "../images/category/".$image_name;

              $upload = move_uploaded_file($source_path ,$destination_path);

           // check wether the img uploade or not 
           // if not uploade 
           if($upload==false)
           {
               $_SESSION['upload'] = " <div class='error'> Failed to upload image. </div>";
               header('location:'.SITEURL.'admin/manage-category.php');
               die();
           }



                  // 2.  Remove the img
                  if($current_image!="")
                  {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
  
                    // Check wether the img is removed or not
                    if($remove==false)
                    {
                      // /Failed to remove
                      $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image. </div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
                      die();
                    }

                  }
                  

                }
                else
                {
                  $image_name = $current_image;  
                }


              }
              else
              {
                $image_name = $current_image;
              }

              // update databse
              $sql2 = "UPDATE tbl_category SET 
                       title = '$title' ,
                       image_name = '$image_name' ,
                       featured = '$featured' ,
                       active = '$active' WHERE id=$id "  ;

                       $res2 = mysqli_query($conn,$sql2);

                      //  redirect to manage catrgory with message
                      // check wether query executed or not
                      if($res2==true)
                      {
                        $_SESSION['update'] = "<div class='success'> Updated Successfully. </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                      }
                      else
                      {
                        $_SESSION['update'] = "<div class='error'> Failed to Update Category. </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                      }









            }



          ?>


     </div>
</div>

<?php include('partials/footer.php'); ?>