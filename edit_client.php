<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
<?php
  if(!isset($_GET['editid']) || $_GET['editid'] == NULL) {
      echo "<script>window.location='show_client.php';</script>";
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
    $institute_name  = $_POST['institute_name'];
    $owner_name      = $_POST['owner_name'];
    $address         = $_POST['address'];

    $institute_name  = $fm->validation($institute_name);
    $owner_name      = $fm->validation($owner_name);
    $address         = $fm->validation($address);

    $institute_name  = mysqli_real_escape_string($db->link, $institute_name);
    $owner_name      = mysqli_real_escape_string($db->link, $owner_name);
    $address         = mysqli_real_escape_string($db->link, $address);

    if (empty($institute_name)||empty($owner_name)||empty($address)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
    $query = "UPDATE tbl_client
              SET institute_name = '$institute_name',
                  owner_name = '$owner_name',
                  address = '$address'
                  WHERE id = '$editid'";
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
  $query = "SELECT * FROM tbl_client WHERE id='$editid'";
              $result = $db->select($query);
              if ($result) {
                while ($value = $result->fetch_assoc()) {
  
?>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Institute Name:</label>
                        <input type="text" name="institute_name" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['institute_name']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Owner Name:</label>
                        <input type="text" name="owner_name" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['owner_name']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Address:</label>
                        <input type="text" name="address" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['address']; ?>">
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