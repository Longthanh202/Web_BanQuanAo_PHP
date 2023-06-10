<header>
      <div id="head-link">
            <?php
            require_once './req/header.php';
            require_once './controller/Home.php';
            ?>
            
      </div>
</header>
<style>
    h3{
        font-family: "Times New Roman", Times, serif;
        font-weight: bold;
        border-bottom: 1px solid black;
    }
</style>
<?php 
    // $sql = '';
    // $sort = isset($_GET['sort']) ? $_GET['sort'] : "";
    if(isset($_POST['btntimkiem'])){
        $timkiem = $_POST['timkiem'];
        $sql = "select * from sanpham where TenSanPham like '%".$timkiem."%'";
    }else{
        $sql = "select * from sanpham";
    }
?>
<div class = "container">
    <h3>Tất cả sản phẩm</h3>
    <!-- <select class="form-select" style = "width:200px" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <option value = ''>Sắp xếp giá</option>
        <option value="?sort=desc">Cao đến thấp</option>
        <option value="?sort=asc">Thấp đến cao</option>
    </select> <br/> -->

    <div class = "row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
        <?php
        //$sql = "select * from sanpham";
        global $conn;
        $sta = $conn->prepare($sql);
        $sta->execute();
        if ($sta->rowCount() > 0) {
            $kq = $sta->fetchAll(PDO::FETCH_ASSOC);
        }
        $total_records = $sta->rowCount();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 8;
        $total_page = ceil((int) $total_records / (int) $limit);

        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } elseif ($current_page < 1) {
            $current_page = 1;
        }

        // Tìm Start
        $start = ($current_page - 1) * $limit;

        // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
        $sql2 = $sql . " LIMIT $start,$limit;";
        $result = TruyVan($sql2);

        foreach ($result as $row) { 
            $id = $row['MaSanPham'];
            ?>
            <div class="col">
                <div class="card" style="height: 500px;">
                    <img src = "./img/<?php echo$row['HinhAnh1'].'"'?>
                    class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="chitietsanpham.php<?php echo'?MaSanPham='.$id;?>"><?php echo $row['TenSanPham']?></a>
                        </h5>
                        <p class="card-text"><?php echo $row['GiaBan']?></p>
                    </div>
                </div>
            </div>
       <?php } ?>
    </div>
</div>
<div class = "container" style = "padding-top:10px">
<div class = "row">
            <div class = "col-sm-5"></div>
            <div class = "col-sm-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($current_page > 1 && $total_page > 1) {
                            echo '<li class="page-item">
                                    <a class="page-link" href="Allsanpham.php?page=' .
                                ($current_page - 1) .
                                '" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>';
                        } ?>
                        <?php for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<li class="page-item active"><a class="page-link" href="">' . $i . '</a></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link" href="Allsanpham.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                        } ?>
                        <?php if ($current_page < $total_page && $total_page > 1) {
                            echo '<li class="page-item">
                                    <a class="page-link" href="Allsanpham.php?page=' .
                                ($current_page + 1) .
                                '" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>';
                        } ?>
                    </ul>
                </nav>
            </div>
        </div>
</div>
<footer>
    <?php require_once './req/footer.php'; ?>
</footer>
