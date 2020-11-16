<?php
    session_start();

    include("server.php");

    if (!isset($_SESSION['username'])) {
        header("location: login.php");
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
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
            <?php if(isset($_GET['detail'])) {
                $productid = $_GET['detail'];
                $sql = "SELECT * FROM products WHERE product_id = $productid";
                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_assoc($query);
            } ?>
            <div style="text-align: center;" class="product-details">
                <br>
                <h1><?php echo $result['product_name']; ?></h1>
                <br>
                <img width="50%" src="img/<?php echo $result['pic']; ?>" alt="">
                <br>
                <p><?php echo $result['product_detail'] ?></p>
                <br>
                <a href="cart.php?addtocard=<?php echo $result['product_id'] ?>" style="background: green; display: inline-block; padding: .5rem 1rem; color:#fff; text-decoration:none; border-radius: 5px;">สั่งซื้อ</a>
                <br>
                <br>
                <a href="index.php" style="background: #ccc; display: inline-block; padding: .5rem 1rem; color:#000; text-decoration:none; border-radius: 5px;">กลับไปหน้าแรก</a>
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