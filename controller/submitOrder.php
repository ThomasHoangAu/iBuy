<?php
    session_start();
    require_once __DIR__ . '/../connection/conn_iBuyDb.php';
    if(isset($_SESSION['customer_id'])) {
        $lastOrderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
        $lastOrderResult = mysqli_query($link, $lastOrderQuery);
        $lastOrderRow = $lastOrderResult->fetch_row();
        if($lastOrderRow != null) {
            $lastOrderId = $lastOrderRow[0];
        }else {
            $lastOrderId = null;
        }

        //Check if cart is not empty
        if(isset($_SESSION['counter']) && $_SESSION['counter'] > 0) {
            if($_SESSION['pay_fname'] == '' || $_SESSION['pay_lname'] == '' || $_SESSION['pay_email'] == '' 
                || $_SESSION['pay_address'] == '' || $_SESSION['pay_city'] == '' || $_SESSION['pay_state'] == '' || $_SESSION['pay_pcode'] == '' 
                || $_SESSION['pay_phone'] == '' || $_SESSION['card_type'] == '' || $_SESSION['card_no'] == '' || $_SESSION['code'] == '' || $_SESSION['exp_date'] == '') {
                echo "<script type='text/javascript'>
                    alert('You did not pay!'); 
                    window.location.href = 'cart';
                </script>";
            }else {
                $updateOrderQuery = "UPDATE orders SET total_amount = '$_SESSION[total]', gst = '$_SESSION[gst]', pay_fname = '$_SESSION[pay_fname]', 
                pay_lname = '$_SESSION[pay_lname]', pay_email = '$_SESSION[pay_email]', pay_address = '$_SESSION[pay_address]', pay_city = '$_SESSION[pay_city]', 
                pay_state = '$_SESSION[pay_state]', pay_pcode = '$_SESSION[pay_pcode]', pay_phone = '$_SESSION[pay_phone]', card_type = '$_SESSION[card_type]', 
                card_no = '$_SESSION[card_no]', code = '$_SESSION[code]', exp_date = '$_SESSION[exp_date]', is_paid = 1 
                WHERE order_id = '$lastOrderId'";
    
                mysqli_query($link, $updateOrderQuery);
                mysqli_close($link);

                //Clear cart
                unset($_SESSION['counter']);
		        unset($_SESSION['cart']);

                //Clear sessions
                $_SESSION['pay_fname'] = '';
                $_SESSION['pay_lname'] = '';
                $_SESSION['pay_email'] = '';
                $_SESSION['pay_address'] = '';
                $_SESSION['pay_city'] = '';
                $_SESSION['pay_state'] = '';
                $_SESSION['pay_pcode'] = '';
                $_SESSION['pay_phone'] = '';
                $_SESSION['card_type'] = '';
                $_SESSION['card_no'] = '';
                $_SESSION['code'] = '';
                $_SESSION['exp_date'] = '';
                $_SESSION['total'] = '';
                $_SESSION['gst'] = '';
    
                echo "<script type='text/javascript'>
                        alert('Order is submited successfully!'); 
                        window.location.href = 'home';
                    </script>";
            }
        }else {
            echo "<script type='text/javascript'>
                    alert('Nothing in cart. Please shopping.'); 
                    window.location.href = 'home';
                </script>";
        }
    }else {
        echo "<script type='text/javascript'>
                alert('Please login.'); 
                window.location.href = 'login';
            </script>";
    }
    
?>