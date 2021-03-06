<?php

    session_start();

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
            <div class="login-form">
                <img width="10%" src="img/login.jpg" alt="">
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
                <h1>Login - เข้าสู่ระบบ</h1>
                <br>
                <form action="login_process.php" method="post">
                    <input type="text" name="username" placeholder="Enter your username" required>
                    <br>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <br>
                    <input type="submit" name="login_user" value="login">
                </form>
                <a style="color: blue; font-size: 12px;" href="register.php">สมัครสมาชิก</a>
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