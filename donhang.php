<?php
session_start();
require_once './controller/Home.php';
require_once './lib/db.php';

//require_once 'req/header.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
        <title>Document</title>
    </head>
    <div class="container">
        <br />
        <a href="index.php" class="btn btn-primary" style="width: 200px;">Quay lại trang chủ</a><br />
        <br />
        <select class="form-select" style="width: 200px;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="">Đơn hàng</option>
            <option value="?TrangThai=0">Chưa xác nhận</option>
            <option value="?TrangThai=1">Xác nhận</option>
            <option value="?TrangThai=2">Đang giao</option>
            <option value="?TrangThai=3">Đã giao</option>
            <option value="?TrangThai=4">Đã hủy</option>
        </select>
        <br />

        <?php
            $trangthai = '';
            $mattaikhoan = $_SESSION['mataikhoan'];
            if (isset($_GET['TrangThai']) && $_GET['TrangThai'] == 1) {
                $trangthai = $_GET['TrangThai'];
                $sql = "select * from hoadon where mataikhoan = '$mattaikhoan' and TrangThai = '$trangthai'";
                $stmt = TruyVan($sql);
                if ($stmt != '') {
                    foreach ($stmt as $row) { ?>
                        <div class="container bg-light" style="border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Mã hóa đơn: </span>
                                        <?php echo $row['MaHoaDon']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Tên người nhận: </span>
                                        <?php echo $row['TenNguoiNhan']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Ngày mua: </span>
                                        <?php echo $row['NgayLap']; ?>
                                    </p>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Địa chỉ: </span>
                                        <?php echo $row['DiaChi']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Số điện thoại: </span>
                                        <?php echo $row['SDT']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Thanh toán: </span> <span style="color: red; font-weight: bold;"><?php echo $row['ThanhTien']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <hr />
                            <table class="table">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình Ảnh</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php
                                $mahd = $row['MaHoaDon'];
                                $sql1 = "SELECT * from chitiethoadon, sanpham WHERE chitiethoadon.MaSP = sanpham.MaSanPham and MaHD = '$mahd'";
                                $stmt1 = TruyVan($sql1);
                                if ($stmt1 != '') {
                                    foreach ($stmt1 as $r) { ?>
                                <tr>
                                    <td><?php echo $r['TenSanPham']; ?></td>
                                    <td><img src="./img/<?php echo $r['HinhAnh1']; ?>" style="width: 100px; height: 100px;" /></td>
                                    <td><?php echo $r['GiaBan']; ?></td>
                                    <td><?php echo $r['SoLuong']; ?></td>
                                    <td><?php echo $r['GiaBan'] * $r['SoLuong']; ?></td>
                                </tr>
                                <?php }
                                }
                                ?>
                            </table>
                            <a href="huydonhang.php?mahd<?php echo$mahd?>" class = "btn btn-danger">Hủy đơn hàng</a> <br/><br/>
                        </div><br /><br />
            <?php } 
                }else{
                    echo "<script>alert('Chưa có đơn hàng nào!'); window.location='donhang.php'</script>";
                }
            }


            else if (isset($_GET['TrangThai']) && $_GET['TrangThai'] == 0) {
                $trangthai = $_GET['TrangThai'];
                $sql = "select * from hoadon where mataikhoan = '$mattaikhoan' and TrangThai = '$trangthai'";
                $stmt = TruyVan($sql);
                if ($stmt != '') {
                    foreach ($stmt as $row) { ?>
                        <div class="container bg-light" style="border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Mã hóa đơn: </span>
                                        <?php echo $row['MaHoaDon']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Tên người nhận: </span>
                                        <?php echo $row['TenNguoiNhan']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Ngày mua: </span>
                                        <?php echo $row['NgayLap']; ?>
                                    </p>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Địa chỉ: </span>
                                        <?php echo $row['DiaChi']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Số điện thoại: </span>
                                        <?php echo $row['SDT']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Thanh toán: </span> <span style="color: red; font-weight: bold;"><?php echo $row['ThanhTien']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <hr />
                            <table class="table">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình Ảnh</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php
                                $mahd = $row['MaHoaDon'];
                                $sql1 = "SELECT * from chitiethoadon, sanpham WHERE chitiethoadon.MaSP = sanpham.MaSanPham and MaHD = '$mahd'";
                                $stmt1 = TruyVan($sql1);
                                if ($stmt1 != '') {
                                    foreach ($stmt1 as $r) { ?>
                                <tr>
                                    <td><?php echo $r['TenSanPham']; ?></td>
                                    <td><img src="./img/<?php echo $r['HinhAnh1']; ?>" style="width: 100px; height: 100px;" /></td>
                                    <td><?php echo $r['GiaBan']; ?></td>
                                    <td><?php echo $r['SoLuong']; ?></td>
                                    <td><?php echo $r['GiaBan'] * $r['SoLuong']; ?></td>
                                </tr>
                                <?php }
                                }
                                ?>
                            </table>
                            <a href="huydonhang.php?mahd=<?php echo$mahd?>" class = "btn btn-danger">Hủy đơn hàng</a> <br/><br/>
                        </div><br /><br />
            <?php } 
                }else{
                    echo "<script>alert('Chưa có đơn hàng nào!'); window.location='donhang.php'</script>";
                }
            }
            else {
                if(isset($_GET['TrangThai'])){
                $trangthai = $_GET['TrangThai'];
                $sql = "select * from hoadon where mataikhoan = '$mattaikhoan' and TrangThai = '$trangthai'";
                $stmt = TruyVan($sql);
                if ($stmt != '') {
                    foreach ($stmt as $row) { ?>
                        <div class="container bg-light" style="border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Mã hóa đơn: </span>
                                        <?php echo $row['MaHoaDon']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Tên người nhận: </span>
                                        <?php echo $row['TenNguoiNhan']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Ngày mua: </span>
                                        <?php echo $row['NgayLap']; ?>
                                    </p>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Địa chỉ: </span>
                                        <?php echo $row['DiaChi']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Số điện thoại: </span>
                                        <?php echo $row['SDT']; ?>
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Thanh toán: </span> <span style="color: red; font-weight: bold;"><?php echo $row['ThanhTien']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <hr />
                            <table class="table">
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình Ảnh</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php
                                $mahd = $row['MaHoaDon'];
                                $sql1 = "SELECT * from chitiethoadon, sanpham WHERE chitiethoadon.MaSP = sanpham.MaSanPham and MaHD = '$mahd'";
                                $stmt1 = TruyVan($sql1);
                                if ($stmt1 != '') {
                                    foreach ($stmt1 as $r) { ?>
                                <tr>
                                    <td><?php echo $r['TenSanPham']; ?></td>
                                    <td><img src="./img/<?php echo $r['HinhAnh1']; ?>" style="width: 100px; height: 100px;" /></td>
                                    <td><?php echo $r['GiaBan']; ?></td>
                                    <td><?php echo $r['SoLuong']; ?></td>
                                    <td><?php echo $r['GiaBan'] * $r['SoLuong']; ?></td>
                                </tr>
                                <?php }
                                }
                                ?>
                            </table>
                        </div><br /><br />
            <?php } 
                } else{
                    echo "<script>alert('Chưa có đơn hàng nào!'); window.location='donhang.php'</script>";
                }
            } }
        ?>
    </div>
</html>
