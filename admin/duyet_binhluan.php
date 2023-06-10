<?php
    require_once './controller_admin/controller.php';
    $getID = $_GET['Id'];
    $trangthai = 1;
    $sql = "Update binhluan set trangthai = '$trangthai' where id = '$getID'";
    $kq = Update($sql);
    if($kq){
        echo "<script>alert('Xác nhận thành công!'); window.location='binhluan.php'</script>";
    }
    else{
        echo "<script>alert('Xác nhận thất bại thất bại!'); window.location='binhluan.php'</script>";
    }
?>