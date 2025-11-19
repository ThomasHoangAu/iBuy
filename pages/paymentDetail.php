<?php
        session_start();
        require_once __DIR__ . '/../connection/conn_iBuyDb.php';

        if(!isset($_SESSION['pay_fname'], $_SESSION['pay_lname'], $_SESSION['pay_email'], $_SESSION['pay_address'], 
        $_SESSION['pay_city'], $_SESSION['pay_state'], $_SESSION['pay_pcode'], $_SESSION['pay_phone'], $_SESSION['card_type'], $_SESSION['card_no'], $_SESSION['code'], $_SESSION['exp_date'])) {
            $_SESSION['pay_fname'] = '';
            $_SESSION['pay_lname'] = '';
            $_SESSION['pay_email'] = '';
            $_SESSION['pay_address'] = '';
            $_SESSION['pay_city'] = '';
            $_SESSION['pay_state'] = '';
            $_SESSION['pay_pcode'] = '';
            $_SESSION['pay_phone'] = '';
            $_SESSION['card_type'] = 'Visa';
            $_SESSION['card_no'] = '';
            $_SESSION['code'] = '';
            $_SESSION['exp_date'] = '';
        }

        if($_SESSION['card_type'] == '') {
            $_SESSION['card_type'] = 'Visa';
        }

        if(isset($_POST['gst'], $_POST['total'])) {
            $_SESSION['gst'] = $_POST['gst'];
            $_SESSION['total'] = $_POST['total'];
            $gst = $_SESSION['gst'];
            $total = $_SESSION['total'];
        }else if(!isset($_SESSION['total'], $_SESSION['gst'])) {
                $gst = '';
                $total = '';
                echo "<script type='text/javascript'>
                            alert('You did not pay. Please back to cart to pay!'); 
                            window.location.href = 'cart';
                        </script>";
            }else {
                $gst = $_SESSION['total'];
                $total = $_SESSION['gst'];
            }
        
        $json = json_encode($_SESSION['card_type']);
        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="/iBuy/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="/iBuy/css/responsive.css" />
        <title>iBuy</title>
    </head>
    <body>
    <header>
            <div class="container">
                <a class="logo-mobile" href="home">
                    <img class="logo" src="/iBuy/assets/logo.png" alt="" />
                </a>
                <form class="search search-mobile" action="search" method="POST">
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
                                        <a href='logout'><p>Log Out</p></a>
                                    </div>
                                    <div class='separate'></div>
                                    <div class='cart-icon'>
                                        <a href='cart'>
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
                            if(isset($_SESSION['counter']) && $_SESSION['counter'] > 0) {
                                $numOfItems = $_SESSION['counter'];
                            }else {
                                $numOfItems = 0;
                            }
                    
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
                                            <a href='signup'><p>Sign Up</p> </a>
                                        </div>
                                        <div class='separate'></div>
                                        <div class='log-in'>
                                            <a href='login'><p>Log In</p></a>
                                        </div>
                                    </div>
                                ";
                            }
                ?>
            </div>
        </header>

        <div class="container">
            <div class="cart">
                <div class="title">Payment</div>
                <form action="displayOrder" method="POST" id="process_payment" class="form">
                    <fieldset>
                        <legend>Shipping details:</legend>

                        <ol>
                            <li>
                                <label for="pay_fname">First Name:</label>

                                <input
                                    type="text"
                                    name="pay_fname"
                                    id="pay_fname"
                                    value="<?php echo $_SESSION['pay_fname']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_lname">Last Name:</label>

                                <input
                                    type="text"
                                    name="pay_lname"
                                    id="pay_lname"
                                    value="<?php echo $_SESSION['pay_lname']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_email">Email:</label>

                                <input
                                    type="text"
                                    name="pay_email"
                                    id="pay_email"
                                    value="<?php echo $_SESSION['pay_email']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_address"
                                    >Shipping Address:</label
                                >

                                <input
                                    type="text"
                                    name="pay_address"
                                    id="pay_address"
                                    value="<?php echo $_SESSION['pay_address']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_city">City:</label>

                                <input
                                    type="text"
                                    name="pay_city"
                                    id="pay_city"
                                    value="<?php echo $_SESSION['pay_city']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_state">State:</label>

                                <input
                                    type="text"
                                    name="pay_state"
                                    id="pay_state"
                                    value="<?php echo $_SESSION['pay_state']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_pcode">Postcode:</label>

                                <input
                                    type="text"
                                    name="pay_pcode"
                                    id="pay_pcode"
                                    value="<?php echo $_SESSION['pay_pcode']; ?>"
                                />
                            </li>

                            <li>
                                <label for="pay_phone">Telephone:</label>

                                <input
                                    type="phone"
                                    name="pay_phone"
                                    id="pay_phone"
                                    value="<?php echo $_SESSION['pay_phone']; ?>"
                                />
                            </li>
                        </ol>
                    </fieldset>

                    <fieldset>
                        <legend>Payment details:</legend>

                        <ol>
                            <li style="display: none;">
                                <label>Total:</label>
                                <div class='display_total'>
                                    <span>$</span>
                                    <input type='text' name='total' id='total' value='<?php echo $total; ?>' />
                                </div>
                            </li>

                            <li style="display: none;">
                                <label>GST included:</label>
                                <div class='display_total'>
                                    <span>$</span>
                                    <input type='text' name='gst' id='total' value='<?php echo $gst; ?>' />
                                </div>
                            </li>

                            <li>
                                <label>Card Type:</label>
                                
                                <select name="card_type" id="card_type">
                                    <option value="Visa">Visa</option>

                                    <option value="Master Card">
                                        Master Card
                                    </option>

                                    <option value="American Express">
                                        American Express
                                    </option>
                                </select>

                                <?php
                                    echo "
                                            <script>
                                                document.getElementById('card_type').value = $json;
                                            </script>
                                        ";
                                ?>
                            </li>

                            <li>
                                <label for="card_no">Card number:</label>

                                <input
                                    type="text"
                                    name="card_no"
                                    id="card_no"
                                    value="<?php echo $_SESSION['card_no']; ?>"
                                />
                            </li>

                            <li>
                                <label for="code">Verification code:</label>

                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    value="<?php echo $_SESSION['code']; ?>"
                                />
                            </li>

                            <li>
                                <label for="exp_date">Expiry Date:</label>

                                <input
                                    type="text"
                                    name="exp_date"
                                    id="exp_date"
                                    value="<?php echo $_SESSION['exp_date']; ?>"
                                />
                            </li>
                        </ol>

                        <div class='buy'>
                            <button class="button" type="submit">Display Order</button>
                            <button class='button' type="button">
                                <a href='home'>Shopping</a>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
</html>
