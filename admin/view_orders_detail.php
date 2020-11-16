<?php

    session_start();
    include('server.php');

    if($_SESSION['userid'] == "") {
        header("location: index.php");
        exit();
    }

    if ($_SESSION['status'] != "admin") {
        echo "This page for admin only";
        exit();
    }

    $sql = "SELECT * FROM admin WHERE id = '".$_SESSION['userid']."' ";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <h1>Welcome <?php echo $result['username']; ?></h1>
    </header>

    <section>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="product_list.php">จัดการสินค้า</a></li>
                <li><a href="product_type.php">จัดการประเภทสินค้า</a></li>
                <li><a href="view_orders.php">จัดการออเดอร์</a></li>
                <li class="logout"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="info">
            <h1>ออเดอร์ทั้งหมด</h1>
            <br>
            <?php
                $detail_id = $_GET['detail'];
                $query = "SELECT * FROM orders_detail ORDER BY order_id";
                $result = mysqli_query($conn, $query);
            ?>
            <table width="100%">
                <tr>
                    <td>Order Id</td>
                    <td>Product Id</td>
                    <td>Order QTY</td>
                    <td>Order Total</td>
                    <td colspan="3">Actions</td>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['order_id'] ?></td>
                    <td><?php echo $row['product_id'] ?></td>
                    <td><?php echo $row['qty'] ?></td>
                    <td><?php echo $row['total'] ?></td>
                    <td><a href="view_orders.php">กลับ</a></td>
                </tr>
                <?php } ?>
            </table>

            <?php mysqli_close($conn); ?>
        </div>
        
    </section>

    <footer>
        <div class="container">
            <p>&copy; Copyright 2020. All Right Reserved MyShop</p>
        </div>
    </footer>

</body>
</html>