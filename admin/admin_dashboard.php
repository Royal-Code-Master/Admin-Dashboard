<?php
include '../ertech/database/connection.php';
include '../admin/phpmailer/PHPMailerAutoload.php';

$get_verify_code = $_GET['checking'];

$check = "select * from owner";
$done = mysqli_query($con,$check);
$data = mysqli_fetch_array($done);
if($get_verify_code !=sha1($data['mail']) || empty($get_verify_code)){
    header("location: ../admin/login.php? status= missmatched-data-happen");
}




// // sending mails to all users

 if(isset($_POST['send_mail'])){
   
  $mail_type=$_POST['mail_select'];
  $mail_header=$_POST['mail_heading'];
  $mail_msg=$_POST['msg'];
   
  //selecting mail type here
  if($mail_type=="courses_mails"){
       
      $c_mail = "select * from customers";
      $c_result = mysqli_query($con,$c_mail);
      $c_count = mysqli_num_rows($c_result);
      if($c_count>0){
          foreach($c_result as $c_mail_data){
             $course_mail = $c_mail_data['mail'];   
             //mail function
             sendMails($course_mail,$mail_header,$mail_msg);
          }
          echo "<script>alert('Message sent to all users...')</script>";
      }
      else{
          echo "<script>alert('Users not exist')</script>";
      }
  }
   
  // another mail type.
  elseif($mail_type=="internship_mails"){
      $i_mail = "select * from intern";
      $i_result = mysqli_query($con,$i_mail);
      $i_count = mysqli_num_rows($i_result);
      if($i_count>0){
          foreach($i_result as $i_mail_data){
              $intern_mail = $i_mail_data['mail']; 
              //mail function
              sendMails($intern_mail,$mail_header,$mail_msg);
          }
          echo "<script>alert('Message sent to all users...')</script>";
      }
      else{
          echo "<script>alert('Users not exist')</script>";
      }
    }
}


// //mail function

function sendMails($email,$headers,$messages){
    
         $to = $email;
         $subject = $headers;
         $message = $messages;
         $header = "From:stdintern@gmail.com \r\n";
         $retval = mail ($to,$subject,$message,$header);
         if( !$retval == true ) {
            echo "<script>alert('Message çouln't sent ...')</script>";
         }
}

?>


