<?php
    require_once './controller_admin/controller.php';
    $getID = $_REQUEST['MaDanhMuc'];
    $kiemtra  = countRow("select * from sanpham where MaDanhMuc='$getID'");
    if($kiemtra > 0){
        echo "<script>alert('Danh mục bị ràng buộc khóa ngoại không thể xóa!'); window.location='danhmuc.php'</script>";
    }
    else{
        $sql = "Delete from danhmucsanpham where MaDanhMuc = '$getID'";
        $kq = Delete($sql);
        if($kq){
            echo "<script>alert('Xóa thành công!'); window.location='danhmuc.php'</script>";
        }
        else{
            echo "<script>alert('Xóa thất bại!'); window.location='danhmuc.php'</script>";
        }
    }
?>