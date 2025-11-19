<!DOCTYPE html>
<link rel="icon" type="image/x-icon" href="/iBuy/favicon.ico">

<?php
    // Get requested URL path
    $url = isset($_GET['url']) ? $_GET['url'] : 'home';

    // Trim slashes
    $url = trim($url, '/');

    // Routing
    switch ($url) {
        case 'home':
            include 'pages/home.php';
            break;
        
        case 'search':
            include 'pages/search.php';
            break;
        
        case 'login':
            include 'pages/login.php';
            break;

        case 'login_authentication':
            include 'controller/login_authentication.php';
            break;
        
        case 'signup':
            include 'pages/signup.php';
            break;

        case 'signup_authentication':
            include 'controller/signup_authentication.php';
            break;
        
        case 'product':
            include 'pages/product.php';
            break;

        case 'cart':
            include 'pages/cart.php';
            break;

        case 'paymentDetail':
            include 'pages/paymentDetail.php';
            break;

        case 'displayOrder':
            include 'pages/displayOrder.php';
            break;

        case 'addToCart':
            include 'controller/addToCart.php';
            break;

        case 'deleteCartItem':
            include 'controller/deleteCartItem.php';
            break;

        case 'changeQuantity':
            include 'controller/changeQuantity.php';
            break;

        case 'logout':
            include 'controller/logout.php';
            break;

        case 'submitOrder':
            include 'controller/submitOrder.php';
            break;
    }
?>