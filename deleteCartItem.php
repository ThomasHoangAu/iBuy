<?php
    session_start();
    require_once('conn_iBuyDb.php');

    $lastOrderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
    $lastOrderResult = mysqli_query($link, $lastOrderQuery);
    $lastOrderRow = $lastOrderResult->fetch_row();
    $lastOrderId = $lastOrderRow[0];

    $deleteProductQuery = "DELETE FROM order_details WHERE order_detail_id = '$_GET[order_detail_id]'";
    mysqli_query($link, $deleteProductQuery);
    mysqli_close($link);
    header("Location: cart.php");
    exit;
?>