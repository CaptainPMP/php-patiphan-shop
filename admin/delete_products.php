<?php

    include('server.php');

    if(isset($_GET['delete'])) {
        $product_id = mysqli_real_escape_string($conn, $_GET['delete']);

        $sql = "DELETE FROM products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบสินค้าเรียบร้อยแล้ว');";
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