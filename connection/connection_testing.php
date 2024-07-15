<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Connection Testing</title>
    </head>
    <body>
        <?php
            $server = 'localhost';
            $user = 'root';
            $password = 'password';
            $database = 'ibuydb';
            $link = mysqli_connect($server, $user, $password, $database) or
            die('Error' . mysqli_error($link));

            $query = "SELECT email from customers WHERE (email = 'tung27@gmail.com')";
            $result = mysqli_query($link, $query);
            
            $row = $result->fetch_row();
            $email = $row[0];
            mysqli_close($link);

            echo $email;
        ?>
    </body>
</html>
