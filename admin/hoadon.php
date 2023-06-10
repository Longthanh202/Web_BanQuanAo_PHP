
<?php 
    require_once './controller_admin/controller.php'; 
    require_once '../lib/db.php';
?>
<link rel="stylesheet" href="./css_admin/sanpham.css">
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
        <!-- <select class="form-select" style = "width:150px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value = ''>--Lọc--</option>
            <option value="hoadon.php?tt=1">Xác nhận</option>
            <option value="hoadon.php?tt=2">Đang giao</option>
            <option value="hoadon.php?tt=3">Đã giao</option>
            <option value="hoadon.php?tt=4">Đã hủy</option>
        </select> -->
        <table class = "table table-bordered ">
            <thead class = "table-dark">
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Ngày lập</th>
                    <th>Tên người nhận</th>
                    <th>Trạng thái</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                    <th>Cập nhật</th>
                </tr>
            </thead>
            <?php
                //$tt = $_GET['tt'];
                $sql = "select * from hoadon";
                global $conn;
                $sta = $conn->prepare($sql);
                $sta->execute();
                if($sta->rowCount() > 0){
                    $kq = $sta->fetchAll(PDO:: FETCH_ASSOC);
                }
                $total_records = $sta->rowCount();
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 4;
                $total_page = ceil((int)$total_records / (int)$limit);
 
                // Giới hạn current_page trong khoảng 1 đến total_page
                if ($current_page > $total_page){
                $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
 
                // Tìm Start
                $start = ($current_page - 1) * $limit;
 
                // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
                $sql2 = $sql . " LIMIT $start,$limit;";
                $result = TruyVan($sql2);
                $id = '';
                foreach ($result as $row) { 
                    $id = $row['MaHoaDon'];?>
                    <tr>
                        <td><?php echo $row['MaHoaDon']?></td>
                        <td><?php echo $row['NgayLap']?></td>
                        <td><?php echo $row['TenNguoiNhan']?></td>
                        <?php 
                            if($row['TrangThai'] == 1)
                                {?>
                                    <td><?php echo 'Xác nhận'?></td>
                            <?php } else if($row['TrangThai'] == 2)
                                { ?>
                                <td><?php echo 'Đang giao'?></td>
                            <?php } else if($row['TrangThai'] == 3)
                                { ?>
                                <td><?php echo 'Đã giao'?></td>
                            <?php } else if($row['TrangThai'] == 0)
                                { ?>
                                <td><?php echo 'Chưa xác nhận'?></td>
                            <?php } else if($row['TrangThai'] == 4){ ?>
                                <td><?php echo 'Đã hủy'?></td>
                            <?php } ?>
                        <td><?php echo $row['SDT']?></td>
                        <td><?php echo $row['DiaChi']?></td>
                        <td><?php echo $row['ThanhTien']?></td>
                        <td>
                            <a onclick="return confirm('Bạn có muốn xóa hóa đơn này không?');" href="delete_sanpham.php<?php echo'?MaSanPham='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
                        </td>
                        <td>
                            <select class="form-select" style = "width:150px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                <option value = ''>Cập nhật</option>
                                <option value="hoadon.php?capnhat=1&id=<?php echo$id?>">Xác nhận</option>
                                <option value="hoadon.php?capnhat=2&id=<?php echo$id?>">Đang giao</option>
                                <option value="hoadon.php?capnhat=3&id=<?php echo$id?>">Đã giao</option>
                                <option value="hoadon.php?capnhat=4&id=<?php echo$id?>">Đã hủy</option>
                            </select>
                        </td>
                    </tr> 
            <?php } ?>
        </table>
        <div class = "row">
            <div class = "col-sm-4"></div>
            <div class = "col-sm-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                             if($current_page > 1 && $total_page > 1){
                                 echo '<li class="page-item">
                                    <a class="page-link" href="hoadon.php?page='.($current_page-1).'" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>';
                             } ?>
                        <?php
                            for ($i = 1; $i <= $total_page; $i++){
                                if ($i == $current_page){ 
                                    echo '<li class="page-item active"><a class="page-link" href="">'.$i.'</a></li>';
                                }
                                else{
                                    echo '<li class="page-item"><a class="page-link" href="hoadon.php?page='.$i.'">'.$i.'</a></li>';
                                }
                            }
                        ?>
                        <?php
                             if ($current_page < $total_page && $total_page > 1){
                                echo '<li class="page-item">
                                    <a class="page-link" href="hoadon.php?page='.($current_page+1).'" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
  </div>
</div>
<?php
    if(isset($_GET['capnhat'])){
        $trangthai = $_GET['capnhat'];
        $ma = $_GET['id'];
        $sql1 = "Update hoadon set TrangThai = '$trangthai' where MaHoaDon = '$ma'";
        $kq = Update($sql1);
        if($kq){
            echo "<script>alert('Cập nhật thành công!'); window.location='hoadon.php'</script>";
        }
        else{
            echo "<script>alert('Cập nhật thất bại!'); window.location='hoadon.php'</script>";
        }
    }
?>
