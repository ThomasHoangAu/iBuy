<?php
    include __DIR__ . '/../model/Cart.php';
    include __DIR__ . '/../model/Product.php';
    require_once __DIR__ . '/../connection/conn_iBuyDb.php';

    session_start();
    $counter = $_SESSION['counter'];
    $cart = new Cart();
    $cart = unserialize($_SESSION['cart']);
    //delete selected product from the cart
    $cart->delete_product($_GET['order_detail_id']);
    $counter--;
    $_SESSION['counter'] = $counter;
	
	//Serialize and add back to the session
    $_SESSION['cart'] = serialize($cart);

    // delete product from order_details table
    $lastOrderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
    $lastOrderResult = mysqli_query($link, $lastOrderQuery);
    $lastOrderRow = $lastOrderResult->fetch_row();
    $lastOrderId = $lastOrderRow[0];

    $deleteProductQuery = "DELETE FROM order_details WHERE order_detail_id = '$_GET[order_detail_id]'";
    mysqli_query($link, $deleteProductQuery);

    mysqli_close($link);
    header("Location: cart");
    exit;
?>