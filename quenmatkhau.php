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
<?php
    require_once './controller/Home.php';
    require_once './lib/db.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
?>
<body>
<section class="vh-100 gradient-custom">
            <div class="container py-0 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <form class="card bg-dark text-white" style="border-radius: 1rem;" method = "post" action = "">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">QUÊN MẬT KHẨU</h2>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="form12" class="form-control form-control-lg" placeholder="Username" name="username" required/>    
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required/>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="sub">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>
<?php
    if(isset($_POST['sub'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $kiemtra  = countRow("select * from taikhoan where HoTen = '$username' and email = '$email'");
        if($kiemtra > 0){
            $sql = "select * from taikhoan where HoTen = '$username' and email = '$email'";
            $sta = TruyVan($sql);
            foreach($sta as $row){ 
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
                    $mail->Subject = "Mật khẩu";
                    $mail->Body    = "Mật khẩu của bạn là: ".$row['MatKhau'];

                    $mail->send();
                    echo "<script>alert('Mật khẩu đã được gửi đến email của bạn!'); window.location='Login.php'</script>";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        else{
            echo "<script>alert('Username hoặc email không đúng!'); window.location='quenmatkhau.php'</script>";
        }
    }
?>