<?php include('partials/menu.php'); ?>

<style>
    /* Base styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    /* Main container styles */
    .main-content {
        background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        box-sizing: border-box;
        animation: fadeIn 1.5s ease;
    }

    /* Form wrapper */
    .wrapper {
        padding: 2%;
        width: 90%;
        margin: 0 auto;
    }

    h1 {
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
        animation: slideInDown 1s ease-out;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: scaleUp 0.8s ease-out;
    }

    table td {
        padding: 12px;
        vertical-align: top;
    }

    table td:first-child {
        text-align: right;
        padding-right: 20px;
        font-weight: bold;
    }

    table input[type="text"],
    table input[type="number"],
    table textarea,
    table select,
    table input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        margin-top: 5px;
        transition: transform 0.3s ease;
    }

    table input[type="text"]:hover,
    table input[type="number"]:hover,
    table textarea:hover,
    table select:hover,
    table input[type="file"]:hover {
        transform: scale(1.03);
    }

    table textarea {
        resize: vertical;
    }

    table input[type="radio"] {
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
        transition: background-color 0.3s ease, transform 0.3s ease;
        font-size: 16px;
        margin-top: 20px;
    }

    .btn-secondary:hover {
        background-color: #2ed573;
        transform: translateY(-3px);
    }

    /* Keyframes for animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes scaleUp {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        table td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        table input[type="text"],
        table input[type="number"],
        table textarea,
        table select,
        table input[type="file"] {
            width: calc(100% - 22px);
            margin: 0 auto;
        }

        table td:first-child {
            text-align: left;
            padding-right: 0;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .main-content {
            padding: 10px;
        }

        .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }
</style>




<?php
   if(isset($_GET['id']))
   {
      $id = $_GET['id'];

      $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

      $res2 = mysqli_query($conn,$sql2);

      $row2 = mysqli_fetch_assoc($res2);
           
      $title = $row2['title'];
      $description = $row2['description'];
      $price = $row2['price'];
      $current_image = $row2['image_name'];
      $featured = $row2['featured'];
      $active = $row2['active'];

   }
   else
   {
    header('location:'.SITEURL.'admin/manage-food.php');
   }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" > <?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                       <?php
                          if($current_image=="")
                          {
                            echo "<div class='error'> IMAGE NOT AVAILABLE> </div>";
                          }
                          else
                          {
                             ?>
                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="170px" alt="">
                             <?php
                          }
                       ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                             <?php
                               $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                               $res = mysqli_query($conn,$sql);
                               $couunt = mysqli_num_rows($res);

                               if($couunt>0)
                               {
                                   while($row = mysqli_fetch_assoc($res))
                                   {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    


                                    echo "<option value='$category_id'>$category_title</option>";
                                    
                                   }
                                
                               }
                               else
                               {
                                echo "<option value='0'> category Not Available. </option>";
                               }



                            ?>
                            
                           
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
