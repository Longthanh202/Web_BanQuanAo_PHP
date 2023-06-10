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
?>
<body>
<section class="vh-100 gradient-custom">
            <div class="container py-0 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <form class="card bg-dark text-white" style="border-radius: 1rem;" method = "post" action = "">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">ĐỔI MẬT KHẨU</h2>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="form12" class="form-control form-control-lg" placeholder="Username" name="username" required/>    
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password" name="password" required/>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password mới" name="passwordnew1" required/>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Nhập lại password mới" name="passwordnew2" required/>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="sub">Save</button>
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
        $pass = $_POST['password'];
        $passnew1 = $_POST['passwordnew1'];
        $passnew2 = $_POST['passwordnew2'];
        if($passnew1 != $passnew2){
            echo "<script>alert('Xác nhận mật khẩu mới không đúng!'); window.location='doimatkhau.php'</script>";
        }else{
            $kiemtra  = countRow("select * from taikhoan where HoTen = '$username' and matkhau = '$pass'");
            if($kiemtra > 0){
                $sql = "update taikhoan set matkhau = '$passnew1'where HoTen = '$username'";
                $kq = Update($sql);
                if($kq){
                    echo "<script>alert('Đổi mật khẩu thành công!'); window.location='index.php'</script>";
                }
                else{
                    echo "<script>alert('Đổi mật khẩu thất bại!'); window.location='doimatkhau.php'</script>";
                }
            }
            else{
                echo "<script>alert('Username hoặc Password không đúng!'); window.location='doimatkhau.php'</script>";
            }
        }
    }
?>