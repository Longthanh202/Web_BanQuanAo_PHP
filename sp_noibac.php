<?php
require_once './controller/Home.php'; ?>
<style>
    .card {
        margin: 20px;
    }
</style>
<h3>Sản phẩm nổi bậc</h3>
<div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
    <?php
    $sql = "SELECT * FROM sanpham ORDER BY Masanpham DESC LIMIT 12;";
    $stmt = TruyVan($sql);
    foreach ($stmt as $row) { 
        $id = $row['MaSanPham'];
        $iddm = $row['MaDanhMuc'];
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
