
<?php
    require_once './controller/Home.php';
global $pdo;
if (isset($_POST['sub'])) {
    $ma = null;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $diachi = $_POST['address'];
    $sdt = $_POST['phone'];
    $tenhienthi = $_POST['tenhienthi'];
    $loai = 0;

    // $sql = "select * from TaiKhoan where HoTen = '" . $username . "'";
    // $sta = $pdo->query($sql);
    // //$sta->excute();
    // if ($sta->rowCount() != 0) {
    //     echo '<script language="javascript">alert("Bị trùng tên!");</script>';
    // } else {
        $sql = "insert into TaiKhoan values ('$ma','$username','$email','$password', '$diachi', '$sdt', '$loai', '$tenhienthi')";
        $kq = Insert($sql);
        if($kq){
            echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="Login.php";</script>';
        }
        //$sta->excute();
    //}
}
?>
<header>
      <div id="head-link">
            <?php require_once './req/header.php'; ?>
      </div>
</header>
<?php
     if(isset($_POST['sub'])){
        $err =[];
        if(empty(trim($_POST['username']))){
          $err['username']['required'] = 'Username không được để trống';
        }

        if(empty(trim($_POST['tenhienthi']))){
            $err['tenhienthi']['required'] = 'Tên hiển thị không được để trống';
          }
  
        if(empty(trim($_POST['password']))){
          $err['password']['required'] = 'Password không được để trống';
        }

        if(empty(trim($_POST['email']))){
            $err['email']['required'] = 'Email không được để trống';
        }
        else if(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
            $err['email']['invaild'] = 'Email không hợp lệ';
        }

        if(empty(trim($_POST['address']))){
            $err['address']['required'] = 'Address không được để trống';
        }

        if(empty(trim($_POST['phone']))){
            $err['phone']['required'] = 'Phone không được để trống';
        }
    }
?>
    <body>
        <section class="gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <form class="card bg-dark text-white" style="border-radius: 1rem;" method = "post" action = "">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="form12" class="form-control form-control-lg" placeholder="Username" name = "username" required/>
                                        <?php 
                                            if(!empty($err['username']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['username']['required'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="form12" class="form-control form-control-lg" placeholder="Tên hiển thị" name = "tenhienthi" required/>
                                        <?php 
                                            if(!empty($err['tenhienthi']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['tenhienthi']['required'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Password" name = "password" required/>
                                        <?php 
                                            if(!empty($err['password']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['password']['required'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typePasswordX" class="form-control form-control-lg" placeholder="Email" name = "email" required/>
                                        <?php 
                                            if(!empty($err['email']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['email']['required'].'</span>';
                                            }

                                            if(!empty($err['email']['invaild'])){
                                                echo '<span style = "color:red">'
                                                .$err['email']['invaild'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typePasswordX" class="form-control form-control-lg" placeholder="Address" name = "address" required/>
                                        <?php
                                            if(!empty($err['address']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['address']['required'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="number" id="typePasswordX" class="form-control form-control-lg" placeholder="Phone" name = "phone" required/>
                                        <?php
                                            if(!empty($err['phone']['required'])){
                                                echo '<span style = "color:red">'
                                                .$err['phone']['required'].'</span>';
                                            }
                                        ?>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name = "sub">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>