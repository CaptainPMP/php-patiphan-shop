<?php

    include('server.php');

    if(isset($_POST['update'])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
        $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
        $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
        $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
        $hash_password = md5($user_password);

        $sql = "UPDATE users SET username = '$user_name', email = '$user_email', password = '$hash_password', phone = '$user_phone', address = '$user_address' 
                WHERE user_id = $user_id";

        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script type='text/javascript'>";
            echo "alert('แก้ไขสมาชิกเรียบร้อยแล้ว');";
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