
<?php 
    session_start();
    include ("../dbcon.php");
    include("includes/header.php");
    include("includes/navbar.php");


echo '<table border="1">';
echo '<tr>';
echo '<th>Customer ID</th>';
echo '<th>Email</th>';
//echo '<th>EDIT</th>';
echo '<th>DELETE</th>';


echo '</tr>';

// SQL query to select data from tbl_customer
$sql = "SELECT `customer_id`, `customer_email`, `customer_password`, `customer_status`, `reset_token_hash`, `reset_token_expires_at` FROM `tbl_customer`";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['customer_id'] . '</td>';
        echo '<td>' . $row['customer_email'] . '</td>';
        echo '<td><a href="delete_customer.php?id=' . $row['customer_id'] . '">Delete</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">No records found</td></tr>';
}

echo '</table>';

// Close the database connection
$con->close();
?>

</body>
</html>




<?php include "dbcon.php" ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="tablecss.css">
    <title>Customer Data</title>
</head>
<body>

<h1>Customer Data</h1>

<?php
session_start();
include "dbcon.php";

echo '<table border="1">';
echo '<tr>';
echo '<th>Customer ID</th>';
echo '<th>Email</th>';
//echo '<th>EDIT</th>';
echo '<th>DELETE</th>';


echo '</tr>';

// SQL query to select data from tbl_customer
$sql = "SELECT `customer_id`, `customer_email`, `customer_password`, `customer_status`, `reset_token_hash`, `reset_token_expires_at` FROM `tbl_customer`";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['customer_id'] . '</td>';
        echo '<td>' . $row['customer_email'] . '</td>';
        echo '<td><a href="delete_customer.php?id=' . $row['customer_id'] . '">Delete</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6">No records found</td></tr>';
}

echo '</table>';

// Close the database connection
$con->close();
?>

</body>
</html>
