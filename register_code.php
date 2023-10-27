<?php
SESSION_START();
 include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

 function sendemail_verify($email,$verify_token)
 {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug=3;
    $mail->isSMTP();                                                     
    $mail->SMTPAuth   = true;                                   

    $mail->Host       = 'smtp.gmail.com'; 
    $mail->Username   = 'bookshell45@gmail.com';                
    $mail->Password   = 'kddg nagj cfvj vpso';                              
    
    $mail->SMTPSecure = "tls";            
    $mail->Port       = 587;                                   

    $mail->setFrom('bookshell45@gmail.com', 'Bookshell');
    $mail->addAddress($email);   

     //Content
     $mail->isHTML(true);                                  
     $mail->Subject = 'Email verification from Bookshell';

     $email_template=
     "
        <h2>You have registered with Bookshell</h2>
        <h5>Verify your email address to Login with the below given link</h5>
        <br></br>
        <a href='http://localhost/bookshell/verify_email.php?token=$verify_token'>Click here</a>
     ";

     $mail->Body = $email_template;
 
     $mail->send();
 }

 if(isset($_POST['register_btn']))
 {
   
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $password=mysqli_real_escape_string($con,$_POST["password"]);
    $verify_token=md5(rand());
   
    //check if email already exists
    $checkemail="SELECT customer_email FROM `tbl_customer` WHERE customer_email='$email' LIMIT 1 ";
    $checkmail_run=mysqli_query($con,$checkemail);

    if(mysqli_num_rows($checkmail_run)> 0)
    {  
        $_SESSION["message"] = "This email is already taken";
        header("Location: register.php");
    }
    else
    {
        //INSERT USER
        $user_query="INSERT INTO `tbl_customer`(`customer_email`, `customer_password`, `verify_token`) VALUES ('$email','$password','$verify_token')";
        $user_query_run=mysqli_query($con,$user_query);

        if($user_query_run)
        {
            sendemail_verify("$email","$verify_token");

            $_SESSION["message"]="Registered successfully!Please verify your Email address";
            header("Location:register.php");
            exit(0);
        }
    }
 }
 else
   {
        $_SESSION["message"]="Registration failed";
         header("Location:register.php");
        exit(0);
    }
 
?>