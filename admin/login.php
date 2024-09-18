<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login aaprestro</title>
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f06, #48f);
            color: #fff;
            text-align: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 0 20px;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #ff5722, #ff9800);
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: linear-gradient(135deg, #e64a19, #f57c00);
        }

        .success{
        color: #0ff52a;
    }
    .error{
        color: #f80015;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <br><br>

        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }


        ?>
      <br><br>

        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
// check wethere the submit button is clicked or not
if(isset($_POST['submit']))
{
    // get the data from login form
     $username = $_POST['username'];
     $password = md5($_POST['password']);

    //  sql to check wether the user with username and password 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res= mysqli_query($conn, $sql);


    $count = mysqli_num_rows($res);

    if($count==1)
    {
      $_SESSION['login'] = "<div class='success'> Login successful. </div>";
      $_SESSION['user'] = $username;


    //   redirect to homepage
      header('location:'.SITEURL.'admin/');  
    }
    else
    {
        $_SESSION['login'] = "<div class='error'> Username and Password did not match </div>";
        header('location:'.SITEURL.'admin/login.php');    
    }


}
?>






