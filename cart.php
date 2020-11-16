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
            <?php
                if(isset($_GET['addtocart'])){
                    $product_id = $_GET['addtocart'];

                    if(isset($_SESSION['cart'][$product_id])) {
                        $_SESSION['cart'][$product_id]++;
                    } else {
                        $_SESSION['cart'][$product_id] = 1;
                    }
                }

                if(isset($_GET['remove'])) {
                    $product_id = $_GET['remove'];
                    unset($_SESSION['cart'][$product_id]);
                }

                if(isset($_GET['update'])) {
                    $amount_array = $_POST['amount'];
                    foreach($amount_array as $product_id => $amount){
                        $_SESSION['cart'][$product_id] = $amount;
                    }
                }
            ?>
            <br>
            <form action="?update" method="post" name="cart">
                <h1>ตะกร้าสินค้า</h1>
                <br>
                <table width="100%" border="1" style="border-collapse: collapse;">
                    <tr>
                        <td>สินค้า</td>
                        <td>ราคา</td>
                        <td>จำนวน</td>
                        <td>รวม</td>
                        <td>ลบ</td>
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
                        <td><input type="number" name="amount[<?php echo $product_id; ?>]" value="<?php echo $qty ?>"></td>
                        <td><?php echo number_format($sum, 2) ?></td>
                        <td><a href="cart.php?remove=<?php echo $product_id ?>">X</a></td>
                    </tr>
                            <?php } ?>
                    <tr>
                        <td colspan="3">ราคารวม</td>
                        <td><?php echo number_format($total, 2) ?></td>
                        <td></td>
                    </tr>
                    <tr align="center">
                        <td align="left" colspan="3">
                            <a style="width: 100%; cursor: pointer; background: #15abe3; color:#fff; padding: .5rem; text-decoration: none; border-radius: 5px;" href="index.php">กลับไปหน้ารายการสินค้า</a>
                        </td>
                        <td>
                            <input style="width: 100%; cursor: pointer; background: #15abe3; color:#fff; padding: .5rem; text-decoration: none; border-radius: 5px;" type="submit" name="button" value="ปรับปรุง">
                        </td>
                        <td>
                            <input style="width: 100%; cursor: pointer; background: green; color:#fff; padding: .5rem; text-decoration: none; border-radius: 5px;" type="button" value="สั่งซื้อ" onclick="window.location='confirm.php'; ">
                        </td>
                    </tr>
                            <?php } ?>
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