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
     .success{
        color:#2ed573;
    }
    .error{
        color: #ff4757;
    }
     
</style>

<div class="main-content">
      <div class="wrapper">
          <h1>Add Category</h1>

          <br><br>

          <?php
          if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
          if(isset($_SESSION['upload']))
          {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
          ?>
             <br><br>
           
           <form action="" method="POST" enctype="multipart/form-data">
               <table class="tbl-30">
                <tr>
                  <td>Title: </td>
                  <td>
                     <input type="text" name="title" placeholder="category Title">
                  </td>
                  </tr>


                  <tr>
                     <td>Select Image: </td>
                     <td>
                        <input type="file" name="image">
                     </td>
                  </tr>

                  <tr>
                     <td>Featured: </td>
                     <td>
                         <input type="radio" name="featured" value="Yes"> Yes
                         <input type="radio" name="featured" value="No"> No
                     </td>
                  </tr>

                  <tr>
                     <td>Active: </td>
                     <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                     </td>
                  </tr>

                  <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                  </tr>

               </table>
           </form>
          


           <?php
           if(isset($_POST['submit']))
           {
        //    get the values from form 
            $title = $_POST['title'];
            
            
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }

            //  active 
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // check wether the img is selected or not and set the img value accoridingly
            if(isset($_FILES['image']['name']))
            {
               $image_name = $_FILES['image']['name'];

            //    upload the image only if image is selected
            if($image_name !="")
            {

            

            // auto rename our image
            // get
            $ext = end(explode('.', $image_name));

             // rename the image
            $image_name = "Food_Category_".rand(000,999).'.'.$ext;  //eg. Food_Category_876

               $source_path = $_FILES['image']['tmp_name'];
               $destination_path = "../images/category/".$image_name;

               $upload = move_uploaded_file($source_path ,$destination_path);

            //    check wether the img uploade or not 
            // if not uploade 
            if($upload==false)
            {
                $_SESSION['upload'] = " <div class='error'> Failed to upload image. </div>";
                header('location:'.SITEURL.'admin/add-category.php');
                die();
            }
        }
            }
            else
            {
                $image_name="";
            }
            
            // sql query
            $sql = "INSERT INTO tbl_category SET 
                     title='$title' ,
                     image_name='$image_name',
                     featured='$featured' ,
                     active='$active' ";

            //   executr the query
            $res= mysqli_query($conn,$sql);
            if($res==true)
            {
               $_SESSION['add'] = "<div class='success'> Category Added Successfully. </div>";
               header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'> Fail to add Category. </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

           }

           
           ?>
           
      </div>

</div>




<?php include('partials/footer.php') ?>