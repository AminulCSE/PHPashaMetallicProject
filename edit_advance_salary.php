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
    $taka  = $_POST['taka'];
    $description = $_POST['description'];

    $name              = $fm->validation($name);
    $taka       = $fm->validation($taka);
    $description      = $fm->validation($description);

    $name               = mysqli_real_escape_string($db->link, $name);
    $taka        = mysqli_real_escape_string($db->link, $taka);
    $description       = mysqli_real_escape_string($db->link, $description);

    if (empty($name)||empty($taka)||empty($description)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
    $query = "UPDATE tbl_salary_advanced
              SET name        = '$name',
                  taka = '$taka',
                  description = '$description'
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

?>


<?php
$query = "SELECT * FROM tbl_salary_advanced WHERE id='$editid'";
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
                        <label>Taka:</label>
                        <input type="text" name="taka" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['taka']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Description:</label>
                        <input type="text" name="description" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['description']; ?>">
                      </div>

                      <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
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