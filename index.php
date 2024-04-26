<?php
    session_start();
    if(isset($_SESSION['first_name']) and isset($_SESSION['last_name'])) {
        $userName = ucfirst($_SESSION['first_name']).' '.ucfirst($_SESSION['last_name']);
    }

    require_once('conn_iBuyDb.php');

    // SQL query to fetch products
    $sql = "SELECT * FROM products";

    // Execute query
    $result = mysqli_query($link, $sql);
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="styles.css?version=51" />
        <title>iBuy</title>
    </head>
    <body>
        <header>
            <div class="container">
                <a href="index.html">
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
            <div class="banner">
                <div class="mySlides fade">
                    <img src="./assets/banner/banner1.jpg" style="width: 80%" />
                </div>

                <div class="mySlides fade">
                    <img src="./assets/banner/banner2.jpg" style="width: 80%" />
                </div>

                <div class="mySlides fade">
                    <img src="./assets/banner/banner3.jpg" style="width: 80%" />
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br />

            <!-- The dots/circles -->
            <div style="text-align: center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

            <div class="title">Everyday Product</div>
            
            
            <div class="product-list">
                <?php
                    // Check if any rows are returned
                    if(mysqli_num_rows($result) > 0) {
                        // Fetch data and display it in a table
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "
                                <div>
                                    <a class='product-item' href='product.php?id=$row[product_id]'>
                                        <img src='./assets/product/$row[product_image]'/>
                                    </a>
                                    <p class='discription'>$row[name]</p>
                                    <p class='symbol'>$<span class='price'>$row[price]</span></p>
                                </div>
                            
                            ";
                        }
                    }else {
                        echo "0 results";
                    }

                    mysqli_close($link);
                ?>
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>

    <script src="banner.js"></script>
</html>

