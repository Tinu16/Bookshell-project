<?php
session_start();

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['message'] = "Please login to access your account";
    header("Location:login.php");
    exit(0);
}
else
{

}
?>