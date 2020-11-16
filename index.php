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
            <div class="content-c">
                <div class="sidebar-c">
                    <div class="sidebar-title">
                        <h3>หมวดหมู่สินค้า</h3>
                    </div>

                    <ul class="sidebar-categories">
                        <?php
                            $query = "SELECT * FROM products_type ORDER BY type_id";
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) == 0) {
                                echo "<li>ไม่มีหมวดหมู่สินค้า</li>";
                            } else {  ?>
                            <?php foreach($result as $results) { ?>
                                <li><a href="categories.php?type=<?php echo $results['type_id']; ?>"><?php echo $results['type_name'] ?></a></li>
                            <?php }} ?>
                    </ul>
                </div>

                <div class="product-c">
                    <br><br>
                    <?php if(isset($_SESSION['success'])) : ?>
                    <div class="success">
                        <h3>
                            <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </h3>
                    </div>
                    <br>
                <?php endif ?>
                    <div class="product-grid">
                        <?php
                            $sql = "SELECT * FROM products";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="product-items">
                            <div class="pd-img">
                                <h3><?php echo $row['product_name']; ?></h3>
                                <a href="product_details.php?detail=<?php echo $row['product_id'] ?>">
                                    <img src="img/<?php echo $row['pic']; ?>" alt="">
                                </a>
                            </div>
                            <div class="pd-info">
                                <p class="price">ราคา <?php echo $row['price']; ?> บาท</p>
                                <?php 
                                    if($row['product_qty'] == 0) {
                                        echo "<p style='color : red;'>สินค้าหมด</p>";
                                    } else {
                                ?>
                                <a href="cart.php?addtocart=<?php echo $row['product_id']; ?>" class="buy">สั่งซื้อ</a>
                                    <?php } ?>
                                <p class="label">จำนวนคงเหลือ <?php echo $row['product_qty'] ?> ชิ้น</p>
                            </div>
                        </div>
                        <?php }
                        } else {
                            echo "<h1>ไม่มีสินค้า</h1>";
                        }
                        ?>
                    </div>
                    <!-- Product Grid -->
                </div>
                <!-- product-c -->
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