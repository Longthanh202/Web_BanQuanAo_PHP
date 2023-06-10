<?php
    require_once 'req_admin/header_admin.php';
    require_once './controller_admin/controller.php';
?>
<div class="jumbotron text-center">
  <h1>Welcome to edit category page</h1>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <?php
       require_once 'req_admin/left_admin.php';
      ?>
    </div>
    <div class="col-sm-10" style = "background-color:#EEEEEE">
    <?php
        $id = $_GET['MaDanhMuc'];
        $sql = "select * from danhmucsanpham where MaDanhMuc = '$id'";
        $temp = TruyVan($sql);
        foreach($temp as $row){
    ?>
        <form action = "" method = "post" enctype = "multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-bold">Tên danh mục</label>
                <input type="text" class="form-control" name = "tendanhmuc" required value = "<?php echo $row['TenDanhMuc']?>">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh</label>
                <img src="<?php echo$row['HinhAnh'].'"'?> alt="" style = "width:100px; height:100px"><br/><br/>
                <input type="file" name = "file" required value = "<?php echo$row['HinhAnh']?>">
            </div>
            <button type="submit" class="btn btn-primary" name = "edit">Save</button>
        </form>
      <?php } ?>
    </div>
  </div>
</div>
<?php
    require_once './controller_admin/controller.php';
    if(isset($_POST['edit'])){
        $getID = $_GET['MaDanhMuc'];
        $tendanhmuc = $_POST['tendanhmuc'];
        // $file = $_FILES['image'];
        // $filename = $file['name'];
        // move_uploaded_file($file['tmp_name'], '../img/'.$filename);
        $mime_types1 = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info1 = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type1 = finfo_file($file_info1, $_FILES['file']['tmp_name']);
        if(!in_array($mime_type1, $mime_types1))
        {
            throw new Exception('Invalid file type');
        }
        $pathinfo1 = pathinfo($_FILES['file']['name']);
        $fname1 = 'editdanhmuc';
        $extension1 = $pathinfo1['extension'];
        $dest1 = '../img/'. $fname1. '.'.$extension1;
        $i = 1;
        while(file_exists($dest1))
        {
          $dest1 = '../img/'. $fname1. "-$i.".$extension1;
          $i++;
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $dest1);
        $sql = "update danhmucsanpham set TenDanhMuc = '$tendanhmuc', HinhAnh = '$dest1' where MaDanhMuc = '$getID'";
        $kq = Update($sql);
        if($kq){
            echo "<script>alert('Update thành công!'); window.location='danhmuc.php'</script>";
        }
    }
?>
