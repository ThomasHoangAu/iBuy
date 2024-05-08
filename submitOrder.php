<?php
    session_start();
    require_once('conn_iBuyDb.php');
    if(isset($_SESSION['customer_id'])) {
        $lastOrderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
        $lastOrderResult = mysqli_query($link, $lastOrderQuery);
        $lastOrderRow = $lastOrderResult->fetch_row();
        if($lastOrderRow != null) {
            $lastOrderId = $lastOrderRow[0];
        }else {
            $lastOrderId = null;
        }

        //check if cart is empty
        $cartQuery = "SELECT COUNT(order_detail_id) FROM order_details WHERE order_id = '$lastOrderId'";
        $cartResult = mysqli_query($link, $cartQuery);
        $cartRow = $cartResult->fetch_row();
        $numOfItems = $cartRow[0];
        if($numOfItems > 0) {
            if(!isset($_SESSION['total'], $_SESSION['gst'], $_SESSION['pay_fname'], $_SESSION['pay_lname'], $_SESSION['pay_email'], $_SESSION['pay_address'], $_SESSION['pay_city'], 
                $_SESSION['pay_state'], $_SESSION['pay_pcode'], $_SESSION['pay_phone'], $_SESSION['card_type'], $_SESSION['card_no'], $_SESSION['code'], $_SESSION['exp_date'])) {
                echo "<script type='text/javascript'>
                    alert('You did not submit order!'); 
                    window.location.href = 'index.php';
                </script>";
            }else {
                $updateOrderQuery = "UPDATE orders SET total_amount = '$_SESSION[total]', gst = '$_SESSION[gst]', pay_fname = '$_SESSION[pay_fname]', pay_lname = '$_SESSION[pay_lname]', 
                pay_email = '$_SESSION[pay_email]', pay_address = '$_SESSION[pay_address]', pay_city = '$_SESSION[pay_city]', pay_state = '$_SESSION[pay_state]', pay_pcode = '$_SESSION[pay_pcode]', 
                pay_phone = '$_SESSION[pay_phone]', card_type = '$_SESSION[card_type]', card_no = '$_SESSION[card_no]', code = '$_SESSION[code]', exp_date = '$_SESSION[exp_date]', is_paid = 1 
                WHERE order_id = '$lastOrderId'";
    
                mysqli_query($link, $updateOrderQuery);
                mysqli_close($link);
    
                echo "<script type='text/javascript'>
                        alert('Order is submited successfully!'); 
                        window.location.href = 'index.php';
                    </script>";
            }
        }else {
            echo "<script type='text/javascript'>
                    alert('Nothing in cart. Please shopping.'); 
                    window.location.href = 'index.php';
                </script>";
        }
    }else {
        echo "<script type='text/javascript'>
                alert('Please login.'); 
                window.location.href = 'login.php';
            </script>";
    }
    
?>