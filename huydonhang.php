<?php
    require_once './controller/Home.php';
    $getID = $_GET['mahd'];
    $sql = "Update hoadon set TrangThai = 4 where MaHoaDon = '$getID'";
    $kq = Update($sql);
    if($kq){
        echo "<script>alert('Hủy đơn hàng thành công!'); window.location='donhang.php'</script>";
    }
    else{
        echo "<script>alert('Hủy đơn hàng thất bại!'); window.location='donhang.php'</script>";
    }
?>