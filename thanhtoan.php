<?php
    session_start();
    require_once './controller/Home.php';
    require_once './lib/db.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

?>
<?php
    function ThanhTien(){
        $thanhtoan = 0;
        if(isset($_SESSION['mycart']) && (is_array($_SESSION['mycart'])))
        {
            
            for ($i=0; $i < sizeof($_SESSION['mycart']); $i++)
            { 
                $tt = (float)$_SESSION['mycart'][$i][2] * $_SESSION['mycart'][$i][5];
                $thanhtoan += $tt;
            }
        }
        return $thanhtoan;
    }
    $maxhd = $ten = $ngaylap = $sdt = $diachi = '';
    if(isset($_POST['dathang']) && $_SESSION['mycart'] != null && isset($_SESSION['mycart']))
    {   
        if (isset($_SESSION['user']) && $_SESSION['user'] == null) {    
            echo "<script>alert('Vui lòng đăng nhập để mua hàng!'); window.location='Login.php'</script>"; 
        }
        else{
            $mahd = null;
            $ngaylap = date('Y-m-d');
            $ten = $_POST['ten'];
            $trangthai = 0;
            $sdt = $_POST['sdt'];
            $diachi = $_POST['diachi'];
            $email = $_POST['email'];
            $ghichu = $_POST['ghichu'];
            $pttt = $_POST['thanhtoan'];
            $thanhtien = ThanhTien();
            $idtk = $_SESSION['mataikhoan'];


            $sql = "insert into hoadon values('$mahd', '$ngaylap', '$ten', '$trangthai', '$sdt', '$diachi', '$email', '$ghichu', '$thanhtien', '$pttt', '$idtk')";
            Insert($sql);

        #$sql1 = "select max(MaHoaDon) from HoaDon";
            $maxhd = maxHoaDon();
            for ($i=0; $i < sizeof($_SESSION['mycart']); $i++) { 
                $masp = $_SESSION['mycart'][$i][0];
                $size = $_SESSION['mycart'][$i][4];
                $sl = $_SESSION['mycart'][$i][5];

                $sql2 = "insert into chitiethoadon values('$maxhd', '$masp', '$size', '$sl')";
                Insert($sql2);
            }

            $mail = new PHPMailer(true);

            try {
                //Server settings                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'thanhlongle978@gmail.com';                     //SMTP username
                $mail->Password   = 'wkddkjnziywyppqz';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;
                $mail->CharSet    = "utf-8";                                                             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('thanhlongle978@gmail.com', 'Long');
                $mail->addAddress($email, 'Long Le');     //Add a recipient
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Xác nhận đặt hàng";
                $mail->Body    = 
                '<div class="container bg-light" style="border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Mã hóa đơn: </span>
                                        '.$maxhd.'
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Tên người nhận: </span>
                                        '.$ten.'
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Ngày mua: </span>
                                        '.$ngaylap.'
                                    </p>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <p>
                                        <span style="font-weight: bold;">Địa chỉ: </span>
                                        '.$diachi.'
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Số điện thoại: </span>
                                        '.$sdt.'
                                    </p>
                                    <p>
                                        <span style="font-weight: bold;">Thanh toán: </span> <span style="color: red; font-weight: bold;">'.$thanhtien.'</span>
                                    </p>
                                </div>
                            </div>';

               $mail->send();
                // echo "<script>alert('Gửi email thành công!'); window.location='send.php'</script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h4>Mã đơn hàng: <?php echo $maxhd ?></h4>
        <table class = "table table-bordered">
            <tr>
                <td>Tên người nhận</td>
                <td><?php echo $ten ?></td>
            </tr>
            <tr>
                <td>Ngày đặt hàng</td>
                <td><?php echo $ngaylap ?></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><?php echo $sdt ?></td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><?php echo $diachi ?></td>
            </tr>
        </table>
        <table class="table table-bordered">
                <tr class = "table-dark">
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Hình ảnh</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                    $tong = 0;
                    if(isset($_SESSION['mycart']) && (is_array($_SESSION['mycart'])))
                    {
                        $thanhtoan = 0;
                        for ($i=0; $i < sizeof($_SESSION['mycart']); $i++)
                        { 
                            $tt = (float)$_SESSION['mycart'][$i][2] * $_SESSION['mycart'][$i][5];
                            $tong += $tt;
                            $thanhtoan += $tong;
                            ?>
                            <tr>
                                <td><?php echo ($i + 1) ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][1] ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][2] ?></td>
                                <td><img src = "./img/<?php echo$_SESSION['mycart'][$i][3]?>" style = "width:100px; height:100px"/></td>
                                <td><?php echo $_SESSION['mycart'][$i][4] ?></td>
                                <td><?php echo $_SESSION['mycart'][$i][5] ?></td>
                                <td><?php echo $tong ?></td>
                            </tr>
                    <?php }
                    }
                ?>
                <tr>
                    <td>Tổng thành tiền</td>
                    <td colspan = "7" style = "color:red; font-weight: bold"><?php echo $thanhtoan ?> VND</td>
                </tr>
            </table>
            <?php
                unset($_SESSION['mycart']);
            ?>
            <a href="index.php" class = "btn btn-primary">Quay lại trang chủ</a> <br/><br/>
    </div>
</body>
</html>