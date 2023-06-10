<header>
      <div id="head-link">
            <?php require_once './req/header.php'; ?>
      </div>
</header>
<section class="content">
    <?php require_once './req/banner.php'; ?>
</section>
<?php
    require_once './controller/Home.php'; 
    $getID = $_REQUEST['MaDanhMuc'];
?>
<style>
    .card{
        margin:20px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
                  <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php 
                        require_once './controller/Home.php';
                        $sql = "select * from danhmucsanpham";
                        $stmt = TruyVan($sql);
                        foreach($stmt as $row){ 
                          $id = $row['MaDanhMuc'];?>
                          <li class="nav-item">
                            <a href="sptheodm.php<?php echo'?MaDanhMuc='.$id;?>" class="nav-link active" aria-current="page"><?php echo $row['TenDanhMuc'] ?></a>
                          </li>
                     <?php } ?>
                    </ul>
                  </div>
                  </div>
                </div>
        </nav>
<div class = "container">
    <div class = "row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
        <?php
        $sql = "select * from sanpham where MaDanhMuc = '$getID'";
        $stmt = TruyVan($sql);
        foreach ($stmt as $row) {
            echo '<div class = "col">
                    <div class="card" style="height: 500px">
                    <img src = "./img/' . $row['HinhAnh1'] . '" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">' . $row['TenSanPham'] . '</h5>
                    <p class="card-text">' . $row['GiaBan'] . '</p>
                    </div>
                </div>
                </div>';
        }
        ?>
    </div>
</div>
<footer>
    <?php require_once './req/footer.php'; ?>
</footer>
