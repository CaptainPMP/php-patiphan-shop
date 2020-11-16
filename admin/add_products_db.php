<?php

    include("server.php");

    $numrand =mt_rand();

    if(isset($_POST['add_product'])) {
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_qty = mysqli_real_escape_string($conn, $_POST['product_qty']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['product_detail']);
        $product_type = mysqli_real_escape_string($conn, $_POST['type_id']);
        $product_img = (isset($_POST['product_img']) ? $_POST['product'] : '');

        $upload = $_FILES['product_img'];

        if ($upload != ''){
            $path = "../img/";
            $type = strrchr($_FILES['product_img']['name'], ".");
            $newname = 'img'.$numrand.$type;
            $path_copy = $path.$newname;
            $path_link = "../img/".$newname;
            move_uploaded_file($_FILES['product_img']['tmp_name'], $path_copy);
        }

        $sql = "INSERT INTO products (product_name, price, pic, product_qty, product_detail, type_id)
                VALUES ('$product_name', '$product_price', '$newname', '$product_qty', '$product_detail', '$product_type')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script type='text/javascript'>";
            echo "alert('เพิ่มสินค้าเรียบร้อยแล้ว');";
            echo "window.location = 'product_list.php';";
            echo "</script>";
        }
        else {
            echo "<script type='text/javascript'>";
            echo "alert('มีบางอย่างผิดพลาด');";
            echo "window.location = 'product_list.php';";
            echo "</script>";
        }

        mysqli_close($conn);
    }
?>