<?php

include '../db/connection.php';
if(isset($_POST['signin'])){
    
    $user = $_POST['user_mail'];
    $pwd =  $_POST['user_password'];
    
    $login = "select * from owner";
    $login_result = mysqli_query($con,$login);
    $get_data_user = mysqli_fetch_array($login_result,MYSQLI_ASSOC);
    if($user == $get_data_user['mail'] && $pwd == $get_data_user['pwds']){
        header("location: ../admin/admin_dashboard.php?checking=".sha1($get_data_user['mail']));
    }
    else{
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <center><strong>My Daily Activites! says</strong> Wrong Email Address You entered please check once</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href="../ertech/imgs/short.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ER Tech Solutions</title>
</head>

<style>
    form{
        max-width:360px;
        height:auto;
        margin-top:4rem;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }
    label{
        text-align:left !important;
        color:black;
        font-weight:500;
    }
    
    
</style>


<body class="bg-primary">
    
    
    <script>
    
    // aos js animation
        AOS.init({
            duration:2000,
        });
    </script>
    
    
    
    
    
    
    
    
    
    
    <div class="login_page"> 
      <div class="container">
          <center>
              <form action="" method="post" class="form-control" data-aos="zoom-in">
                  <div class="row p-2">
                      <i class="fa fa-user-circle-o fa-4x" style="color:navy;"></i>
                      <br>
                      <h4  class="mt-2"style="color:orangered;"><strong>ER Tech Solutions</strong></h4>
                      <p class="mt-1">
                          Welcome to ER Tech Solution Admin Panel.
                      </p>
                  </div>
                  <br>
                  <div class="login_details">
                      <div class="row form-control">
                          <label class="p-2"><i class="fa fa-envelope"></i>&nbsp;email address</label>
                          <input type="email" name="user_mail" class="form-control" required placeholder="Email Address">
                      </div>
                      <br>
                      <div class="row form-control">
                          <label class="p-2"><i class="fa fa-lock"></i>&nbsp;password</label>
                          <input type="password" name="user_password" class="form-control" required placeholder="password">
                      </div>
                      <br>
                      <button type="submit" name="signin" class="btn btn-dark form-control mb-3"><strong>Signin</strong></button>
                      <p style="color:black; font-weight:600;"> forgot my password <a href="../admin/forgot_pwd.php" style="text-decoration:none;">Help me</a></p>
                  </div>
              </form>
              <br>
              
          </center>
      </div>
    </div>
    

<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>