<?php
    require_once './controller_admin/controller.php';
    $getID = $_GET['Id'];
        $sql = "Delete from binhluan where Id = '$getID'";
        $kq = Delete($sql);
        if($kq){
            echo "<script>alert('Xóa thành công!'); window.location='binhluan.php'</script>";
        }
        else{
            echo "<script>alert('Xóa thất bại!'); window.location='binhluan.php'</script>";
        }
?>