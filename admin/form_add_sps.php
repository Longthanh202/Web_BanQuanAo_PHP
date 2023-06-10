<?php
    require_once 'req_admin/header_admin.php';
    require_once './controller_admin/controller.php';
?>
<style>
  h1{
    background: black;
    padding: 5px 0;
    height: 80px;
    line-height: 80px;
    color: white;
  }
</style>
<div class="jumbotron text-center">
  <h1>Welcome to add category page</h1>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <?php
       require_once 'req_admin/left_admin.php';
      ?>
    </div>
    <div class="col-sm-10" style = "background-color:#EEEEEE">
      <form action = "" method = "post" enctype = "multipart/form-data">
        <div class="mb-3">
            <label class="form-label fw-bold">Sản phẩm</label>
            <select class = "form-select w-50" name = "sp">
                <?php
                    $sql1 = "select * from sanpham";
                    $s = LayDanhSach($sql1);
                    foreach($s as $r){ ?>
                        <option value = "<?php echo$r['MaSanPham'];?>"><?php echo $r['TenSanPham'];?></option>
                <?php } ?>
            </select> <br/>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Size</label>
            <select class = "form-select w-50" name = "size">
                <?php
                    $sql2 = "select * from size";
                    $a = LayDanhSach($sql2);
                    foreach($a as $b){ ?>
                        <option value = "<?php echo$b['MaSize'];?>"><?php echo $b['Size'];?></option>
                <?php } ?>
                </select> <br/>
        </div>
        <button type="submit" class="btn btn-primary" name = "add">Add</button>
      </form>
    </div>
  </div>
</div>

<?php
  if(isset($_POST['add'])){
        $sp = $_POST['sp'];
        $size = $_POST['size'];
        $sql4 = "select * from sanpham_size WHERE masp = '$sp' and masize = '$size'";
        $check = countRow($sql4);
        if($check == 0){
            $sql3 = "insert into sanpham_size values('$sp', '$size')";
            $kq = Insert($sql3);
            if($kq){ 
                echo "<script>alert('Thêm thành công!'); window.location='size_sanpham.php'</script>";
            }
        }
        else{
            echo "<script>alert('Đã tồn tại!'); window.location='size_sanpham.php'</script>";
        }
  }
?>