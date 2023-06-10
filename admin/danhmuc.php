
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
    <button class = "btn btn-success"><a href="form_add_danhmuc.php">Add Category</a></button> <br/><br/>
    <form class="d-flex" method="post">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name = "search">
        <button class="btn btn-outline-success" type="submit" name = "btntimkiem">Search</button>
    </form>
        <table class = "table table-bordered ">
            <thead class = "table-dark">
                <tr>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php
             if(isset($_POST['btntimkiem'])){
                $timkiem = $_POST['search'];
                $sql = "select * from danhmucsanpham where TenDanhMuc like '%".$timkiem."%'";
            }else{
                $sql = "select * from danhmucsanpham";
            }
            $sta = TruyVan($sql);
            foreach ($sta as $row) { 
                $id = $row['MaDanhMuc'];?>
                <tr>
                    <td><?php echo $row['MaDanhMuc'];?></td>
                    <td><?php echo $row['TenDanhMuc'];?></td>
                    <td><img src="<?php echo$row['HinhAnh'].'"'?> alt="" style = "width:100px; height:100px"></td>
                    <td>
                        <a href="form_edit_danhmuc.php<?php echo'?MaDanhMuc='.$id;?>" class = "btn btn-info">Update</a>
                        <a onclick="return confirm('Bạn có muốn xóa danh mục này không?');" href="delete_danhmuc.php<?php echo'?MaDanhMuc='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    </div>
</div>
