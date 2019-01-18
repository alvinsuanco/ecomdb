<?php require_once "./connect.php"?>

<?php
$id = $_GET['id'];

$cancel_order_query = "UPDATE orders SET status_id = 3 WHERE id = $id; ";

$result = mysqli_query($conn, $cancel_order_query);

if (!$result) {
	echo mysqli_error($conn);
}

//header ("Location: ../views/order.php");


?>