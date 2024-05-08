<?php
        session_start();
        require_once('conn_iBuyDb.php');

        if(isset($_POST['pay_fname'], $_POST['pay_lname'], $_POST['pay_email'], $_POST['pay_address'], 
        $_POST['pay_city'], $_POST['pay_state'], $_POST['pay_pcode'], $_POST['pay_phone'], $_POST['total'], 
        $_POST['gst'], $_POST['card_type'], $_POST['card_no'], $_POST['code'], $_POST['exp_date'])) {
            $_SESSION['pay_fname'] = $pay_fname = $_POST['pay_fname'];
            $_SESSION['pay_lname'] = $pay_lname = $_POST['pay_lname'];
            $_SESSION['pay_email'] = $pay_email = $_POST['pay_email'];
            $_SESSION['pay_address'] = $pay_address = $_POST['pay_address'];
            $_SESSION['pay_city'] = $pay_city = $_POST['pay_city'];
            $_SESSION['pay_state'] = $pay_state = $_POST['pay_state'];
            $_SESSION['pay_pcode'] = $pay_pcode = $_POST['pay_pcode'];
            $_SESSION['pay_phone'] = $pay_phone = $_POST['pay_phone'];
            $_SESSION['total'] = $total = $_POST['total'];
            $_SESSION['gst'] = $gst = $_POST['gst'];
            $_SESSION['card_type'] = $card_type = $_POST['card_type'];
            $_SESSION['card_no'] = $card_no = $_POST['card_no'];
            $_SESSION['code'] = $code = $_POST['code'];
            $_SESSION['exp_date'] = $exp_date = $_POST['exp_date'];
        }else {
            $_SESSION['pay_fname'] = $pay_fname = '';
            $_SESSION['pay_lname'] = $pay_lname = '';
            $_SESSION['pay_email'] = $pay_email = '';
            $_SESSION['pay_address'] = $pay_address = '';
            $_SESSION['pay_city'] = $pay_city = '';
            $_SESSION['pay_state'] = $pay_state = '';
            $_SESSION['pay_pcode'] = $pay_pcode = '';
            $_SESSION['pay_phone'] = $pay_phone = '';
            $_SESSION['total'] = $total = '';
            $_SESSION['gst'] = $gst = '';
            $_SESSION['card_type'] = $card_type = '';
            $_SESSION['card_no'] = $card_no = '';
            $_SESSION['code'] = $code = '';
            $_SESSION['exp_date'] = $exp_date = '';
        }
        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <title>iBuy</title>
    </head>
    <body>
    <header>
            <div class="container">
                <a href="index.php">
                    <img class="logo" src="./assets/logo.png" alt="" />
                </a>
                <form class="search" action="search.php" method="POST">
                    <input type="text" name="search" />
                    <button type="submit" class="search-icon">
                        <div>
                            <svg
                                fill="white"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                            >
                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                />
                            </svg>
                        </div>
                    </button>
                </form>

                <?php
                    if(isset($_SESSION['loggedin'])) {
                        $userName = ucfirst($_SESSION['first_name']).' '.ucfirst($_SESSION['last_name']);
                        echo "
                                <div class='loggedin'>
                                    <div class='sign-up'>
                                    <a href='#'>
                                        <p>
                                            ".$userName."
                                        </p>
                                    </a>
                                    </div>
                                    <div class='separate'></div>
                                    <div class='log-in'>
                                        <a href='logout.php'><p>Log Out</p></a>
                                    </div>
                                    <div class='separate'></div>
                                    <div class='cart-icon'>
                                        <a href='cart.php'>
                                            <svg
                                                fill='white'
                                                xmlns='http://www.w3.org/2000/svg'
                                                viewBox='0 0 576 512'
                                            >
                                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d='M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z'
                                                />
                                            </svg>
                                        </a>
                                        <div id='itemNotification'></div>
                                    </div>
                                </div>
                            ";

                            // Display cart notification
                            $lastOrderQuery = "SELECT order_id, is_paid FROM orders WHERE (customer_id = '$_SESSION[customer_id]' AND is_paid = 0) ORDER BY order_id DESC LIMIT 1";
                            $lastOrderResult = mysqli_query($link, $lastOrderQuery);
                            $lastOrderRow = $lastOrderResult->fetch_row();
                            if($lastOrderRow != null) {
                                $lastOrderId = $lastOrderRow[0];
                            }else{
                                $lastOrderId = null;
                            }
                            $cartQuery = "SELECT COUNT(order_detail_id) FROM order_details WHERE order_id = '$lastOrderId'";
                            $cartResult = mysqli_query($link, $cartQuery);
                            $cartRow = $cartResult->fetch_row();
                            $numOfItems = $cartRow[0];
                    
                            echo "
                                    <script>
                                        const numOfItems = $numOfItems;
                                        let notification = document.getElementById('itemNotification');
                                        notification.style.display = 'block';
                                        if (numOfItems > 0) {
                                            notification.textContent = numOfItems;
                                        } else {
                                            notification.style.display = 'none';
                                        }
                                    </script>
                                ";
                    } else {
                            echo "
                                    <div class='not-loggedin'>
                                        <div class='sign-up'>
                                            <a href='signup.php'><p>Sign Up</p> </a>
                                        </div>
                                        <div class='separate'></div>
                                        <div class='log-in'>
                                            <a href='login.php'><p>Log In</p></a>
                                        </div>
                                    </div>
                                ";
                            }
                ?>
            </div>
        </header>

        <div class="container">
            <div class="cart">
                <div class="title">Display Order</div>
                <form action="submitOrder.php" method="POST" id="process_payment" class="form">
                    <fieldset>
                        <legend>Shipping details:</legend>

                        <ol>
                            <li>
                                <label for="pay_fname">First Name:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_fname"
                                    id="pay_fname"
                                    value="<?php echo $pay_fname; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_lname">Last Name:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_lname"
                                    id="pay_lname"
                                    value="<?php echo $pay_lname; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_email">Email:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_email"
                                    id="pay_email"
                                    value="<?php echo $pay_email; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_address"
                                    >Shipping Address:</label
                                >

                                <input
                                    disabled
                                    type="text"
                                    name="pay_address"
                                    id="pay_address"
                                    value="<?php echo $pay_address; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_city">City:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_city"
                                    id="pay_city"
                                    value="<?php echo $pay_city; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_state">State:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_state"
                                    id="pay_state"
                                    value="<?php echo $pay_state; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_pcode">Postcode:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="pay_pcode"
                                    id="pay_pcode"
                                    value="<?php echo $pay_pcode; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_phone">Telephone:</label>

                                <input
                                    disabled
                                    type="phone"
                                    name="pay_phone"
                                    id="pay_phone"
                                    value="<?php echo $pay_phone; ?>"
                                />
                            </li>
                        </ol>
                    </fieldset>

                    <fieldset>
                        <legend>Payment details:</legend>

                        <ol>
                            <li>
                                <label>Total:</label>
                                <div class='display_total'>
                                    <span>$</span>
                                    <input disabled type='text' name='total' id='total' value='<?php echo $total; ?>' />
                                </div>
                            </li>

                            <li>
                                <label>GST included:</label>
                                <div class='display_total'>
                                    <span>$</span>
                                    <input disabled type='text' name='gst' id='total' value='<?php echo $gst; ?>' />
                                </div>
                            </li>

                            <li>
                                <label>Card Type:</label>
                                <input
                                    disabled
                                    type="text"
                                    name="card_type"
                                    id="card_type"
                                    value="<?php echo $card_type; ?>"
                                />
                            </li>

                            <li>
                                <label for="card_no">Card number:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="card_no"
                                    id="card_no"
                                    value="<?php echo $card_no; ?>"
                                />
                            </li>

                            <li>
                                <label for="code">Verification code:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="code"
                                    id="code"
                                    value="<?php echo $code; ?>"
                                />
                            </li>

                            <li>
                                <label for="exp_date">Expiry Date:</label>

                                <input
                                    disabled
                                    type="text"
                                    name="exp_date"
                                    id="exp_date"
                                    value="<?php echo $exp_date; ?>"
                                />
                            </li>
                        </ol>

                        <div class='buy'>
                            <button class="button" type="submit">Submit Order</button>
                            <button class='button' type="button">
                                <a href='paymentDetail.php'>Back</a>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
</html>
