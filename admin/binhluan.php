
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
                    <th>Mã bình luận</th>
                    <th>Nội dung</th>
                    <th>Ngày</th>
                    <th>Mã sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php
            $sql = "select * from binhluan";
            $sta = TruyVan($sql);
            foreach ($sta as $row) { 
                $id = $row['Id'];?>
                <tr>
                    <td><?php echo $row['Id'];?></td>
                    <td><?php echo $row['noidung'];?></td>
                    <td><?php echo $row['ngay'];?></td>
                    <td><?php echo $row['masanpham'];?></td>
                    <?php 
                        if($row['trangthai'] == 0) { ?>
                        <td>Chưa xác nhận</td>
                    <?php }else{ ?>
                        <td>Đã xác nhận</td>
                    <?php } ?>
                    <td>
                        <a onclick="return confirm('Bạn có muốn duyệt bình luận này không?');" href="duyet_binhluan.php<?php echo'?Id='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-info">Duyệt</a>
                        <a onclick="return confirm('Bạn có muốn xóa bình luận này không?');" href="delete_binhluan.php<?php echo'?Id='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    </div>
</div>
