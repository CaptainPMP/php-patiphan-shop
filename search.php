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
            <div class="search_c">
                <h1>Results : </h1>
                <?php
                    if(isset($_GET['search_name'])) {
                        $search_name = $_GET['search_name'];
                        $query = "SELECT * FROM products WHERE product_name LIKE '%".$search_name."%'";
                        $result = mysqli_query($conn, $query);
                ?>

                <div class="search-grid">
                    <?php 
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <div class="search-items">
                        <h3><?php echo $row['product_name']; ?></h3>
                        <img src="img/<?php echo $row['pic']; ?>" alt="">
                        <h5>ราคา <?php echo $row['price']; ?> บาท</h5>
                    </div>
                    <?php }} else {
                        echo "<h1>No Results</h1>";
                    }
                    } 
                    ?>
                </div>
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