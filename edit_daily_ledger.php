<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
<?php
  if(!isset($_GET['editid']) || $_GET['editid'] == NULL) {
      echo "<script>window.location='show_daily_ledger.php';</script>";
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
    $description  = $_POST['description'];
    $amount       = $_POST['amount'];

    $description  = $fm->validation($description);
    $amount       = $fm->validation($amount);

    $description  = mysqli_real_escape_string($db->link, $description);
    $amount       = mysqli_real_escape_string($db->link, $amount);

    if (empty($description)||empty($amount)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/office_cost_bill/".$unique_image;

  if(!empty($file_name)) {
    if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{


// Unlink image for here for the updating image
$get_img_query = "SELECT image FROM tbl_ledger WHERE id='$editid'";
$get_img_result = $db->select($get_img_query);
if ($get_img_result) {
while ($img_value = $get_img_result->fetch_assoc()) {
unlink($img_value['image']);
}}


    move_uploaded_file($file_temp, $uploaded_image);
    $query = "UPDATE tbl_ledger
              SET description = '$description',
                  amount      = '$amount',
                  image       = '$uploaded_image'
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
            $query = "UPDATE tbl_ledger
                        SET description = '$description',
                        amount          = '$amount'
                        WHERE id        = '$editid'";

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
  $query = "SELECT * FROM tbl_ledger WHERE id='$editid'";
              $result = $db->select($query);
              if ($result) {
                while ($value = $result->fetch_assoc()) {
  
?>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="comment">Description:</label>
                        <textarea class="form-control" rows="5" id="comment" name="description"><?php echo $value['description']; ?>"</textarea>
                      </div>

                      <div class="form-group">
                        <label>Amount:</label>
                        <input type="text" name="amount" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['amount']; ?>">
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