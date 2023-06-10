<header>
      <div id="head-link">
            <?php 
              require_once './req/header.php'; 
              #require_once 'Login.php';
              #session_start();
            ?>
      </div>
</header>
<section class="content">
    <?php require_once './req/banner.php'; ?>
</section>
    <div class="container-fluid">
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
        <div class="container">
          <?php require_once 'sp_noibac.php'; ?>
        </div>
</div>
<footer>
    <?php require_once './req/footer.php'; ?>
</footer>
