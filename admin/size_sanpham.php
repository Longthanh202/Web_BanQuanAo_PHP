
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
        <button class = "btn btn-success"><a href="form_add_sps.php">Add Sản Phẩm - Size</a></button>
        <table class = "table table-bordered ">
            <thead class = "table-dark">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php
                $sql = "select * from sanpham, size, sanpham_size WHERE sanpham.MaSanPham = sanpham_size.masp and size.MaSize = sanpham_size.masize";
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
                    $id = $row['masp'];
                    $id1 = $row['masize'];
                    ?>
                    <tr>
                        <td><?php echo $row['TenSanPham']?></td>
                        <td><?php echo $row['Size']?></td>
                        <td>
                            <a onclick="return confirm('Bạn có muốn xóa hóa đơn này không?');" href="delete_sps.php<?php echo'?masp='.$id.'&masize='.$id1; ?>" data-toggle="modal" data-target="#" class = "btn btn-danger">Delete</a>
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
                                    <a class="page-link" href="size_sanpham.php?page='.($current_page-1).'" aria-label="Previous">
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
                                    echo '<li class="page-item"><a class="page-link" href="size_sanpham.php?page='.$i.'">'.$i.'</a></li>';
                                }
                            }
                        ?>
                        <?php
                             if ($current_page < $total_page && $total_page > 1){
                                echo '<li class="page-item">
                                    <a class="page-link" href="size_sanpham.php?page='.($current_page+1).'" aria-label="Next">
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