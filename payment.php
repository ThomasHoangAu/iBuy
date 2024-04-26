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
                <a href="index.html">
                    <img class="logo" src="./assets/logo.png" alt="" />
                </a>
            </div>
        </header>

        <div class="container">
            <div class="cart">
                <div class="title">Payment</div>
                <form action="" method="post" id="process_payment" class="form">
                    <fieldset>
                        <legend>Shipping details:</legend>

                        <ol>
                            <li>
                                <label for="pay_fname">First Name:</label>

                                <input
                                    type="text"
                                    name="pay_fname"
                                    id="pay_fname"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_lname">Last Name:</label>

                                <input
                                    type="text"
                                    name="pay_lname"
                                    id="pay_lname"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_email">Email:</label>

                                <input
                                    type="text"
                                    name="pay_email"
                                    id="pay_email"
                                    value=""
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
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_city">City:</label>

                                <input
                                    type="text"
                                    name="pay_city"
                                    id="pay_city"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_state">State:</label>

                                <input
                                    type="text"
                                    name="pay_state"
                                    id="pay_state"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_pcode">Postcode:</label>

                                <input
                                    type="text"
                                    name="pay_pcode"
                                    id="pay_pcode"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="pay_phone">Telephone:</label>

                                <input
                                    type="phone"
                                    name="pay_phone"
                                    id="pay_phone"
                                    value=""
                                />
                            </li>
                        </ol>
                    </fieldset>

                    <fieldset>
                        <legend>Payment details:</legend>

                        <ol>
                            <li>
                                <label for="phone">Card Type:</label>

                                <select name="card_type" id="card_type">
                                    <option value="Visa">Visa</option>

                                    <option value="Master Card">
                                        Master Card
                                    </option>

                                    <option value="American Express">
                                        American Express
                                    </option>
                                </select>
                            </li>

                            <li>
                                <label for="card_no">Card number:</label>

                                <input
                                    type="text"
                                    name="card_no"
                                    id="card_no"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="code">Verification code:</label>

                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    value=""
                                />
                            </li>

                            <li>
                                <label for="exp_date">Expiry Date:</label>

                                <input
                                    type="text"
                                    name="exp_date"
                                    id="exp_date"
                                    value=""
                                />
                            </li>
                        </ol>

                        <button class="button" type="submit">Submit</button>
                    </fieldset>
                </form>
            </div>

            <div class="footer">© 2024 iBuy. All Rights Reserved .</div>
        </div>
    </body>
</html>
