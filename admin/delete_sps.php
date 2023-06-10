<?php
    require_once './controller_admin/controller.php';
        $getsp = $_GET['masp'];
        $getsize = $_GET['masize'];
        $sql = "Delete from sanpham_size where masp = '$getsp' and masize = '$getsize'";
        $kq = Delete($sql);
        if($kq){
            echo "<script>alert('Xóa thành công!'); window.location='size_sanpham.php'</script>";
        }
        else{
            echo "<script>alert('Xóa thất bại!'); window.location='size_sanpham.php'</script>";
        }
?>