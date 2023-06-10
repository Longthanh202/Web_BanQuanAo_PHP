<?php
    #session_start();
    require_once './controller/Home.php';
    require_once './lib/db.php';
?>
<header>
      <div id="head-link">
            <?php require_once './req/header.php'; ?>
      </div>
</header>
<div class = "container">
    <h4>THÔNG TIN TÀI KHOẢN CỦA BẠN</h4>
    <table class = "table table-bordered ">
        <tr>
            <th>id</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
        </tr>
            <?php
                $id = $_SESSION['mataikhoan'];
                $sql = "select * from taikhoan where id = '$id'";
                $sta = TruyVan($sql);
                foreach($sta as $row){ ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['HoTen'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['DiaChi'] ?></td>
                        <td><?php echo $row['DienThoai'] ?></td>
                    </tr>
               <?php } ?>
    </table>

    <a href="./doimatkhau.php" class = "btn btn-info">Đổi mật khẩu</a>
    <a href="./donhang.php" class = "btn btn-success">Xem đơn hàng</a>
    <a href="./logout.php" class = "btn btn-danger">Đăng xuất</a>
</div>