<?php
    session_start();
    require_once './controller/Home.php';
    require_once './lib/db.php';
?>  
<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }
    //Xóa một sản phẩm khỏi giỏ hàng
    if(isset($_GET['deleteid']) && ($_GET['deleteid'] >= 0))
    {
        array_splice($_SESSION['mycart'], $_GET['deleteid'], 1);
    }
    //xóa all sản phẩm khỏi giỏ hàng
    if(isset($_GET['deleteall']) && ($_GET['deleteall'] == 1))
    {
        unset($_SESSION['mycart']);
    }
    if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];
    if(isset($_POST['sub']) && $_POST['sub'])
    {
        $id = $_POST['ma'];
        $ten = $_POST['ten'];
        $gia = $_POST['gia'];
        $hinh = $_POST['hinh'];
        $size = $_POST['size'];
        $sl = $_POST['soluong'];
        $fl = 0;
        for ($i=0; $i < sizeof($_SESSION['mycart']); $i++) { 
            if($_SESSION['mycart'][$i][0] == $id && $_SESSION['mycart'][$i][4] == $size)
            {
                $fl = 1;
                $slnew = $sl + $_SESSION['mycart'][$i][5];
                $_SESSION['mycart'][$i][5] = $slnew;
            }
        }
        if($fl == 0){
            $add = [$id, $ten, $gia, $hinh, $size, $sl];
            $_SESSION['mycart'][] = $add;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../fontawesome/css/all.min.css" />
        <title>Document</title>
    </head>
    <body>
    <div class = "container">
            <h1>Giỏ hàng</h1>
            <table class="table table-bordered">
                <tr class = "table-dark">
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Hình ảnh</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </tr>
                <?php
                    $tong = 0;
                    if(isset($_SESSION['mycart']) && (is_array($_SESSION['mycart'])))
                    {
                        $thanhtoan = 0;
                        for ($i=0; $i < sizeof($_SESSION['mycart']); $i++)
                        { 
                            $tt = (float)$_SESSION['mycart'][$i][2] * $_SESSION['mycart'][$i][5];
                            $thanhtoan += $tt;
                            //$thanhtoan += $tong;
                            ?>
                            <tr>
                                <td><?php echo ($i + 1) ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][1] ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][2] ?></td>
                                <td><img src = "./img/<?php echo$_SESSION['mycart'][$i][3]?>" style = "width:100px; height:100px"/></td>
                                <td><?php echo $_SESSION['mycart'][$i][4] ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][5] ?></td>
                                <td><?php echo $tt ?></td>
                                <td>
                                    <a href="cart.php?deleteid=<?php echo$i?>" class = "btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                    <?php }
                    }
                ?>
                <tr>
                    <td>Tổng thành tiền</td>
                    <td colspan = "7" style = "color:red; font-weight: bold"><?php echo $thanhtoan ?> VND</td>
                </tr>
            </table>
            <a href="index.php" class = "btn btn-primary">Quay lại trang chủ</a>
            <a href="cart.php?deleteall=1" class = "btn btn-danger">Xóa giỏ hàng</a>
        <div class="row mt-5">
        <form action="thanhtoan.php" method = "post">
            <div class="row">
                <?php
                    if(isset($_SESSION['mataikhoan'])){
                    $mattaikhoan = $_SESSION['mataikhoan'];
                    $sql = "select * from taikhoan where id = $mattaikhoan";
                    $stmt = TruyVan($sql);
                    if($stmt != ''){ 
                        foreach($stmt as $row) {?>
                        <div class="col-md-8">
                            <h3 style = "text-align:center">Thông tin nhận hàng</h3>
                            <div class = "mb-3">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Tên người nhận" required  name = "ten" value = "<?php echo $row['TenHienThi']?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Địa chỉ nhận hàng" required name = "diachi" value = "<?php echo $row['DiaChi']?>">
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Số điện thoại" required name = "sdt" value = "<?php echo $row['DienThoai']?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email" name = "email" value = "<?php echo $row['Email']?>">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ghi chú" name = "ghichu"></textarea>
                            </div>
                    </div>
                    <?php }
                    }
                } ?>
                <div class="col-md-4">
                    <h3>Phương thức thanh toán</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="thanhtoan" id="flexRadioDefault1" checked value = "1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Thanh toán khi nhận hàng
                        </label>
                        </div>
                        <div class="form-check">
                        <!-- <input class="form-check-input" type="radio" name="thanhtoan" id="flexRadioDefault2" value = "2"> -->
                        <!-- <label class="form-check-label" for="flexRadioDefault2">
                            Thanh toán MOMO
                        </label> -->
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button class = "btn btn-success" name = "dathang" type = "submit">Đặt hàng</button>
            </div>
        </form>
        </div>
    </div>
</body>