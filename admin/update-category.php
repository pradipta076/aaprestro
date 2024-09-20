<?php include('partials/menu.php'); ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .wrapper {
        padding: 2%;
        width: 80%;
        margin: 0 auto;
    }

    .main-content {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 3% 5%;
        margin-top: 30px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    table {
        width: 70%;
        margin: 0 auto; /* Center the table */
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #f8f9fa;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Shadow effect */
        border-radius: 10px;
        overflow: hidden;
    }

    table td {
        padding: 15px;
        vertical-align: top;
        border-bottom: 1px solid #ddd;
    }

    table tr:last-child td {
        border-bottom: none; /* Remove bottom border from last row */
    }

    table td:first-child {
        text-align: right;
        padding-right: 20px;
        font-weight: bold;
        color: #555;
    }

    table input[type="text"],
    table input[type="file"],
    table textarea,
    table select {
        width: 90%; /* Reduce width slightly to fit table design */
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        margin-top: 5px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    table input[type="text"]:focus,
    table input[type="file"]:focus,
    table textarea:focus,
    table select:focus {
        border-color: #6c5ce7;
        box-shadow: 0 0 8px rgba(108, 92, 231, 0.5);
    }

    table input[type="radio"] {
        margin-right: 8px;
    }

    .btn-secondary {
        background-color: #6c5ce7;
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
        background-color: #4b4b8f;
        transform: scale(1.05);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .wrapper {
            width: 90%;
        }

        table {
            width: 100%;
            box-shadow: none; /* Remove shadow on smaller screens */
        }

        table td:first-child {
            text-align: left;
            padding-right: 0;
            font-weight: normal;
            margin-bottom: 10px;
        }

        table input[type="text"],
        table input[type="file"],
        table textarea,
        table select {
            width: calc(100% - 22px);
            margin: 0 auto;
        }
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-categroy-found'] = "<div class='error'> Category not found. </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">
                            <?php
                        } else {
                            echo "<div class='error'> Image Not Added. </div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    $ext = end(explode(".", $image_name));
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = " <div class='error'> Failed to upload image. </div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image. </div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category SET 
                       title = '$title',
                       image_name = '$image_name',
                       featured = '$featured',
                       active = '$active' WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'> Updated Successfully. </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'> Failed to Update Category. </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
