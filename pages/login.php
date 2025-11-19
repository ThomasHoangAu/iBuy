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
                <a href="home">
                    <img class="logo logo-mobile" src="/iBuy/assets/logo.png" alt="" />
                </a>
            </div>
        </header>

        <div class="container">
            <form
                id="sign-form"
                class="sign"
                action="login_authentication"
                method="post"
            >
                <div class="title">Log In</div>
                <div>
                    <input
                        id="email"
                        type="text"
                        placeholder="Email"
                        name="email"
                    />
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
                    <button type="submit" class="button">Log In</button>
                </div>
                
                <?php
                    // Check if error parameter is present in the URL
                    if (isset($_GET['error']) && $_GET['error'] == 1) {
                        echo "
                                <div style='padding-bottom: 20px;'>
                                    <p style='color: red;'>Incorrect email or password. Please try again!</p>
                                    </br>
                                    <a href='signup' style='color: blue;'>Register an account</a>
                                </div>
                            ";
                    }
                ?>
            </form>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
    <script src="/iBuy/js/login_validation.js"></script>
</html>
