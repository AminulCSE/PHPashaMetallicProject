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
    $item_name        = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $total_price      = $_POST['total_price'];
    $paid_amount      = $_POST['paid_amount'];
    $bill_no          = $_POST['bill_no'];
    $institute_name   = $_POST['institute_name'];
    $client_name      = $_POST['client_name'];
    $client_phone     = $_POST['client_phone'];

    $item_name        = $fm->validation($item_name);
    $item_description = $fm->validation($item_description);
    $total_price      = $fm->validation($total_price);
    $paid_amount      = $fm->validation($paid_amount);
    $bill_no          = $fm->validation($bill_no);
    $institute_name   = $fm->validation($institute_name);
    $client_name      = $fm->validation($client_name);
    $client_phone     = $fm->validation($client_phone);

    $item_name        = mysqli_real_escape_string($db->link, $item_name);
    $item_description = mysqli_real_escape_string($db->link, $item_description);
    $total_price      = mysqli_real_escape_string($db->link, $total_price);
    $paid_amount      = mysqli_real_escape_string($db->link, $paid_amount);
    $bill_no          = mysqli_real_escape_string($db->link, $bill_no);
    $institute_name   = mysqli_real_escape_string($db->link, $institute_name);
    $client_name      = mysqli_real_escape_string($db->link, $client_name);
    $client_phone     = mysqli_real_escape_string($db->link, $client_phone);

    if (empty($paid_amount)) {
      $paid_amount = 0;
    }

    if (empty($item_name)||empty($item_description)||empty($total_price)||empty($bill_no)||empty($client_name)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/bill_img/".$unique_image;

  if(!empty($file_name)) {
    if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    } else{

      $get_img_query = "SELECT image FROM tbl_bill WHERE id='$editid'";
              $get_img_result = $db->select($get_img_query);
              if ($get_img_result) {
                while ($img_value = $get_img_result->fetch_assoc()) {
                  unlink($img_value['image']);
                }}


    move_uploaded_file($file_temp, $uploaded_image);
    $query = "UPDATE tbl_bill
              SET image = '$uploaded_image',
                  item_name = '$item_name',
                  item_description = '$item_description',
                  total_price = '$total_price',
                  paid_amount = '$paid_amount',
                  bill_no = '$bill_no',
                  client_name = '$client_name',
                  client_phone = '$client_phone',
                  institute_name = '$institute_name'
                  WHERE id = '$editid'";
    $update_rows = $db->update($query);
    if ($update_rows) {
     echo "<span class='success'>Update Successfully.
     </span>";
      

    }else {
     echo "<span class='error'>Not Update !</span>";
    }
    }

   }else{
            $query = "UPDATE tbl_bill
                    SET item_name = '$item_name',
                        item_description = '$item_description',
                        total_price = '$total_price',
                        paid_amount = '$paid_amount',
                        bill_no = '$bill_no',
                        client_name = '$client_name',
                        client_phone = '$client_phone',
                        institute_name = '$institute_name'
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
}

?>


<?php
  $query = "SELECT * FROM tbl_bill WHERE id='$editid'";
              $result = $db->select($query);
              if ($result) {
                while ($value = $result->fetch_assoc()) {
  
?>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Bill Number</label>
                        <input type="text" name="bill_no" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['bill_no']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Client Name:</label>
                        <input type="text" name="client_name" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['client_name']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Client Phone:</label>
                        <input type="text" name="client_phone" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['client_phone']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Item name</label>
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="item_name" value="<?php echo $value['item_name']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="comment">Description:</label>
                        <textarea class="form-control" rows="5" id="comment" name="item_description"><?php echo $value['item_description']; ?></textarea>
                      </div>

                      <div class="form-group">
                        <label>Total Price</label>
                        <input type="text" name="total_price" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['total_price']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Paid amount</label>
                        <input type="text" name="paid_amount" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['paid_amount']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="sel1">Institute name:</label>
                        <select class="form-control" id="sel1" name="institute_name">
                          <?php
                              $query2 = "SELECT institute_name FROM tbl_client";
                              $result2 = $db->select($query2);
                              if($result2){
                                while ($value2 = $result2->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $value2['institute_name']; ?>" name="institute_name"
                            <?php if ($value['institute_name'] == $value2['institute_name']) {
                            echo "selected=''";
                          } ?>>
                            <?php echo $value2['institute_name']; ?>
                          </option>
                            <?php } } ?>
                        </select>
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