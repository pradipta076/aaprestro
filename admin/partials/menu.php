
<?php
include('../config/constants.php');
include('login-check.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Food Order Website-Home Page</title>
     <link rel="stylesheet" href="../css/admin.css">
     <style>
      .menu{
        text-align: center;
        border-bottom: 1px solid gray;
    }
    .menu ul{
        list-style-type: none;
    }
    .menu ul li{
        display: inline;
        padding: 1%;
    }
    .menu ul li a{
        text-decoration: none;
        font-weight: bold;
        color: #ff6b81;
    }
    .menu ul li a:hover{
        color:  #2f3542;
    }
    /* css for main content */
    .main-content{
        background-color: #f1f2f6;
        padding: 3% 0;
    }
    .col-4{
        width: 14%;
        background-color: white;
        margin: 1%;
        padding: 2%;
        float: left;
    }
     </style>
</head>
    <!-- Main section starts -->
     <div class="menu text-center">
      <div class="wrapper">
         <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="manage-admin.php">Admin</a></li>
         <li><a href="manage-category.php">category</a></li>
         <li><a href="manage-food.php">Food</a></li>
         <li><a href="manage-order.php">Order</a></li>
         <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
     </div>
