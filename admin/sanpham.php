
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
        <button class = "btn btn-success"><a href="form_add_sanpham.php">Add Product</a></button> <br/><br/>
        <form class="d-flex" method="post">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name = "search">
            <button class="btn btn-outline-success" type="submit" name = "btntimkiem">Search</button>
        </form>
        <!-- <select class="form-select" style = "width:200px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value = ''>Sắp xếp giá</option>
            <option value="?sort=desc">Cao đến thấp</option>
            <option value="?sort=asc">Thấp đến cao</option>
        </select> <br/> -->
        <table class = "table table-bordered ">
            <thead class = "table-dark">
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá nhập</th>
                    <th>Giá bán</th>
                    <th>Hình ảnh</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php
                if(isset($_POST['btntimkiem'])){
                    $timkiem = $_POST['search'];
                    $sql = "select * from sanpham where TenSanPham like '%".$timkiem."%'";
                }else{
                    $sql = "select * from sanpham";
                }
                //$sql = "select * from sanpham";
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
 
                foreach ($result as $row) { 
                    $id = $row['MaSanPham'];?>
                    <tr>
                        <td><?php echo $row['MaSanPham']?></td>
                        <td><?php echo $row['TenSanPham']?></td>
                        <td><?php echo $row['GiaNhap']?></td>
                        <td><?php echo $row['GiaBan']?></td>
                        <td><img src="../img/<?php echo$row['HinhAnh1'].'"'?> alt="" style = "width:100px; height:100px"></td>
                        <td>
                            <a href="form_edit_sanpham.php?id=<?php echo$id;?>" class = "btn btn-info">Update</a>
                            <a onclick="return confirm('Bạn có muốn xóa danh mục này không?');" href="delete_sanpham.php<?php echo'?MaSanPham='.$id;?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
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
                                    <a class="page-link" href="sanpham.php?page='.($current_page-1).'" aria-label="Previous">
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
                                    echo '<li class="page-item"><a class="page-link" href="sanpham.php?page='.$i.'">'.$i.'</a></li>';
                                }
                            }
                        ?>
                        <?php
                             if ($current_page < $total_page && $total_page > 1){
                                echo '<li class="page-item">
                                    <a class="page-link" href="sanpham.php?page='.($current_page+1).'" aria-label="Next">
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