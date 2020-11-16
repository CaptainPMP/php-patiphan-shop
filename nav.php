<ul class="menu">
    <li><a href="index.php">HOME</a></li>
    <li><a href="#">ABOUT</a></li>
    <li><a href="#">CONTACT</a></li>
    <li>
        <form action="search.php" class="search_bar" method="get">
            <span>ค้นหา</span>
            <input type="text" name="search_name" placeholder="ค้นหาสินค้า">
            <input type="submit" name="search_btn" value="Search">
        </form>
    </li>
</ul>

<ul class="login">
    <?php if(isset($_SESSION['username'])) : ?>
    <li>Welcome <strong><?php echo $_SESSION['username']; ?></strong></li>
    <li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ตะกร้า</a></li>
    <li><a href="my_orders.php"><i class="fa fa-list-alt" aria-hidden="true"></i> ดูรายการสินค้า</a></li>
    <li><a href="index.php?logout=<?php echo $_SESSION['username']; ?>" style="color: red;">logout</a></li>
    <?php else : ?>
    <li><a href="login.php">LOGIN</a></li>
    <li><a href="register.php">REGISTER</a></li>
    <?php endif ?>
</ul>