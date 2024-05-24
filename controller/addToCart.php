<?php
    include '../model/Cart.php';
    include '../model/Product.php';
    require_once('../connection/conn_iBuyDb.php');

    session_start();
    if($_SESSION['loggedin']) {
        $product_id = $_SESSION['pro_id'];
        $product_des = $_SESSION['pro_des'];
        $product_price = $_SESSION['pro_price'];
        $quantity = $_POST['quantity'];
        $product_img = $_SESSION['pro_img'];
        $total = $quantity * $_SESSION['pro_price'];
        
        //store number of products in the shopping cart
        $cart = new Cart();
        //unserialize the cart if the cart is not empty
        if ((isset($_SESSION['counter'])) && ($_SESSION['counter'] !=0)){
            $counter = $_SESSION['counter']; 
            //	unserialize convert the session object which is a string to a cart object
            $cart = unserialize($_SESSION['cart']);
        }else {
            $_SESSION['counter'] = 0;
            $_SESSION['cart'] = "";
        }  

        if (($product_id == "") or ($quantity < 1)) {
            //Redirect the user back to product list page
            header("Location: ../index.php");
            exit;
        }else {
            //Insert a product into orders table and order_details table
            if(isset($_SESSION['customer_id'])) {
                $lastOrderQuery = "SELECT order_id, is_paid FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
                $lastOrderResult = mysqli_query($link, $lastOrderQuery);
                
                $lastOrderRow = $lastOrderResult->fetch_row();
                if($lastOrderRow != null) {
                    $order_id = $lastOrderRow[0];
                }else {
                    $insertNewOrderQuery = "INSERT INTO orders (customer_id, is_paid) VALUES ('$_SESSION[customer_id]', 0)";
                    mysqli_query($link, $insertNewOrderQuery);
                    //$lastOrderResult = mysqli_query($link, $lastO rderQuery);
                    $newOderQuery = "SELECT order_id FROM orders WHERE (customer_id = '$_SESSION[customer_id]') ORDER BY order_id DESC LIMIT 1";
                    $newOrderResult = mysqli_query($link, $newOderQuery);
                    $newOrderRow = $newOrderResult->fetch_row();
                    $order_id = $newOrderRow[0];
                }
            }
    
            $orderDetailQuery = "INSERT INTO order_details (order_id, product_id, quantity, price, total) VALUES ('$order_id', '$_SESSION[pro_id]', '$quantity', '$_SESSION[pro_price]', '$total')";
            mysqli_query($link, $orderDetailQuery);

            //Get order_detail_id of new product
            $newProductQuery = "SELECT order_detail_id FROM order_details WHERE (order_id = '$order_id') ORDER BY order_detail_id DESC LIMIT 1";
            $newProductResult = mysqli_query($link, $newProductQuery);
            $newProductRow = $newProductResult->fetch_row();
            $newProduct_id = $newProductRow[0];

            //Add products to the cart
            $new_product = new Product($product_id, $product_des, $quantity, $product_price, $product_img);
            $cart->add_product($newProduct_id, $new_product);
            
            //Update the counter
            $_SESSION['counter'] = $counter + 1;
            $_SESSION['cart'] = serialize($cart);


            mysqli_close($link);
    
            header("Location: ../cart.php");
            exit;
        }
    }else {
        echo "<script type='text/javascript'>
                alert('Please login.'); 
                window.location.href = '../login.php';
            </script>";
    }
?>