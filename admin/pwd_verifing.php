<?php
include '../ertech/database/connection.php';
include '../admin/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['otp_check'])) {
    
    $otp_num = $_POST['otp_msg'];
    $otp = "select * from userotp";
    $otp_result = mysqli_query($con,$otp);
    $v_data = mysqli_fetch_array($otp_result);
    

    if($v_data['otpcode']===$otp_num && $v_data['state']==1){
      echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <center><strong>ER Tech! says</strong> This OPT number experied OR Invalid OTP entered</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    else if($v_data['otpcode']===$otp_num && $v_data['state']==0){
        header('Refresh: 5; URL=https://eswar-profile.000webhostapp.com/admin/update_user.php?data_otp='.$v_data['otpcode']);
        echo '
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <center><strong>ER Tech! says</strong> We will Redirecting to another page just wait !</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } 
    
    else if($v_data['otpcode']!=$otp_num){
        echo '
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <center><strong>ER Tech! says</strong> Wrong OTP number entered !</center>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>password reset</title>
</head>
<style>
    form {
        max-width: 370px;
        margin-top: 5rem;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    label {
        text-align: left;
        font-weight: bolder;
        color: red;
        padding: 2px;
    }

    .t1 {
        color: black;
        font-weight: bold;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    em {
        color: red;
        font-weight: bold;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
    
</style>

<body>
    
    <div class="forgot">
        <div class="container mt-4"><br>
            <center>
                <!--otp verification-->
                <form action="" method="post" class="form-control mt-5" enctype="multipart/form-data" autocomplete="off" id="otp_success">
                    <center>
                        <br>
                        <h4 class="t1">ER Tech <em>Solutions</em></h4>
                        <br>
                    </center>
                    <div class="row form-control">
                        <label for="" class="form-control-label">OTP *</label>
                        <input type="text" name="otp_msg" id="" class="form-control" required placeholder="enter your otp">
                    </div>
                    <br>
                    <button type="submit" name="otp_check" class="form-control btn btn-success mb-2">OTP Verification</button>
                </form>
                
            </center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>