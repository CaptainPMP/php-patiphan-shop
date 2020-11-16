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
            <a href="product_type_add.php" style="padding: .5rem; background: green; display: inline-block; color:#fff; text-decoration: none;">เพิ่มประเภทสินค้า</a>
            <?php
                $query = "SELECT * FROM products_type";
                $result = mysqli_query($conn, $query);
            ?>
            <table width="100%">
                <tr>
                    <td>ID</td>
                    <td>Product Type</td>
                    <td colspan="2">Actions</td>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['type_id'] ?></td>
                    <td><?php echo $row['type_name'] ?></td>
                    <td><a href="product_type_edit.php?edit=<?php echo $row['type_id']; ?>">แก้ไข</a></td>
                    <td><a href="product_type_delete.php?delete=<?php echo $row['type_id']; ?>" onclick="return confirm('คุณต้องการประเภทสินค้าใช่ไหม');">ลบ</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>
        
    </section>

    <footer>
        <div class="container">
            <p>&copy; Copyright 2020. All Right Reserved MyShop</p>
        </div>
    </footer>

</body>
</html>