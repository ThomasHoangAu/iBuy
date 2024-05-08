<?php
    session_start();
    if($_SESSION['loggedin']) {
        require_once('conn_iBuyDb.php');
        $quantity = $_POST['quantity'];
        $total = $quantity * $_SESSION['pro_price'];

        if(isset($_SESSION['customer_id'])) {
            $lastOrderQuery = "SELECT order_id, is_paid FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
            $lastOrderResult = mysqli_query($link, $lastOrderQuery);
            
            $lastOrderRow = $lastOrderResult->fetch_row();
            if($lastOrderRow != null) {
                $order_id = $lastOrderRow[0];
            }else {
                $insertNewOrderQuery = "INSERT INTO orders (customer_id, is_paid) VALUES ('$_SESSION[customer_id]', 0)";
                mysqli_query($link, $insertNewOrderQuery);
                //$lastOrderResult = mysqli_query($link, $lastOrderQuery);
                $newOderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]') ORDER BY order_id DESC LIMIT 1";
                $newOrderResult = mysqli_query($link, $newOderQuery);
                $newOrderRow = $newOrderResult->fetch_row();
                $order_id = $newOrderRow[0];
            }
        }

        $orderDetailQuery = "INSERT INTO order_details (order_id, product_id, quantity, price, total) VALUES ('$order_id', '$_SESSION[pro_id]', '$quantity', '$_SESSION[pro_price]', '$total')";
        mysqli_query($link, $orderDetailQuery);
        mysqli_close($link);

        header("Location: cart.php");
        exit;
    } else {
        echo "<script type='text/javascript'>
                alert('Please login.'); 
                window.location.href = 'login.php';
            </script>";
    }


?>