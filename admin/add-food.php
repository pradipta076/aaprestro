<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>



 <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .main-content {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        table.tbl-30 {
            width: 100%;
            border-collapse: collapse;
        }

        table.tbl-30 td {
            padding: 12px;
            vertical-align: top;
        }

        table.tbl-30 td:first-child {
            text-align: right;
            padding-right: 20px;
            font-weight: bold;
        }

        table.tbl-30 input[type="text"],
        table.tbl-30 input[type="number"],
        table.tbl-30 textarea,
        table.tbl-30 select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            margin-top: 5px;
        }

        table.tbl-30 textarea {
            resize: vertical;
        }

        table.tbl-30 input[type="radio"] {
            margin-right: 5px;
        }

        .btn-secondary {
            background-color: #7bed9f;
            padding: 12px 20px;
            color: #2f3542;
            text-decoration: none;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-top: 20px;
        }

        .btn-secondary:hover {
            background-color: #2ed573;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table.tbl-30 td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            table.tbl-30 input[type="text"],
            table.tbl-30 input[type="number"],
            table.tbl-30 textarea,
            table.tbl-30 select {
                width: calc(100% - 22px);
                margin: 0 auto;
            }

            table.tbl-30 td:first-child {
                text-align: left;
                padding-right: 0;
                font-weight: normal;
                margin-bottom: 10px;
            }
        }
    </style>

    <div class="main-content">
        <h1>Add Food</h1>

        <br><br>


        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }



        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">  
                               
                             <?php
                                //   create php code top display categories from database
                                // create sql to get active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn,$sql);

                                $count = mysqli_num_rows($res);

                                if($count>=0)
                                {
                                //    we have category
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                                
                                }
                                else 
                                {
                                    // we do not have category

                                    ?>
                                      <option value="0">No Category Found</option>
                                    <?php
                                }

                            ?>
                            
                             
                           
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

          <?php

          
            // check wether the button is clicked or not
            if(isset($_POST['submit']))
            {
                // get the data from from

                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                // Upload the image if selected
                // check wether the select img is clicked or not and upload
                if(isset($_FILES['image']['name']))
                {
                   $image_name = $_FILES['image']['name'];
                   if($image_name!="")
                   {
                    // get the extention of selected image(jpg,png etc.)

                    $image_parts = explode('.', $image_name);
                    $ext = strtolower(end($image_parts)); // Convert extension to lowercase for consistency

                    $image_name = "Food-Name-".rand(0000,9999).".".$ext;


                    $src = $_FILES['image']['tmp_name'];

                    $dst = "../images/food/".$image_name;

                    $upload = move_uploaded_file($src,$dst);

                    if($upload==false)
                    {
                        $_SESSION['upload'] = "<div class='error'> Failed To Upload Image. </div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                         die();
                    }
                    
                   }  
                }
                else
                {
                    $image_name = "";
                }
                // insert into database
                // create a sql query to save or add food
                

                $sql2 = "INSERT INTO tbl_food SET
                title = '$title' ,
                description = '$description' ,
                price = $price ,
                image_name = '$image_name' ,
                category_id = '$category' ,
                featured = '$featured' ,
                active = '$active' ";

                $res2 = mysqli_query($conn,$sql2);

                if ($res2 == true)
                 {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                } 
                else
                 {
                    $_SESSION['add'] = "<div class='error'>Failed To Add Food.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
            }
            ob_end_flush(); 
          ?>

     </div>
<?php include('partials/footer.php'); ?>