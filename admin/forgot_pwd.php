<?php
include '../ertech/database/connection.php';
include '../admin/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['otp'])) {
    
    $otp_num = rand(111111,999999);
    $m = $_POST['mails'];
    $otp = "select * from owner";
    $otp_result = mysqli_query($con,$otp);
    $get_data_user = mysqli_fetch_array($otp_result,MYSQLI_ASSOC);
    $stat=0;
    if($m == $get_data_user['mail']){
        header('Refresh: 4; URL=https://eswar-profile.000webhostapp.com/admin/pwd_verifing.php');
        sendMails($m,$otp_num);
        
        $insert_query = "insert into userotp (emails,otpcode,state) values ('$m','$otp_num',$stat)";
        mysqli_query($con, $insert_query);
    
    }
    else{
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>ER Tech! says</strong> Wrong Email Address You entered please check once</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        
    }
    
}

//otp function
function sendMails($email,$message_otp){
    
         $to = $email;
         $subject = "Password Reset Request";
         $message = "Your otp : ".$message_otp." don't share with anyone";
         $header = "From:stdintern@gmail.com \r\n";
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true) {
            echo '
             <div class="alert alert-success alert-dismissible fade show" role="alert">
             <center><strong>ER Tech! says</strong> OTP sent to your email address</center>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
             ';
            
         }
         else{
             echo '
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <center><strong>ER Tech! says</strong> Unable to send otp</center>
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
    #otp_success{
        display:none;
    }
</style>

<body>
    
    <div class="forgot">
        <div class="container mt-4">
            <center>
                <br>
                <form action="" method="post" class="form-control mt-5" enctype="multipart/form-data" autocomplete="off" id="otp_send">
                    <center>
                        <br>
                        <h4 class="t1">ER Tech <em>Solutions</em></h4>
                        <br>
                    </center>
                    <div class="row form-control">
                        <label for="" class="form-control-label">Email Address *</label>
                        <input type="email" name="mails" id="" class="form-control" required placeholder="enter your email address">
                    </div>
                    <br>
                    <button type="submit" name="otp" class="form-control btn btn-danger mb-2">Sent OTP</button>
                </form>
                <br>
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
                    <button type="submit" name="otp_msg" class="form-control btn btn-success mb-2">Verifying OTP....</button>
                </form>
                
            </center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>