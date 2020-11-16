<?php

    include('server.php');

    if(isset($_GET['delete'])) {
        $user_id = mysqli_real_escape_string($conn, $_GET['delete']);
        $sql = "DELETE FROM users WHERE user_id = $user_id ";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบสมาชิกเรียบร้อยแล้ว');";
            echo "window.location = 'dashboard.php';";
            echo "</script>";
        }
        else {
            echo "<script type='text/javascript'>";
            echo "alert('มีบางอย่างผิดพลาด');";
            echo "window.location = 'dashboard.php';";
            echo "</script>";
        }

        mysqli_close($conn);
    }

?>