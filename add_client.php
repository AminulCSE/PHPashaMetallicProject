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
  if (isset($_POST['submit'])) {
    $institute_name = $_POST['institute_name'];
    $owner_name     = $_POST['owner_name'];
    $address        = $_POST['address'];

    $institute_name = $fm->validation($institute_name);
    $owner_name     = $fm->validation($owner_name);
    $address        = $fm->validation($address);

    $institute_name = mysqli_real_escape_string($db->link, $institute_name);
    $owner_name     = mysqli_real_escape_string($db->link, $owner_name);
    $address        = mysqli_real_escape_string($db->link, $address);

    if (empty($institute_name)||empty($owner_name)||empty($address)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
      $query = "INSERT INTO tbl_client(institute_name,owner_name,address)VALUES('$institute_name','$owner_name', '$address')";
      $result = $db->insert($query);
      if ($result) {
        echo "<span style='color:green;font-size:18px;'>Inserted succesfully...</span>";
      }
    }
  }
?>
              <h3>Add Client</h3>
                  <form class="user" action="" method="POST">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="institute_name" placeholder="Enter Institute Name...">
                      </div>

                      <div class="form-group">
                        <input type="text" name="owner_name" class="form-control form-control-user" id="exampleInputPassword" placeholder="Institute Owner Name....">
                      </div>

                      <div class="form-group">
                        <input type="text" name="address" class="form-control form-control-user" id="exampleInputPassword" placeholder="Institute address....">
                      </div>
                      <button name="submit" class="btn btn-primary btn-user btn-block">
                        Insert
                      </button>
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