<style>
    .navbar-brand{
        color:navy !important;
        font-weight:bold;
        font-size:25px !important;
    }
    .navbar{
        border-bottom:4px solid navy;
    }
    button{
        font-weight:bolder;
        font-family: 'Times New Roman', Times, serif !important;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ER Tech</title>
</head>

<style>
    .col{
        margin:3px;
    }
    .tabcontent{
        display:none;
    }
    label {
        text-align: left;
        color: black;
        font-weight: 700;
        text-transform: capitalize;
    }
</style>

<body>


    <script>
        // aos js animation
        AOS.init({
            duration: 1700,
        });

        //bar
    </script>

    
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="#">ER Tech</a>
    <div>
        <a href="./login.php">
           
                <i class="fa fa-user" style="color:orangered;font-weight:bolder;"> &nbsp;logout</i>
           
        </a>
        
    </div>
  </div>
 </nav>

<br><br>
     <script>
     
        function openPage(pageName, elmnt, color) {
         // Hide all elements with class="tabcontent" by default */
        
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
         tablinks = document.getElementsByClassName("tablink");
         for (i = 0; i < tablinks.length; i++) {
         tablinks[i].style.backgroundColor = "";
         }

        // Show the specific tab content
         document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
         elmnt.style.backgroundColor = color;
        }
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
    
      <div class="container mb-3" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
          <br>
         <div class="row p-3 mb-1">
             <div class="col-md-3">
                 <button class="tablink btn btn-primary form-control p-3 mb-2" onclick="openPage('Home', this, 'red')" id="defaultOpen" data-aos="fade-down"><h3><i class="fa fa-book"></i>  <strong>Courses</strong></h3></button>
             </div>
             <div class="col-md-3">
                 <button class="tablink btn btn-primary form-control p-3 mb-2" onclick="openPage('Contact', this, 'red')" data-aos="fade-up"><h3><i class="fa fa-envelope"></i>  <strong>Messages</strong></h3></button>
             </div>
             
             <div class="col-md-3">
                 <button class="tablink btn btn-primary form-control p-3 mb-2" onclick="openPage('News', this, 'red')" data-aos="fade-right"><h3><i class="fa fa-certificate"></i>  <strong>Internships</strong></h3></button>
             </div>
             <div class="col-md-3">
                 <button class="tablink btn btn-primary form-control p-3 mb-2" onclick="openPage('Mails', this, 'red')" data-aos="fade-left"><h3><i class="fa fa-cogs"></i>  <strong>Mail System</strong></h3></button>
             </div>
         </div>
         
         <div class="row p-3">
             
         </div>
         
      </div>
         
      <div id="Home" class="tabcontent">
           <div class="container mb-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><br><br><br>
               <div class="table table-responsive">
                   <table class="table table-bordered table-hover"> 
                       <thead class="bg-primary">
                           <th>NAME</th>
                           <th>PHONE</th>
                           <th>EMAIL</th>
                           <th>DOMAIN</th>
                           <th>JOINED</th>
                           <th>ACCEPT</th>
                           <th>ACTION</th>
                       </thead>
                       
                       <tbody class="bg-light">
                            <?php
                            $query = " SELECT * FROM customers";
                            $query_run = mysqli_query($con, $query);
                            $count = mysqli_num_rows($query_run);
                            
                            if ($count > 0) {
                                foreach ($query_run as $items) {
                            ?>
                            
                            <tr>
                                        <td><?php echo $items['username'] ?></td>
                                        <td><?php echo $items['phone'] ?></td>
                                        <td><?php echo $items['mail'] ?></td>
                                        <td><?php echo $items['domains'] ?></td>
                                        <td><?php echo $items['joined'] ?></td>
                                        <td>
                                            <center>
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                            </center>
                                        </td>
                                        <center>
                                        <td>
                                            <i class="fa fa-trash" style="color:red;"></i>
                                        </td>
                                        </center>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <tr id="not">
                                    <td colspan="5">
                                        <center>
                                            Alert msessage : No student data is available right now.
                                        </center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                       </tbody>
                   </table>
               </div>
           </div>
         </div>



        <div id="Contact" class="tabcontent">
           <div class="container mb-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><br><br><br>
               <div class="table table-responsive">
                  <table class="table table-bordered table-hover"> 
                       <thead class="bg-success">
                           <th>NAME</th>
                           <th>PHONE</th>
                           <th>EMAIL</th>
                           <th>ADDRESS</th>
                           <th>MESSAGE</th>
                           <th>DATE</th>
                           <th>ACTION</th>
                       </thead>
                       
                       <tbody class="bg-light">
                            <?php
                            $query = " SELECT * FROM messages";
                            $query_run = mysqli_query($con, $query);
                            $count = mysqli_num_rows($query_run);
                            
                            if ($count > 0) {
                                foreach ($query_run as $items) {
                            ?>
                            
                            <tr>
                                        <td><?php echo $items['username'] ?></td>
                                        <td><?php echo $items['phone'] ?></td>
                                        <td><?php echo $items['mail'] ?></td>
                                        <td><?php echo $items['address'] ?></td>
                                        <td><?php echo $items['msg'] ?></td>
                                        <td><?php echo $items['dates'] ?></td>
                                        <center>
                                        <td>
                                            <i class="fa fa-trash" style="color:red;"></i>
                                        </td>
                                        </center>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <tr id="not">
                                    <td colspan="5">
                                        <center style="font-family:Cambria;">
                                            Alert msessage : No student data is available right now.
                                        </center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                       </tbody>
                   </table>
               </div>
           </div>
         </div>


         <div id="News" class="tabcontent">
            <div class="container mb-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><br><br><br>
               <div class="table table-responsive">
                   <table class="table table-bordered table-hover"> 
                       <thead class="bg-warning">
                           <th>NAME</th>
                           <th>PHONE</th>
                           <th>EMAIL</th>
                           <th>DOMAIN</th>
                           <th>JOINED</th>
                           <th>ACTION</th>
                       </thead>
                       
                       <tbody class="bg-light">
                            <?php
                            $query = " SELECT * FROM intern";
                            $query_run = mysqli_query($con, $query);
                            $count = mysqli_num_rows($query_run);
                            
                            if ($count > 0) {
                                foreach ($query_run as $items) {
                            ?>
                            
                            <tr>
                                        <td><?php echo $items['username'] ?></td>
                                        <td><?php echo $items['phone'] ?></td>
                                        <td><?php echo $items['mail'] ?></td>
                                        <td><?php echo $items['domains'] ?></td>
                                        <td><?php echo $items['joined'] ?></td>
                                        <center>
                                        <td>
                                            <i class="fa fa-trash" style="color:red;"></i>
                                        </td>
                                        </center>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <tr id="not">
                                    <td colspan="5">
                                        <center style="font-family:Cambria;">
                                            Alert msessage : No student data is available right now.
                                        </center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                       </tbody>
                   </table>
               </div>
           </div>
         </div>
         
 
        <div id="Mails" class="tabcontent">
            <div class="container mb-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><br><br><br>
               <center>
                   <form method="post" style="max-width:450px;box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;" class="form-control mt-2 mb-3 p-2" enctype="multipart/form-data" autocomplete="off" >
                        
                        <div class="row">
                           <strong>
                             <p class="p-2" style="color:red;text-align:center;font-size:25px; font-weight:bolder;"><i class="fa fa-cogs"></i> &nbsp;Mailing System</p>
                           </strong>
                         </div>
                         <br>
                         
                         <div class="row form-control mb-2">
                             <label class="p-2">Select Mail Type</label>
                             <select class="form-select" name="mail_select" required>
                                <option>----</option>
                                <option value="courses_mails" name="get_mail">courses</option>
                                <option value="internship_mails" name="get_mail">internships</option>
                             </select>
                         </div>
                         
                         <div class="row form-control mb-2">
                             <label class="p-2">Mail Header</label>
                             <input type="text" class="form-control" name="mail_heading" required>
                         </div>
                         
                         <div class="row form-control mb-2">
                             <label class="p-2">Mail Message</label>
                             <input type="text" class="form-control" name="msg" required>
                         </div>
                         <br>
                            <button type="submit" class="btn btn-primary form-control mb-3 p-2" name="send_mail"><strong>Send Mail</strong></button>
                         
                    </form><br><br>
               </center>
           </div>
           <br>
         </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>