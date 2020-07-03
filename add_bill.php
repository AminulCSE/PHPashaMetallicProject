<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

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
    $item_name              = $_POST['item_name'];
    $total_item             = $_POST['total_item'];
    $item_description       = $_POST['item_description'];
    $total_price            = $_POST['total_price'];
    $paid_amount            = $_POST['paid_amount'];
    $bill_no                = $_POST['bill_no'];
    $input_institute_name   = $_POST['input_institute_name'];

    if (empty($input_institute_name)) {
      $input_institute_name   = $_POST['institute_name'];
    }

    
    $client_name            = $_POST['client_name'];
    $client_phone           = $_POST['client_phone'];

    $item_name              = $fm->validation($item_name);
    $total_item             = $fm->validation($total_item);
    $item_description       = $fm->validation($item_description);
    $total_price            = $fm->validation($total_price);
    $paid_amount            = $fm->validation($paid_amount);
    $bill_no                = $fm->validation($bill_no);
    $input_institute_name   = $fm->validation($input_institute_name);
    $client_name            = $fm->validation($client_name);
    $client_phone           = $fm->validation($client_phone);

    $item_name              = mysqli_real_escape_string($db->link, $item_name);
    $total_item             = mysqli_real_escape_string($db->link, $total_item);
    $item_description       = mysqli_real_escape_string($db->link, $item_description);
    $total_price            = mysqli_real_escape_string($db->link, $total_price);
    $paid_amount            = mysqli_real_escape_string($db->link, $paid_amount);
    $bill_no                = mysqli_real_escape_string($db->link, $bill_no);
    $input_institute_name   = mysqli_real_escape_string($db->link, $input_institute_name);
    $client_name            = mysqli_real_escape_string($db->link, $client_name);
    $client_phone           = mysqli_real_escape_string($db->link, $client_phone);


    $total_price = $total_price*$total_item;

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

    if (!empty($file_name)) {
        if($file_size >1048567) {
         echo "<span class='error'>Image Size should be less then 1MB!
         </span>";
        } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-"
         .implode(', ', $permited)."</span>";
        } else{
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_bill(image,item_name,total_item,item_description,total_price,paid_amount,bill_no,client_name,client_phone,institute_name) 
        VALUES('$uploaded_image', '$item_name', '$total_item', '$item_description', '$total_price','$paid_amount', '$bill_no','$client_name', '$client_phone', '$input_institute_name')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Not Inserted !</span>";
      }
    }
  }else{
      $query = "INSERT INTO tbl_bill(item_name, total_item, item_description,total_price,paid_amount,bill_no,client_name,client_phone,institute_name) 
        VALUES('$item_name', '$total_item', '$item_description', '$total_price','$paid_amount', '$bill_no','$client_name', '$client_phone', '$input_institute_name')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Not Inserted !</span>";
      }
  }
 }
}

?>
              <h3>Add Client</h3>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Bill Number</label>
                        <input type="text" name="bill_no" class="form-control form-control-user" id="exampleInputPassword" placeholder="Bill No....">
                      </div>

                      <div class="form-group">
                        <label>Client Name:</label>
                        <input type="text" name="client_name" class="form-control form-control-user" id="exampleInputPassword" placeholder="Client Name....">
                      </div>

                      <div class="form-group">
                        <label>Client Phone:</label>
                        <input type="text" name="client_phone" class="form-control form-control-user" id="exampleInputPassword" placeholder="Client Phone....">
                      </div>

                      <div class="form-group">
                        <label>Item name</label>
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="item_name" placeholder="Enter Item name...">
                      </div>

                      <div class="form-group">
                        <label>Total Item</label>
                        <input type="number" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="total_item" placeholder="Enter Item name...">
                      </div>

                      <div class="form-group">
                        <label for="comment">description:</label>
                        <textarea class="form-control" rows="5" id="comment" name="item_description"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Price per item</label>
                        <input type="text" name="total_price" class="form-control form-control-user" id="exampleInputPassword" placeholder="Amount per item Price....">
                      </div>

                      <div class="form-group">
                        <label>Advance</label>
                        <input type="text" name="paid_amount" class="form-control form-control-user" id="exampleInputPassword" placeholder="Paid amount....">
                      </div>

                      <div class="form-group">
                        <label for="sel1">Institute name:</label>
                        <select class="form-control" id="sel1" name="institute_name">
                          <option selected="">
                            Select istitute name
                          </option>
                          
                          <?php
                              $query = "SELECT * FROM tbl_client";
                              $result = $db->select($query);
                              if($result){
                                while ($value = $result->fetch_assoc()) {
                          ?>
                          <option value="<?php echo $value['institute_name']; ?>">
                            <?php echo $value['institute_name']; ?>
                          </option>
                          <?php } } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <input style="display:none;" id="inst_name1" type="text" name="input_institute_name" class="form-control form-control-user" id="exampleInputPassword" placeholder="Institute name....">

                        
                        <p id="hide" style="color:green;"><span>To add institute name</span> Show/Hide By Click</p>
                      </div>

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>

                      <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Insert</button>
                      </div>
                  </form>
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

<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#inst_name1").toggle(350);
  });
});
</script>