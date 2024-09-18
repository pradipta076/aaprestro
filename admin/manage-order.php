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
       <h1>Manage Order</h1>

       
           
         <br/><br/>

<table class="tbl-full">
  <tr>
    <th>sl.no.</th>
    <th>Full Name</th>
    <th>username</th>
    <th>Action</th>
  </tr>

  <tr>
   <td>1.</td>
   <td>Pradipta Kumar</td>
   <td>pradiptakumar</td>
   <td>
     <a href="#" class="btn-secondary">Update Admin</a>
     <a href="#" class="btn-danger">Delete Admin</a>
    
   </td>

  </tr>

  <tr>
   <td>2.</td>
   <td>Pradipta Kumar</td>
   <td>pradiptakumar</td>
   <td>
   <a href="#" class="btn-secondary">Update Admin</a>
   <a href="#" class="btn-danger">Delete Admin</a>
   </td>

  </tr>

  <tr>
   <td>3.</td>
   <td>Pradipta Kumar</td>
   <td>pradiptakumar</td>
   <td>
   <a href="#" class="btn-secondary">Update Admin</a>
   <a href="#" class="btn-danger">Delete Admin</a>
   </td>

  </tr>
</table>


    </div>
</div>

<?php include('partials/footer.php') ?>