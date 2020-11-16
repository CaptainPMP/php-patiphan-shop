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
            
            <h1>ฟอร์มแก้ไขสินค้า</h1>
            <?php
                $product_id = $_GET['edit'];
                $sql = "SELECT * FROM products as p INNER JOIN products_type as t ON p.type_id = t.type_id WHERE p.product_id = $product_id";
                $result1 = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result1);

                $query = "SELECT * FROM products_type ORDER BY type_id";
                $result = mysqli_query($conn, $query);
            ?>
            <form action="edit_products_db.php" method="post" class="adduser" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                <input type="hidden" name="img2" value="<?php echo $row['pic'] ?>">
                <input type="text" name="product_name" value="<?php echo $row['product_name'] ?>" placeholder="ใส่ชื่อสินค้า" required>
                <br>
                <input type="text" name="product_price" value="<?php echo $row['price'] ?>" placeholder="ใส่ราคาสินค้า" required>
                <br>
                <input type="text" name="product_qty" value="<?php echo $row['product_qty'] ?>" placeholder="ใส่จำนวนสินค้า" required>
                <br>
                <p>ประเภทสินค้า</p>
                <select name="type_id" required>
                    <option value="<?php echo $row['type_id']; ?>">
                        <?php echo $row['type_name']; ?>
                    </option>
                    <option value="type_id">ประเภทสินค้า</option>
                    <?php foreach($result as $results) { ?>
                    <option value="<?php echo $results['type_id'] ?>">
                        <?php echo $results['type_name'] ?>
                    </option>
                    <?php  }?>
                </select>
                <br>
                <p>ภาพสินค้า</p>
                <br>
                <img src="../img/<?php echo $row['pic']; ?>" width="100" alt="">
                <br>
                <input type="file" name="product_img">
                <br>
                <textarea name="product_detail" placeholder="ใส่รายละเอียดสินค้า" required><?php echo $row['product_detail']; ?></textarea>
                <br>
                <input type="submit" name="edit_product" value="update">
            </form>
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