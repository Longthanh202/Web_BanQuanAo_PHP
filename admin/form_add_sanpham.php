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
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" class="form-control" name = "tensanpham" required style = "width: 500px">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Giá nhập</label>
            <input type="number" class="form-control" name = "gianhap" required style = "width: 500px">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Giá bán</label>
            <input type="number" class="form-control" name = "giaban" required style = "width: 500px">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Mô tả</label>
            <textarea class="form-control" rows="3" placeholder="Ghi chú" name = "mota" required style = "width: 500px; height:100px"></textarea>
            <!-- <input type="text" class="form-control" name = "mota" required style = "width: 500px; height:100px"> -->
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Hình ảnh</label>
            <input type="file" name = "hinh1" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Hình ảnh</label>
            <input type="file" name = "hinh2" required>
        </div>
        <div class="mb-3">
            <?php
                $sql = "select * from danhmucsanpham";
                $stmt = TruyVan($sql);
            ?>
            <select name = "maloai" class="form-control" style = "width: 500px">
                <?php 
                    foreach($stmt as $row){ ?>
                        <option value = "<?php echo $row['MaDanhMuc']?>"><?php echo $row['TenDanhMuc'] ?></option>
                 <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name = "add">Add</button>
      </form>
    </div>
  </div>
</div>

<?php
  require_once './controller_admin/controller.php';
  if(isset($_POST['add'])){
      $masp = null;
      $tensp = $_POST['tensanpham'];
      $gianhap = $_POST['gianhap'];
      $giaban = $_POST['giaban'];
      $loai = $_POST['maloai'];
      $mota = $_POST['mota'];
      // $file1 = $_FILES['hinh1'];
      // $filename1 = $file1['name'];
      // move_uploaded_file($file1['tmp_name'], '../img/'.$filename1);
      // $file2 = $_FILES['hinh2'];
      // $filename2 = $file2['name'];
      // move_uploaded_file($file2['tmp_name2'], '../img/'.$filename2);
        $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['hinh1']['tmp_name']);
        if(!in_array($mime_type, $mime_types))
        {
            throw new Exception('Invalid file type');
        }
        $pathinfo = pathinfo($_FILES['hinh1']['name']);
        $fname = 'sps';
        $extension = $pathinfo['extension'];
        $dest = '../img/'. $fname. '.'.$extension;
        $i = 1;
        while(file_exists($dest))
        {
          $dest = '../img/'. $fname. "-$i.".$extension;
          $i++;
        }
        move_uploaded_file($_FILES['hinh1']['tmp_name'], $dest);
        //---------------------------------------------------------------
        $mime_types1 = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info1 = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type1 = finfo_file($file_info1, $_FILES['hinh2']['tmp_name']);
        if(!in_array($mime_type1, $mime_types1))
        {
            throw new Exception('Invalid file type');
        }
        $pathinfo1 = pathinfo($_FILES['hinh2']['name']);
        $fname1 = 'sp';
        $extension1 = $pathinfo1['extension'];
        $dest1 = '../img/'. $fname1. '.'.$extension1;
        $i = 1;
        while(file_exists($dest1))
        {
          $dest1 = '../img/'. $fname1. "-$i.".$extension1;
          $i++;
        }
        move_uploaded_file($_FILES['hinh2']['tmp_name'], $dest1);
      $sql = "insert into sanpham values('$masp', '$tensp', '$gianhap', '$giaban', '$loai', '$mota', '$dest', '$dest1')";
      $kq = Insert($sql);
      if($kq){
          echo "<script>alert('Thêm thành công!'); window.location='sanpham.php'</script>";
      }
  }
?>
