
<?php require_once './controller_admin/controller.php'; ?>
<link rel="stylesheet" href="./css_admin/danhmuc.css">
<link rel="stylesheet" href="./css_admin/css_admin.css">
<?php
    require_once 'req_admin/header_admin.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
       <?php require_once './req_admin/left_admin.php'; ?>
    </div>
    <div class="col-sm-10">
        <table class = "table table-bordered ">
            <thead class = "table-dark">
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php
            $sql = "select * from taikhoan where loaitaikhoan = 0";
            $stmt = TruyVan($sql);
            foreach ($stmt as $row) {?>
                <tr>
                    <td><?php echo $row['HoTen']?></td>
                    <td><?php echo $row['Email']?></td>
                    <td><?php echo $row['DiaChi']?></td>
                    <td><?php echo $row['DienThoai']?></td>
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa tài khoản này không?');" href="delete_danhmuc.php<?php echo'?MaDanhMuc='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    </div>
</div>
