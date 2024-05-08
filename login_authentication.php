<?php
    session_start();
    $email = $_POST['email'];
    $pass_word = $_POST['password'];

    require_once('conn_iBuyDb.php');

    $query = "SELECT customer_id, first_name, last_name, email, pass_word, phone from customers WHERE (email = '$email')";
    $result = mysqli_query($link, $query);
    
    $row = $result->fetch_row();
    $customer_id = $row[0];
    $first_name = $row[1];
    $last_name = $row[2];
    $email = $row[3];
    $pass = $row[4];
    $phone = $row[5];
    mysqli_close($link);
    
    if(mysqli_num_rows($result) == 1 && password_verify($pass_word, $pass)) {
            //save the values in session variables
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;

            //re-direct to home page
            header("Location: index.php");
            exit;
    }else {
        header("Location: login.php?error=1");
        exit;
    }
?>