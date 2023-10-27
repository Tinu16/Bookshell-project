<?php
session_start();
include("dbcon.php");

if(isset($_POST['login_btn']))
{
    if(!empty(trim($_POST['email']))  && !empty(trim($_POST['password'])))
    {
        $email=mysqli_real_escape_string($con,$_POST["email"]);
        $password=mysqli_real_escape_string($con,$_POST["password"]);
   
        $login_query="SELECT * FROM `tbl_customer` WHERE customer_email='$email'AND customer_password='$password' LIMIT 1 ";
        $login_query_run=mysqli_query($con,$login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);

            if($row['verify_status'] == "1")
            {
                $_SESSION['authenticated'] =True;
                $_SESSION['auth_user'] = [
                    'email' =>$row['email']
                ];
                $_SESSION['message'] = "You are Logged in successfully";
                header("Location:index.php");
                exit(0);
            }
            else
            {
                $_SESSION["message"] = "Please verify your Email to login.";
                header("Location: login.php");
                exit(0);
            }
        }
        else
        {
             $_SESSION["message"] = "Invalid Email or Password";
             header("Location: login.php");
             exit(0);
        }
    }
    else
    {
        $_SESSION["message"] = "All fields are mandatory";
        header("Location: login.php");
        exit(0);
    }
}
?>