<?php
    $email = $_POST['email'];
    $pass_word = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];

    require_once('conn_iBuyDb.php');

    $emailQuery = "SELECT email from customers WHERE (email = '$email')";
    $result = mysqli_query($link, $emailQuery);
    
    if(mysqli_num_rows($result) == 1) {
        header("Location: signup.php?error=2");
        exit;
    }

    $query = "INSERT INTO customers (first_name, last_name, email, pass_word, address, city, state, postal_code, phone) 
                VALUES ('$first_name', '$last_name', '$email', '$pass_word', '$address', '$city', '$state', '$postcode', '$phone')";
    
    mysqli_query($link, $query);
    mysqli_close($link);

    echo "<script type='text/javascript'>
            alert('You are registered successfuly. Please login.');
            window.location.href = 'login.php';
        </script>";
    
?>