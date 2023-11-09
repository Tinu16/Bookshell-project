<?php
session_start();
include("dbcon.php");
include("config.php");
include("authentication.php");
include("includes/header.php");
include("includes/customer_sidebar.php");
include("includes/topbar.php");
include("message.php");

$status = "";
if (isset($_POST['code']) && $_POST['code'] != "") {
    $code = $_POST['code'];
    $result = mysqli_query(
        $con,
        "SELECT * FROM `tbl_book` WHERE `book_id`='$code'"
    );
    $row = mysqli_fetch_assoc($result);
    $name = $row['book_name'];
    $code = $row['book_id'];
    $price = $row['book_price'];
    $image = $row['book_image'];

    $cartArray = array(
        $code => array(
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => 1,
            'image' => $image
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($code, $array_keys)) {
            $status = "<div class='box' style='color:red;'>
            Product is already added to your cart!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge(
                $_SESSION["shopping_cart"],
                $cartArray
            );
            $message = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}

$result = mysqli_query($con, "SELECT b.book_id,b.book_name,a.author_name, b.book_volume, b.book_edition, b.book_isbn, sc.subcategory_name, p.publisher_name,  b.book_image, b.book_price, b.book_status FROM tbl_book b INNER JOIN
            tbl_publisher p ON  p.publisher_id = b.publisher_id
            INNER JOIN
            tbl_author a  ON a.author_id = b.author_id
            INNER JOIN 
            tbl_subcategory sc  ON sc.subcategory_id = b.category_id");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='card'>
            <form method='post' action=''>
                <input type='hidden' name='code' value=" . $row['book_id'] . " />
                <div class='card-body'>
                    <div class='image'><img src='images/" . $row['book_image'] . "' /></div>
                    <div class='name'>" . $row['book_name'] . "(" . $row['author_name'] . ")</div>
                    <div class='price'>Rs." . $row['book_price'] . "</div>
                    <button type='submit' class='buy'>Buy Now</button>
                </div>
            </form>
        </div>";
}

?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
</div>
<?php
include("includes/script.php");
include("includes/footer.php");
?>
