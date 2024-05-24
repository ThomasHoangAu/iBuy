<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <title>iBuy</title>
    </head>
    <body>
        <header>
            <div class="container">
                <a href="index.php">
                    <img class="logo" src="./assets/logo.png" alt="" />
                </a>
            </div>
        </header>

        <div class="container">
            <form id="sign-form" class="sign" action="controller/signup_authentication.php" method="post">
                <div class="title">Sign Up</div>
                <div>
                    <input id="email" type="text" placeholder="Email" name="email" />
                    <div class="error-message">
                        <span id="emailError"></span>
                    </div>
                </div>

                <div>
                    <input
                        type="password"
                        id="password"
                        placeholder="Password"
                        name="password"
                    />
                    <div class="error-message">
                        <span id="passwordError"></span>
                    </div>
                </div>

                <div>
                    <input
                        type="password"
                        id="confirm-password"
                        placeholder="Confirm Password"
                        name="confirm-password"
                    />
                    <div class="error-message">
                        <span id="confirmPasswordError"></span>
                    </div>
                </div>

                <div>
                    <input
                        type="text"
                        id="first-name"
                        placeholder="First Name"
                        name="first_name"
                    />
                    <div class="error-message">
                        <span id="firstNameError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="last-name"
                        placeholder="Last Name"
                        name="last_name"
                    />
                    <div class="error-message">
                        <span id="lastNameError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="phone"
                        placeholder="Phone"
                        name="phone"
                    />
                    <div class="error-message">
                        <span id="phoneError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="address"
                        placeholder="Address"
                        name="address"
                    />
                    <div class="error-message">
                        <span id="addressError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="city"
                        placeholder="City"
                        name="city"
                    />
                    <div class="error-message">
                        <span id="cityError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="state"
                        placeholder="State"
                        name="state"
                    />
                    <div class="error-message">
                        <span id="stateError"></span>
                    </div>
                </div>
                
                <div>
                    <input
                        type="text"
                        id="postcode"
                        placeholder="Post code"
                        name="postcode"
                    />
                    <div class="error-message">
                        <span id="postcodeError"></span>
                    </div>
                </div>

                <div>
                    <button type="submit" class="button">Sign Up</button>
                </div>
            </form>
            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
    <script src="js/signup_validation.js"></script>
</html>
