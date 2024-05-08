<?php
    session_start();
    require_once('conn_iBuyDb.php');
    $quantity = $_POST['quantity'];
    $quantityQuery = "UPDATE order_details SET quantity = '$quantity' WHERE order_detail_id = '$_GET[order_detail_id]'";
    mysqli_query($link, $quantityQuery);
    mysqli_close($link);
    header("Location: cart.php");
    exit;
?>