<?php
    session_start();
    $email = $_POST['email'];
    $pass_word = $_POST['password'];

    require_once('conn_iBuyDb.php');

    $query = "SELECT first_name, last_name, email, pass_word, phone from customers WHERE (email = '$email')";
    $result = mysqli_query($link, $query);
    
    if(mysqli_num_rows($result) == 1) {
        $row = $result->fetch_row();
        $first_name = $row[0];
        $last_name = $row[1];
        $email = $row[2];
        $pass = $row[3];
        $phone = $row[4];
        mysqli_close($link);

        //save the values in session variables
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;

        if(password_verify($pass_word, $pass)) {
            //re-direct to home page
            header("Location: index.php");
            exit;
        }else {
            header("Location: login.php?error=1");
            exit;
        }
    }else {
        header("Location: login.php?error=1");
        exit;
    }
?>