<?php
    $email = $_POST['email'];
    $pass_word = $_POST['password'];
    $hash_password = password_hash($pass_word, PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];

    require_once __DIR__ . '/../connection/conn_iBuyDb.php';

    $emailQuery = "SELECT email from customers WHERE (email = '$email')";
    $result = mysqli_query($link, $emailQuery);
    
    if(mysqli_num_rows($result) == 1) {
        echo "<script type='text/javascript'>
                alert('Email is existed. Please try again!');
                window.location.href = 'signup';
            </script>";
    }

    $query = "INSERT INTO customers (first_name, last_name, email, pass_word, address, city, state, postal_code, phone) 
                VALUES ('$first_name', '$last_name', '$email', '$hash_password', '$address', '$city', '$state', '$postcode', '$phone')";
    
    mysqli_query($link, $query);
    mysqli_close($link);

    echo "<script type='text/javascript'>
            alert('You are registered successfuly. Please login.');
            window.location.href = 'login';
        </script>";
    
?>