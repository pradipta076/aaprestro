<?php ob_start(); ?>
<?php include('partials/menu.php'); ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #fad0c4, #ffd1ff);
        background-size: 400% 400%;
        animation: gradientBackground 15s ease infinite;
    }

    @keyframes gradientBackground {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .main-content {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
        box-sizing: border-box;
        animation: fadeIn 1s ease-in-out;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        transition: border-color 0.3s ease;
    }

    table.tbl-30 input[type="text"]:focus,
    table.tbl-30 input[type="number"]:focus,
    table.tbl-30 textarea:focus,
    table.tbl-30 select:focus {
        border-color: #f08a5d;
    }

    table.tbl-30 textarea {
        resize: vertical;
    }

    table.tbl-30 input[type="radio"] {
        margin-right: 5px;
    }

    .btn-secondary {
        background-color: #ff6b81;
        padding: 12px 20px;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: inline-block;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-size: 16px;
        margin-top: 20px;
    }

    .btn-secondary:hover {
        background-color: #ff4757;
        transform: scale(1.05);
    }

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

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>


<div class="main-content">
    <h1>Add Food</h1>
    <br><br>

    <?php
    if(isset($_SESSION['upload'])) {
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
                            // Create PHP code to display categories from the database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='{$id}'>{$title}</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
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
        // Check whether the button is clicked or not
        if(isset($_POST['submit'])) {
            // Get the data from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Upload the image if selected
            if(isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if($image_name != "") {
                    $image_parts = explode('.', $image_name);
                    $ext = strtolower(end($image_parts));

                    $image_name = "Food-Name-".rand(0000, 9999).".".$ext;
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/".$image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if($upload == false) {
                        $_SESSION['upload'] = "<div class='error'> Failed To Upload Image. </div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        // Stop the process if image upload fails
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            // Insert into the database
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'";

            $res2 = mysqli_query($conn, $sql2);

            // Check whether the query executed successfully or not
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // Failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed To Add Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ob_end_flush();
    ?>
</div>
<?php include('partials/footer.php'); ?>
