<?php
    session_start();
    include './model/Cart.php';
    include './model/Product.php';
    require_once('conn_iBuyDb.php');

    $quantity = $_POST['quantity'];
    // Update cart
    $cart = new Cart();
    $cart = unserialize($_SESSION['cart']);
    $product = $cart->get_product($_GET['order_detail_id']);
    $product->qty = $quantity;
    $_SESSION['cart'] = serialize($cart);

    // Update database
    $quantityQuery = "UPDATE order_details SET quantity = '$quantity' WHERE order_detail_id = '$_GET[order_detail_id]'";
    mysqli_query($link, $quantityQuery);
    mysqli_close($link);
    header("Location: cart.php");
    exit;
?>