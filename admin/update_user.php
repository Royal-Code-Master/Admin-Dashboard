<?php

include '../ertech/database/connection.php';

$verifying_otp = $_GET['data_otp'];
$check = "select * from userotp";
$done = mysqli_query($con,$check);
$data = mysqli_fetch_array($done);
$data_mail = $data['emails'];
if($verifying_otp !=$data['otpcode'] || empty($verifying_otp)){
    header("location: ../admin/pwd_verifing.php? status= missmatched-data-happen");
}


if(isset($_POST['update'])){
    
    $user = $_POST['user_mail'];
    $pwd =  $_POST['user_password'];
    
    $update = "update owner set mail ='$user', pwds='$pwd' where mail='$data_mail'";
    $login_result = mysqli_query($con,$update);
    
    if($login_result){
        
        header('Refresh: 5; URL=https://eswar-profile.000webhostapp.com/admin/login.php');
        
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <center><strong>My Daily Activites! says</strong> Updation Successfull and You will redirecting to login page</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        
        $otp_somplete_update = "delete from userotp where otpcode='$verifying_otp' ";
        mysqli_query($con,$otp_somplete_update);
    }
    else{
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>My Daily Activites! says</strong> Updation Failed</center>
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
    <link rel="shortcut icon" href="./imags/download.png">
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
              <br>
              <form action="" method="post" class="form-control" data-aos="slide-down">
                  <div class="row p-2">
                      <i class="fa fa-user-circle-o fa-4x" style="color:green;"></i>
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
                      <button type="submit" name="update" class="btn btn-danger p-1 form-control mb-3"><strong>Update Details</strong></button>
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