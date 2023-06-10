<?php
    session_start();
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
    <?php require_once './controller/Home.php'; ?>
    <style>
        ul li .timkiem {
            margin-left: 100px;
            border: none;
            border-radius: 0px;
            border-bottom: 2px solid black;
            width: 250px;
        }
        .btntimkiem {
            border: none;
            background-color: white;
            margin-left: 10px;
        }
        .litimkiem {
            margin-left: 5px;
        }
        .lidangky {
            margin-left: 270px;
        }
        .cart a i {
            font-size: 20px;
            margin-left: 30px;
        }
        .nav-item a {
            font-weight: bold;
        }
        .carousel-item img {
            height: 800px;
        }
        .user {
            margin-left: 80px;
        }
        .user a {
            font-weight: bold;
        }
        .dangxuat {
            margin-left: 300px;
        }
        .dangxuat a i{
            font-size: 20px;
        }
        .btntimkiem {
            position: relative;
            left: 350px;
            top: -35px;
        }
    </style>
    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./index.php">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./AllSanPham.php">PRODUCT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="lienhe.php">CONTACT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./index.php">INTRODUCE</a>
                            </li>
                            <li class="nav-item">
                                <form action="AllSanPham.php" method="post">
                                    <input type="text" class="timkiem form-control" placeholder="Tìm kiếm" name="timkiem" />
                                    <button class="btntimkiem btn btn-outline-secondary" name="btntimkiem"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </li>
                            <?php //session_start();
                      if (isset($_SESSION['user']) && $_SESSION['user'] != null) { ?>
                            <li class="nav-item">

                            </li>
                            <!-- <li class="nav-item dangxuat">
                                <a class="nav-link active" aria-current="page" href="./logout.php">Đăng xuất</a>
                            </li> -->
                            <li class="nav-item dangxuat">
                                <a class="nav-link active" aria-current="page" href="./taikhoan.php"><i class="fa-solid fa-user"></i></a>
                            </li>
                            <li class="nav-item ">
                                
                            </li>
                            <?php } else { ?>

                            <li class="nav-item lidangky">
                                <a class="nav-link active" aria-current="page" href="./Register.php">Đăng ký</a>
                            </li>
                            <li class="nav-item lidangnhap">
                                <a class="nav-link active" aria-current="page" href="./Login.php">Đăng nhập</a>
                            </li>
                            <?php } ?>
                            <li class="nav-item cart">
                                <a class="nav-link active" aria-current="page" href="./cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </body>
</html>
