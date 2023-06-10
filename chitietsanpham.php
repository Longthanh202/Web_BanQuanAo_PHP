<script src = "./js/img.js"></script>
<?php
    require_once './req/header.php';
?>
    <style>
        .img_left{
            margin-right:10px;
        }
        .img_left, .img_right{
            width: auto;
            height: auto;
        }
        .detail-product{
            margin-left:40px;
        }
        #ten{
            color: blue;
        }
        #gia{
            color: red;
        }
        ul li{
            font-weight: bold;
        }
        img{
            border-radius:10px;
        }
    </style>
<?php
    require_once './controller/Home.php';
    $getID = $_GET['MaSanPham'];
    $sql = "select * from sanpham where MaSanPham = '$getID'";
    $temp = LayMotSanPham($sql);
    foreach($temp as $row){ 
    $iddm = $row['MaDanhMuc']?>
    <body class = "bg-light">
        <div class="container">
            <form action="cart.php" method = "post" enctype = "multipart/form-data">
                <input type="hidden" name = "ma" value = "<?php echo $row['MaSanPham']?>">
                <input type="hidden" name = "ten" value = "<?php echo $row['TenSanPham']?>">
                <input type="hidden" name = "hinh" value = "<?php echo$row['HinhAnh1']?>">
                <input type="hidden" name = "gia" value = "<?php echo $row['GiaBan']?>">
                <div class="row">
                    <div class="col-md-6" style="text-align: center;">
                        <div class = "d-flex flex-column justify-content-center">
                            <div class="image">
                                <img src="./img/<?php echo$row['HinhAnh1'].'"'?>" id="main_product_image" width="350px"/>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3"></div>
                                <div class="col-md-3 img_left">
                                    <img onclick="changeImage(this)" src="./img/<?php echo$row['HinhAnh1'].'"'?>" width="80" />
                                </div>
                                <div class="col-md-3 img_right">
                                    <img onclick="changeImage(this)" src="./img/<?php echo$row['HinhAnh2'].'"'?>" width="80" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-5">
                    <div class = "detail-product">
                            <h3 id = "ten"><?php echo $row['TenSanPham']?></h3>
                            <h5 id = "gia"><?php echo $row['GiaBan']?>đ</h5></br>
                            <h5>Size </h5>
                            <select class = "form-select w-50" name = "size">
                            <?php
                                $sqlsize = "select size.masize, size from sanpham, sanpham_size, size WHERE sanpham.MaSanPham = sanpham_size.masp and size.MaSize = sanpham_size.masize and sanpham.MaSanPham = '$getID';";
                                $s = LayDanhSachSize($sqlsize);
                                foreach($s as $r){ ?>
                                    <option value = "<?php echo $r['size'];?>"><?php echo $r['size'];?></option>
                            <?php }
                            ?>
                            </select></br></br>
                            <p>Số lượng</p>
                            <input type="number" name = "soluong" value = "1" class = "form-control w-50" min = "1"> </br></br>
                            <input class="btn btn-primary" type="submit" value = "Thêm vào giỏ hàng" name = "sub"/>
                        </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-6 mt-5 w-50">
                    <h4>Các chính sách</h4>
                        <ul>
                            <li>Miễn phí trả hàng trong 3 ngày.</li>
                            <li>Sản phẩm chính hãng.</li>
                            <li>Giao hàng toàn quốc.</li>
                        </ul>
                    <h6 class = "border-top">Bình luận về sản phẩm</h6>
                    <form action="" method = "post">
                        <input type="text" name = "binhluan" style = "height: 50px; width: 300px" required>
                        <button class = "btn btn-primary" name = "send">Send</button>
                    </form>
                </div>
                <div class="col-md-6 border-top mt-5" id = "chinhsach">
                    <h4>Mô tả</h4>
                        <p><?php echo $row['MoTa']?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <h5>Bình luận mới nhất về sản phẩm</h5>
                    <ul>
                        <?php 
                            $sql3 = "select * from binhluan, taikhoan where binhluan.mataikhoan = taikhoan.Id and masanpham = '$getID' and trangthai = 1";
                            $bl = TruyVan($sql3);
                            if($bl != null){
                                foreach($bl as $row){ ?>
                                    <li style = "list-style-type: none">- <?php echo $row['noidung']?></li>
                            <?php }
                            }
                            ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    <div class ="container">
<h3>Sản phẩm liên quan</h3>
    <div class = "row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
    <?php
        $sql2 = "select * from sanpham where MaDanhMuc = '$iddm' limit 4";
        $a = TruyVan($sql2);
        foreach ($a as $row) { 
            $id = $row['MaSanPham'];
            ?>
            <div class = "col">
                    <div class="card" style="height: 500px">
                    <img src = "./img/<?php echo$row['HinhAnh1'].'"'?> class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title"><a href = "chitietsanpham.php<?php echo'?MaSanPham='.$id;?>"><?php echo $row['TenSanPham']?></a></h5>
                    <p class="card-text"><?php echo $row['GiaBan']?></p>
                    
                    </div>
                </div>
                </div>
        <?php } ?>
</div>
</div>
<?php } ?>
<?php
    require_once 'req/footer.php';
?>
<?php
    if (isset($_SESSION['user']) && $_SESSION['user'] == null) {    
        echo "<script>alert('Vui lòng đăng nhập để bình luận!'); window.location='Login.php'</script>"; 
    }
    else{
        //session_start();
        if(isset($_POST['send']) && $_SESSION["mataikhoan"] != null){
            $idbinhluan = null;
            $noidung = $_POST['binhluan'];
            $now = date('Y-m-d');
            //$currentDate = $now["mday"] . ".". $now["mon"] . ".". $now["year"];
            $idtk = $_SESSION['mataikhoan'];
            $trangthai = 0;
            $query = "insert into binhluan values('$idbinhluan', '$noidung', '$now', '$idtk', '$getID', '$trangthai')";
            $kq = Insert($query);
            if($kq){
                echo "<script>alert('Bình luận thành công!'); window.location='index.php'</script>";
            }
            else{
                echo "<script>alert('Bình luận thất bại!'); window.location='index.php'</script>";
            }
        }
    }
?>