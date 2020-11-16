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
            
            <h1>ฟอร์มแก้ไขสมาชิก</h1>
            <?php
                if($_GET['edit']){
                    $user_id = $_GET['edit'];
                    $sql = "SELECT * FROM users WHERE user_id = $user_id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                }
            ?>
            <form action="member_edit_db.php" method="post" class="edituser">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <input type="text" name="user_name" value="<?php echo $row['username'] ?>" placeholder="ใส่ชื่อผู้ใช้" required>                <br>
                <input type="password" value="<?php echo $row['password'] ?>" name="user_password" placeholder="ใส่รหัสผ่าน" required>
                <br>
                <input type="text" name="user_email" value="<?php echo $row['email'] ?>" placeholder="ใส่อีเมลล์" required>
                <br>
                <input type="text" name="user_phone" value="<?php echo $row['phone'] ?>" placeholder="ใส่เบอร์โทรศัพท์" required>
                <br>
                <textarea name="user_address" placeholder="ใส่ที่อยู่" required><?php echo $row['address'] ?></textarea>
                <br>
                <input type="submit" name="update" value="update">
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