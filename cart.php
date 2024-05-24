<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="styles.css?version=50" />
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
                    include './model/Cart.php';
                    include './model/Product.php';
                    require_once('conn_iBuyDb.php');

                    session_start();
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
                <div class="title">Cart</div>
                <div class="subject">
                    <input type="checkbox" style="opacity:0" />
                    <div class="subject-product">Product</div>
                    <div class="subject-price">Unit Price</div>
                    <div class="subject-quantity">Quantity</div>
                    <div class="subject-cost">Cost</div>
                </div>

                <?php
                    $cart = new Cart();
                    if(isset($_SESSION['counter']) && $_SESSION['counter'] >= 0) {
                        $cart = unserialize($_SESSION['cart']);
                        $products = $cart->products;
                        $key = array_keys($products);
                        for($i = 0; $i < $cart->get_depth(); $i++) {
                            $product = $cart->get_product($key[$i]);
                            $product_id = $product->get_product_id();
                            $product_des = $product->get_product_des();
                            $qty = $product->get_qty();
                            $unit_price = $product->get_unit_price();
                            $product_img= $product->get_product_img();

                            echo "
                                    <div class='content'>
                                        <form action='deleteCartItem.php?order_detail_id=$key[$i]' method='POST'>
                                            <input name='deleteButton' class='deleteButton' type='submit' value='X' />
                                        </form>
                                        <div class='content-product'>
                                            <img src='./assets/product/$product_img'/>
                                            <p>
                                                $product_des
                                            </p>
                                        </div>
                                        <div style='display: flex; justify-content:center'>
                                            <span>$</span>
                                            <span class='content-price'>$unit_price</span>
                                        </div>
                                        <form action='changeQuantity.php?order_detail_id=$key[$i]' class='quantity-button' method='POST'>
                                            <button type='submit' class='decrease'>-</button>
                                            <input class='quantity' name='quantity' value='$qty' />
                                            <button type='submit' class='increase'>+</button>
                                        </form>
                                        <div style='display:flex; justify-content:center'>
                                            <span>$</span>
                                            <span class='content-cost'>-</span>
                                        </div>
                                    </div>
                            ";
                        }
                    }else {
                        echo "0 results";
                    }
                    mysqli_close($link);
                    
                ?>
                
                <form action="paymentDetail.php" method="POST">
                    <div class="total">
                        <span style="font-size: 16px">GST Included: $</span>
                        <span style="font-size: 16px" id="gst">-</span>
                        <input type="hidden" id="gstInput" name="gst" />
                    </div>
                    <div class="total">
                        <span>Total: $</span>
                        <span id="total">-</span>
                        <input type="hidden" id="totalInput" name="total" />
                    </div>

                    <div class='buy'>
                        <button class='button' type="submit">Pay by Card</button>
                        <div class="paypal-button-container" style="text-align: center">
                            <div id="paypal-button-container"></div>
                            <div class="overlay">Pay by Paypal</div>
                        </div>
                        <script
                            src="https://www.paypal.com/sdk/js?client-id=AZj0-t_IitIxqxVv9ns7J2Ut7LGrg2NxCT4xpXad8FRHRGFR46DZFiIyzUCXjgITuC1JaRSlSxF-amMp&enable-funding=venmo&currency=AUD&disable-funding=card"
                            data-sdk-integration-source="button-factory"
                        ></script>

                        <button class='button'>
                            <a href='index.php'>Shopping</a>
                        </button>
                    </div>
                </form>
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
                    
    <script src="./costCalculation.js"></script>
</html>
