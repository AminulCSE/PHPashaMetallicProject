<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
<?php
  if(!isset($_GET['editid']) || $_GET['editid'] == NULL) {
      echo "<script>window.location='show_employee.php';</script>";
   }else{
      $editid = $_GET['editid'];
   }
  ?>


<!-- Content Row -->
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">


<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = $_POST['name'];
    $designation  = $_POST['designation'];
    $joining_date = $_POST['joining_date'];

    $name              = $fm->validation($name);
    $designation       = $fm->validation($designation);
    $joining_date      = $fm->validation($joining_date);

    $name               = mysqli_real_escape_string($db->link, $name);
    $designation        = mysqli_real_escape_string($db->link, $designation);
    $joining_date       = mysqli_real_escape_string($db->link, $joining_date);

    if (empty($name)||empty($designation)||empty($joining_date)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/employee_img/".$unique_image;

  if(!empty($file_name)) {
    if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{

      $get_img_query = "SELECT image FROM tbl_employee WHERE id='$editid'";
              $get_img_result = $db->select($get_img_query);
              if ($get_img_result) {
                while ($img_value = $get_img_result->fetch_assoc()) {
                  unlink($img_value['image']);
                }}


    move_uploaded_file($file_temp, $uploaded_image);
    $query = "UPDATE tbl_employee
              SET name        = '$name',
                  image       = '$uploaded_image',
                  designation = '$designation',
                  joining_date = '$joining_date'
                  WHERE id    = '$editid'";
    $update_rows = $db->update($query);
    if ($update_rows) {
     echo "<span class='success'>Update Successfully.
     </span>";
      

    }else {
     echo "<span class='error'>Not Update !</span>";
    }
    }

   }else{
            $query = "UPDATE tbl_employee
                      SET name    = '$name',
                      designation = '$designation',
                      joining_date = '$joining_date'
                      WHERE id    = '$editid'";

          $update_rows = $db->update($query);
          if ($update_rows) {
           echo "<span class='success'>Update Successfully.
           </span>";
          }else {
           echo "<span class='error'>Not Update !</span>";
          }
   }
 }
}

?>


<?php
  $query = "SELECT * FROM tbl_employee WHERE id='$editid'";
              $result = $db->select($query);
              if ($result) {
                while ($value = $result->fetch_assoc()) {
  
?>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['name']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Designation:</label>
                        <input type="text" name="designation" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['designation']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Joining Date:</label>
                        <input type="date" name="joining_date" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['joining_date']; ?>">
                      </div>

                      <div>
                        <img src="<?php echo $value['image'];?>" height="120px" width="120px" name="image" id="customFile">
                      </div>

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>

                      <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
<?php } } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'inc/footer.php'; ?>