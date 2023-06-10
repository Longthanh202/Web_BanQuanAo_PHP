<?php
    require_once './controller_admin/controller.php';
    if(isset($_POST['edit'])){
        $getID = $_GET['MaDanhMuc'];
        $tendanhmuc = $_POST['tendanhmuc'];
        $file = $_FILES['image'];
        $filename = $file['name'];
        move_uploaded_file($file['tmp_name'], '../img/'.$filename);
        $sql = "update danhmucsanpham set TenDanhMuc = '$tendanhmuc', HinhAnh = '$filename' where MaDanhMuc = '$getID'";
        $kq = Update($sql);
        if($kq){
            echo "<script>alert('Update thành công!'); window.location='danhmuc.php'</script>";
        }
    }
?>