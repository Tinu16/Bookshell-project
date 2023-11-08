<?php
session_start();
include("dbcon.php");

if(isset($_POST['login_btn']))
{
    if(!empty(trim($_POST['email']))  && !empty(trim($_POST['password'])))
    {
        $email=mysqli_real_escape_string($con,$_POST["email"]);
        $provided_password=mysqli_real_escape_string($con,$_POST["password"]);
   
        $login_query="SELECT * FROM `tbl_user` WHERE user_email='$email' LIMIT 1 ";
        $login_query_run=mysqli_query($con,$login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);
            $hashed_password = $row['user_password'];

            // Verify the provided password
            if (password_verify($provided_password, $hashed_password)) {
                // Password is correct, proceed with login
                $_SESSION['auth_user'] == True;
                if($row['verify_status'] == "1")
                {
                        $user_id = $row['user_id'];
                        $user_email = $row['user_email'];
                        $user_role = $row['role_id'];
                    

                    $_SESSION['authenticated'] =True;
                    $_SESSION['auth_role'] =$user_role;//0=common seller,1=admin
                    $_SESSION['auth_user'] = [
                        'user_id'=>$user_id,
                        'email' =>$user_email

                    ];

                    if($_SESSION['auth_role'] == "1")//1=admin
                    {
                        $_SESSION['message'] = "Welcome to dashboard";
                        header("Location:admin/index.php");
                        exit(0);
                    }
                    elseif($_SESSION['auth_role'] == "0")//0=user
                    {
                        $_SESSION['message'] = "You are Logged in successfully";
                        header("Location:index.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['message'] = "You are Logged in successfully";
                        header("Location:seller/seller_index.php");
                        exit(0);
                    }
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
                 $_SESSION["message"] = "Incorrect Password";
                 header("Location: login.php");
                 exit(0);
            }
        }
        else
        {
             $_SESSION["message"] = "Invalid Email";
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
//add author
if((isset($_POST['addbtn'])))
{
    if(!empty(trim($_POST['authorname'])))
    {
        $authname = $_POST['authorname'];
        $link = $_POST['link'];

        $m_query = "SELECT * FROM tbl_author WHERE author_name='$authname' ";
        $m_query_run = mysqli_query($con, $m_query);
        if(mysqli_num_rows($m_query_run) > 0)
        {
            $_SESSION['message'] = "This author is already added.";
            header('Location: admin/author.php');  
        }
        else
        {
                $query = "INSERT INTO tbl_author (`author_name`,`author_link`) VALUES ('$authname','$link')";
                $query_run = mysqli_query($con, $query);
                
                if($query_run)
                {
                    $_SESSION['message'] = "Author Details Added";
                    $_SESSION['message_code'] = "success";
                    header('Location: admin/author.php');
                }
                else 
                {
                    $_SESSION['message'] = "Author Details Not Added";
                    $_SESSION['message_code'] = "error";
                    header('Location: admin/author.php');  
                }
        }
    }
    else
    {
        $_SESSION['message'] = "Author name is required.";
        $_SESSION['message_code'] = "error";
        header('Location: admin/author.php');  
    }
}
elseif((isset($_POST['close_pub'])))
    {
            header('Location: admin/view_publisher.php'); 
    }
elseif((isset($_POST['close_author'])))
    {
            header('Location: admin/view_publisher.php'); 
    }
//add publisher
elseif((isset($_POST['add_pub_btn'])))
    {
        if(!empty(trim($_POST['publishername'])))
        {
            $authname = $_POST['publishername'];
            $link = $_POST['link'];
    
            $m_query = "SELECT * FROM tbl_publisher WHERE publisher_name='$authname' ";
            $m_query_run = mysqli_query($con, $m_query);
            if(mysqli_num_rows($m_query_run) > 0)
            {
                $_SESSION['message'] = "This publisher is already added.";
                $_SESSION['message_code'] = "error";
                header('Location: admin/publishers.php');  
            }
            else
            {
                    $query = "INSERT INTO tbl_publisher (`publisher_name`) VALUES ('$authname')";
                    $query_run = mysqli_query($con, $query);
                    
                    if($query_run)
                    {
                        $_SESSION['message'] = "Publisher Details Added";
                        $_SESSION['message_code'] = "success";
                        header('Location: admin/publishers.php');
                    }
                    else 
                    {
                        $_SESSION['message'] = "Publisher Details Not Added";
                        $_SESSION['message_code'] = "error";
                        header('Location: admin/publishers.php');  
                    }
            }
        }
        else
        {
            $_SESSION['message'] = "Publisher name is required.";
            $_SESSION['message_code'] = "error";
            header('Location: admin/publishers.php');  
        }
    }

    //add more publishers
elseif((isset($_POST['add_more_pub'])))
    {
            header('Location: admin/publishers.php'); 
    }

elseif((isset($_POST['add_more'])))
    {
            header('Location: admin/author.php'); 
    }

    //add category
elseif (isset($_POST['cat_add'])) {
    if(!empty(trim($_POST['categories'])))
        {
            $categoryName =mysqli_real_escape_string($con,$_POST["categories"]);
            $check="SELECT category_name FROM `tbl_category` WHERE category_name='$categoryName' LIMIT 1 ";
            $check_run=mysqli_query($con,$check);

            if(mysqli_num_rows($check_run)> 0)
            {  
                $_SESSION["message"] = "Category Already added";
                header("Location: admin/category.php");
            }
            else
            {
                $sql = "INSERT INTO tbl_category (`category_name`) VALUES ('$categoryName')";
                $sql_run = mysqli_query($con, $sql);

                if ($sql_run)
                    {
                        header('Location: admin/subcategory.php'); 
                    } 
                else 
                    {
                        $_SESSION['message'] = "Category not added .";
                        header('Location: admin/category.php'); 
                    }
                }
        }
    else
        {
            $_SESSION["message"] = "Add category";
            header("Location: admin/category.php");
            exit(0);
        }
}
//add subcategory
elseif (isset($_POST['add_sub'])) {
    if(!empty(trim($_POST['subcategories'])))
        {
            $subcategoryName =mysqli_real_escape_string($con,$_POST["subcategories"]);
            $categoryName =mysqli_real_escape_string($con,$_POST["category"]);
            $check="SELECT subcategory_name FROM `tbl_subcategory` WHERE subcategory_name='$subcategoryName' LIMIT 1 ";
            $check_run=mysqli_query($con,$check);

            if(mysqli_num_rows($check_run)> 0)
            {  
                $_SESSION["message"] = "Sub Category Already added";
                header("Location: admin/subcategory.php");
            }
            else
            {
                $sql = "INSERT INTO tbl_subcategory (`subcategory_name`,`category_id`) VALUES ('$subcategoryName','$categoryName')";
                $sql_run = mysqli_query($con, $sql);

                if ($sql_run)
                    {
                        header('Location: admin/view_category.php'); 
                    } 
                else 
                    {
                        $_SESSION['message'] = "Sub Category not added .";
                        header('Location: admin/subcategory.php'); 
                    }
                }
        }
    else
        {
            $_SESSION["message"] = "Add subcategory";
            header("Location: admin/subcategory.php");
            exit(0);
        }
}

//update subcategory
if (isset($_POST['subupdate_btn'])) 
    {
        $subedit_id= $_POST['subedit_id'];
        $new_subcategory_name = $_POST['new_subcategory_name'];
        $update_query = "UPDATE tbl_subcategory SET subcategory_name = '$new_subcategory_name' WHERE subcategory_id = $subedit_id";
        $update_result = mysqli_query($con, $update_query);
        
        if($update_result)
            {
                header("Location: admin/view_category.php"); 
                exit();
            } 
        else
            {   
                die("Error updating the subcategory.");
            }
    }

//update author
if (isset($_POST['author_update_btn'])) 
    {
        $new_author_name = $_POST['new_author_name'];
        $new_author_link=$_POST['new_author_link'];
        $author_id = $_POST['author_id'];
        $update_query = "UPDATE tbl_author SET author_name = '$new_author_name',author_link='$new_author_link' WHERE author_id = $author_id";
        $update_result = mysqli_query($con, $update_query);
        
        if($update_result)
            {
                header("Location: admin/view_author.php"); 
                exit();
            } 
        else
            {   
                die("Error updating the author.");
            }
    }

    //update author
if (isset($_POST['publisher_update_btn'])) 
{
    $new_publisher_name = $_POST['new_publisher_name'];
    $publisher_id = $_POST['publisher_id'];
    $update_query = "UPDATE tbl_publisher SET publisher_name = '$new_publisher_name' WHERE publisher_id = $publisher_id";
    $update_result = mysqli_query($con, $update_query);
    
    if($update_result)
        {
            header("Location: admin/view_publisher.php"); 
            exit();
        } 
    else
        {   
            die("Error updating the publisher.");
        }
}

//seller register
if (!empty(trim(isset($_POST['seller_register_btn']))))
{
    $store_name=mysqli_real_escape_string($con,$_POST['store_name']);
    $pan=mysqli_real_escape_string($con,$_POST['pan']);
    $phone=mysqli_real_escape_string($con,$_POST['phone']);
    
    $query="SELECT * FROM `tbl_seller` WHERE seller_name='$store_name'";
    $query_run=mysqli_query($con,$query);

    if(mysqli_num_rows($query_run))
    {  
        $_SESSION["message"] = "Store name already exists";
        header("Location: seller/seller_register.php");
    }
    else
    {
        //INSERT seller
        $seller_query="INSERT INTO `tbl_seller`(`seller_name`, `seller_pan`,'seller_phone') VALUES ('$store_name','$pan','$phone')";
        $seller_query_run=mysqli_query($con,$seller_query);
        
        if(mysqli_num_rows($seller_query_run))
        {
            $row = mysqli_fetch_array($seller_query_run);
            $user_id = $row['user_id'];

            $update="UPDATE `tbl_user` SET `role_id` = '2' FROM `tbl_user` INNER JOIN `tbl_seller` ON tbl_user.user_id = tbl_seller.user_id WHERE tbl_user.user_id = '$user_id'";
            $update_run=mysqli_query($con,$update);
            if($update_run && mysqli_num_rows($update_run) > 0)
                {
                $_SESSION["message"]="Registered successfully!";
                header("Location:seller/seller_addrress.php");
                exit(0);
                }
        }
        else
        {
                $_SESSION["message"]="Registeration Failed!";
                header("Location:seller/seller_register.php");
                exit(0);
        }
    }
 }
?>