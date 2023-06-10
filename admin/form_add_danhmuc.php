<?php
    require_once 'req_admin/header_admin.php';
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
            <label class="form-label fw-bold">Tên danh mục</label>
            <input type="text" class="form-control" name = "tendanhmuc" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Hình ảnh</label>
            <input type="file" name = "file1" required>
        </div>
        <button type="submit" class="btn btn-primary" name = "add">Add</button>
      </form>
    </div>
  </div>
</div>

<?php
  require_once './controller_admin/controller.php';
  if(isset($_POST['add'])){
      $madanhmuc = null;
      $tendanhmuc = $_POST['tendanhmuc'];
      //$file = $_FILES['image'];
      //$filename = $file['name'];
      //move_uploaded_file($file['tmp_name'], '../img/'.$filename);
      try{
        if(empty($_FILES['file1']))
        {
            throw new Exception('Invalid upload');
        }
        switch($_FILES['file1']['error'])
        {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploads');
            default:
                throw new Exception('Error');
        }
        if($_FILES['file1']['error'] > 10000000)
        {
            throw new Exception('File too large');               
        }
        $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES['file1']['tmp_name']);
        if(!in_array($mime_type, $mime_types))
        {
            throw new Exception('Invalid file type');
        }
        $pathinfo = pathinfo($_FILES['file1']['name']);
        $fname = 'image';
        $extension = $pathinfo['extension'];
        $dest = '../img/'. $fname. '.'.$extension;
        $i = 1;
        while(file_exists($dest))
        {
          $dest = '../img/'. $fname. "-$i.".$extension;
          $i++;
        }
        move_uploaded_file($_FILES['file1']['tmp_name'], $dest);
        $sql = "insert into danhmucsanpham values('$madanhmuc', '$tendanhmuc', '$dest')";
        $kq = Insert($sql);
        if($kq){ 
            echo "<script>alert('Thêm thành công!'); window.location='danhmuc.php'</script>";
        }
    }catch(Exception $e)
    {
        echo $e->getMessage();
    }
  }
?>