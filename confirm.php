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
            
            <br>
            <form action="saveorder.php" method="post">
                <h1>รายละเอียดการสั่งซื้อสินค้า</h1>
                <br>
                <table width="100%" border="1" style="border-collapse: collapse;">
                    <tr>
                        <td>สินค้า</td>
                        <td>ราคา</td>
                        <td>จำนวน</td>
                        <td>รวม</td>
                    </tr>
                    <?php
                        $total = 0;
                        if (!empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $product_id => $qty){
                                $sql = "SELECT * FROM products WHERE product_id = $product_id";
                                $query = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($query);
                                $sum = $row['price'] * $qty;
                                $total += $sum;
                    ?>
                    <tr>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo number_format($sum, 2) ?></td>
                    </tr>
                            <?php } ?>
                    <tr>
                        <td colspan="3">ราคารวม</td>
                        <td><?php echo number_format($total, 2) ?></td>
                    </tr>
                            <?php } ?>
                </table>
                <br>
                <table>
                    <?php 
                        $query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."' ";
                        $result = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr><td>รายละเอียดการส่งสินค้า</td></tr>
                    <input type="hidden" name="cust_name" value="<?php echo $row['username']; ?>">
                    <input type="hidden" name="total" value=" <?php echo $total; ?> ">
                    <tr>
                        <td>ชื่อ</td>
                        <td><input type="text" name="name" placeholder="ชื่อ-สกุล" required></td>
                    </tr>
                    <tr>
                        <td>เบอร์โทรศัพท์</td>
                        <td><input type="text" name="phone" placeholder="เบอร์โทรศัพท์" required></td>
                    </tr>
                    <tr>
                        <td>อีเมลล์</td>
                        <td><input type="text" name="email" placeholder="อีเมลล์" required></td>
                    </tr>
                    <tr>
                        <td>ที่อยู่</td>
                        <td><textarea name="address" placeholder="ที่อยู่" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input style="width: 100%; cursor: pointer; background: green; color: #fff; padding: .5rem;" type="submit" name="save_order" value="สั่งซื้อ"></td>
                    </tr>
                </table>
            </form>

        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; Copyright 2020, All Right Reserved MyShop.</p>
        </div>
    </footer>
</body>
</html>