<?php

    include('server.php');

    if(isset($_POST['pd_type_edit'])) {
        $type_id = mysqli_real_escape_string($conn, $_POST['type_id']);
        $type_name = mysqli_real_escape_string($conn, $_POST['type_name']);

        $sql = "UPDATE products_type SET type_name = '$type_name' WHERE type_id = $type_id ";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขประเภทสินค้าเรียบร้อยแล้ว');";
            echo "window.location = 'product_type.php';";
            echo "</script>";
        }
        else {
            echo "<script type='text/javascript'>";
            echo "alert('มีบางอย่างผิดพลาด');";
            echo "window.location = 'product_type.php';";
            echo "</script>";
        }

        mysqli_close($conn);
    }

?>