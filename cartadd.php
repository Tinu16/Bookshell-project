<?php
session_start();
include("dbcon.php");
include("config.php");
include("authentication.php");
include("includes/header.php");
include("includes/topbar.php");
include("message.php");
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                echo $_SESSION['showAlert'];
            } else {
                echo 'none';
            } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                    } unset($_SESSION['showAlert']); ?></strong>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Books in your cart!</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>
                                <a href="cart.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $con->prepare('SELECT c.*, b.* FROM tbl_cart c INNER JOIN tbl_book b ON c.book_id = b.book_id');
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total_price = 0;
                        $grand_total = 0;
                        while ($row = $result->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?= $row['cart_id'] ?></td>
                                <input type="hidden" class="pid" value="<?= $row['book_id'] ?>">
                                <td><img src='images/<?php echo $row['book_image']; ?>' alt='<?php echo $row['book_name']; ?>' width="50"></td>
                                <td><?= $row['book_name'] ?></td>
                                <td>
                                    Rs.<?= number_format($row['book_price'], 2); ?>
                                </td>
                                <input type="hidden" class="pprice" value="<?= $row['book_price'] ?>">
                                <td>
                                    <input type="number" class="form-control itemQty" value="<?= $row['quantity'] ?>" style="width:75px;">
                                </td>
                                <?php
                                    $total_price = ($row["book_price"]*$row["quantity"]);
                                ?>
                                <td><strong><?php echo "Rs.".$total_price; ?></strong></td>
                                <td>
                                    <a href="cart.php?remove=<?= $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php $grand_total += ($row["book_price"]*$row["quantity"]) ?>
                        <?php endwhile; ?>

                        <tr>
                            <td colspan="3">
                                <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>
                            <td><b>Rs.<?= number_format($grand_total, 2); ?></b></td>
                            <td>
                                <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
    $(document).ready(function () {

        // Change the item quantity
        $(".itemQty").on('change', function () {
            var $el = $(this).closest('tr');
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);
            $.ajax({
                url: 'cart.php',
                method: 'post',
                cache: false,
                data: {
                    qty: qty,
                    pid: pid,
                    pprice: pprice
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'cart.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function (response) {
                    $("#cart-item").html(response);
                }
            });
        }
    });
</script>

<?php
include("includes/script.php");
include("includes/footer.php");
?>
