<?php
    require_once './controller_admin/controller.php';
    $getID = $_REQUEST['MaSanPham'];
    $sql = "Delete from sanpham where MaSanPham = '$getID'";
    $kq = Delete($sql);
    if($kq){
        echo "<script>alert('Xóa thành công!'); window.location='sanpham.php'</script>";
    }
    else{
        echo "<script>alert('Xóa thất bại!'); window.location='sanpham.php'</script>";
    }
?>