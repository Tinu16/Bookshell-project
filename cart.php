<?php
session_start();
include("dbcon.php");
include("config.php");
include("authentication.php");

include("message.php");

if (isset($_SESSION["auth_user"]) && isset($_POST["book_id"])) {
    $user = $_POST['useremail'];
    $bid = $_POST['book_id'];
    $bname = $_POST['bookname'];
    $bprice = $_POST['amount'];
    $bimg = $_POST['bookimg'];
    $bqty = 1;
    $date = date('Y-m-d h:i:s');

    // Using prepared statements to prevent SQL injection
    $stmt = $con->prepare('SELECT book_id FROM tbl_cart WHERE book_id=? AND user_email=?');
    $stmt->bind_param('ss', $bid, $user);
    $stmt->execute();
    $res = $stmt->get_result();

    // Fetch the associative array
    $r = $res->fetch_assoc();

    // Check if 'book_id' exists in $r
    if (!isset($r['book_id'])) {
        $query = "INSERT INTO `tbl_cart`(`user_email`, `book_id`, `quantity`, `cart_date`) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param('siss', $user, $bid, $bqty, $date);
        $sql_run = $stmt->execute();

        if ($sql_run) {
            echo '
         <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> Book added to your cart.</strong>
          </div>';
        } else {
            // Output the detailed error message for debugging
            echo '
         <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> Book is not added to your cart. Please try again later.</strong>
              <br> Error: ' . $stmt->error;
            echo '</div>';

            // Log the error to a file for further investigation
            error_log("SQL Error: " . $stmt->error, 0);
        }
    } else {
        echo '
      <div class="alert alert-info alert-dismissible">
           <button type="button" class="close" data-dismiss="alert">&times;</button>
           <strong> Book is already added to your cart.</strong>
       </div>';
    }
}

if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    $stmt = $con->prepare('SELECT * FROM tbl_cart');
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
  }
  // Remove single items from cart
	if (isset($_GET['remove'])) {
        $id = $_GET['remove'];
  
        $stmt = $con->prepare('DELETE FROM tbl_cart WHERE id=?');
        $stmt->bind_param('i',$id);
        $stmt->execute();
  
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Item removed from the cart!';
        header('location:cartadd.php');
      }
  
      // Remove all items at once from cart
      if (isset($_GET['clear'])) {
        $stmt = $con->prepare('DELETE FROM tbl_cart');
        $stmt->execute();
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'All Item removed from the cart!';
        header('location:cartadd.php');
      }
?>
