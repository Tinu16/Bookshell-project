<?php
session_start();
include("dbcon.php");
include("config.php");
include("authentication.php");
include("includes/header.php");
include("includes/customer_sidebar.php");
include("includes/topbar.php");
include("message.php");
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <tbody>
        <tr>
            <td></td>
            <td>ITEM NAME</td>
            <td>QUANTITY</td>
            <td>UNIT PRICE</td>
            <td>ITEMS TOTAL</td>
        </tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product)
    {
    ?>
        <tr>
            <td><img src='images/<?php echo $product["image"]; ?>' width="50" height="40" /></td>
            <td><?php echo $product["name"]; ?><br />
            <form method='post' action=''>
            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
            <input type='hidden' name='action' value="remove" />
            <button type='submit' class='remove'>Remove Item</button>
            </form>
            </td>
            <td>
                <form method='post' action=''>
                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                <input type='hidden' name='action' value="change" />
                <select name='quantity' class='quantity' onChange="this.form.submit()">
                <option <?php if($product["quantity"]==1) ?>
                value="1">1</option>
                <option <?php if($product["quantity"]==2)?>
                value="2">2</option>
                <option <?php if($product["quantity"]==3) ?>
                value="3">3</option>
                <option <?php if($product["quantity"]==4)?>
                value="4">4</option>
                <option <?php if($product["quantity"]==5)?>
                value="5">5</option>
                </select>
                </form>
            </td>
            <td><?php echo "Rs.".$product["price"]; ?></td>
            <td><?php echo "Rs.".$product["price"]*$product["quantity"]; ?></td>
        </tr>
<?php
    $total_price += ($product["price"]*$product["quantity"]);
    }
?>
<tr>
    <td colspan="5" align="right"><strong>TOTAL: <?php echo "Rs.".$total_price; ?></strong></td>
</tr>
    </tbody>
</table>		
<?php
}
else
    {
        ?>
        <center>
        <img src="img/empty_cart.png" height="250px" width="250px" class="img-fluid animated" alt="">
        <?php
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</center>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<?php 
    include("includes/footer.php");
?>