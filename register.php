<?php

    session_start();
    include("server.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <header>
        <div class="container">
            <div class="banner">
                <img width="100%" src="img/banner.jpg" alt="">
            </div>
        </div>
    </header>

    <nav>
        <div class="container">
            <div class="nav-c">
                <?php include('nav.php'); ?>
            </div>
        </div>
    </nav>

    <section>
        <div class="container">
            <div class="register-form">
                <img width="25%" src="img/register.jpg" alt="">
                <br><br>
                <?php if(isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <h3>
                            <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </h3>
                    </div>
                    <br>
                <?php endif ?>
                <h1>Register - สมัครสมาชิก</h1>
                <br>
                <form action="register_process.php" method="post">
                    <?php include('errors.php'); ?>
                    <input type="text" name="username" placeholder="Enter your username" required>
                    <br>
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <br>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <br>
                    <input type="password" name="c_password" placeholder="Confirm your password" required>
                    <br>
                    <input type="text" name="phone" placeholder="Enter your phone number" required>
                    <br>
                    <textarea name="address" placeholder="Enter your address" required></textarea>
                    <br>
                    <input type="submit" name="reg_user" value="register">
                </form>
                <a style="color: blue; font-size: 12px;" href="login.php">เข้าสู่ระบบ</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; Copyright 2020, All Right Reserved MyShop.</p>
        </div>
    </footer>
</body>
</html>