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
                <div class="search">
                    <input type="text" />
                    <div class="search-icon">
                        <a href="#">
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
                        </a>
                    </div>
                </div>
                
                <?php
                    if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == true) {
                        echo "
                                <div class='loggedin'>
                                    <div class='sign-up'>
                                    <a href='#'>
                                        <p>
                                            ".$user."
                                        </p>
                                    </a>
                                    </div>
                                    <div class='separate'></div>
                                    <div class='log-in'>
                                        <a href='logout.php'><p>Log Out</p></a>
                                    </div>
                                    <div class='separate'></div>
                                    <div class='cart-icon'>
                                        <a href='cart.html'>
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
                                    </div>
                                </div>
                                
                        
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
            <div class="product-detail">
                <?php
                    require_once('conn_iBuyDb.php');

                    // Check if product ID is provided in the URL
                    if(isset($_GET['id']) && !empty($_GET['id'])) {
                        // Sanitize the input to prevent SQL injection
                        $product_id = mysqli_real_escape_string($link, $_GET['id']);

                        // Fetch product details from the database
                        $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
                    
                        // Execute query
                        $result = mysqli_query($link, $sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            
                            // Display product details
                            echo "
                                    <div class='product-picture'>
                                        <img src='./assets/product/$row[product_image]' />
                                    </div>

                                    <div class='product-action'>
                                        <div class='product-description'>
                                            $row[description]
                                        </div>
                                        <div class='product-price'>$$row[price]</div>
                                        <div class='product-quantity'>
                                            <div>Quantity</div>
                                            <div class='quantity-button'>
                                                <button onclick='change(-1)' class='decrease'>
                                                    -
                                                </button>
                                                <input id='quantity' value='1' />
                                                <button onclick='change(1)' class='increase'>
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                        <div class='buy'>
                                            <button class='add-to-cart'>Add To Cart</button>
                                            <button class='buy-now'>Buy Now</button>
                                        </div>
                                    </div>
                                ";
                        } else {
                            echo "Product not found";
                        }
                    }else {
                        echo "Invalid product ID";
                    }

                    mysqli_close($link);
                ?>

                
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>

    <script src="./quantity.js"></script>
</html>
