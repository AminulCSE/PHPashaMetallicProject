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
    $name        = $_POST['name'];
    $designation = $_POST['designation'];
    $joining_date= $_POST['joining_date'];
    $salary      = $_POST['salary'];

    $name        = $fm->validation($name);
    $designation = $fm->validation($designation);
    $joining_date= $fm->validation($joining_date);
    $salary      = $fm->validation($salary);

    $name        = mysqli_real_escape_string($db->link, $name);
    $designation = mysqli_real_escape_string($db->link, $designation);
    $joining_date= mysqli_real_escape_string($db->link, $joining_date);
    $salary      = mysqli_real_escape_string($db->link, $salary);

    if (empty($name)||empty($designation)||empty($joining_date)||empty($salary)) {
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

    if (!empty($file_name)) {
        if($file_size >1048567) {
         echo "<span class='error'>Image Size should be less then 1MB!
         </span>";
        } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-"
         .implode(', ', $permited)."</span>";
        } else{
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_employee(name, image, designation, joining_date, salary) 
        VALUES('$name', '$uploaded_image', '$designation', '$joining_date','$salary')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Not Inserted !</span>";
      }
    }
  }else{
      $query = "INSERT INTO tbl_employee(name, designation, joining_date, salary) 
        VALUES('$name', '$designation', '$joining_date','$salary')";
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
              <h3>Add Employee</h3>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter employee name....">
                      </div>

                      <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter employee designation....">
                      </div>

                      <div class="form-group">
                        <label>Joining Date</label>
                        <input type="date" name="joining_date" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter employee joining date....">
                      </div>

                      <div class="form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter employee salary....">
                      </div>

                      <!-- <div class="form-group">
                        <label for="sel1">Slary Status:</label>
                        <select class="form-control" id="sel1" name="institute_name">

                          <option selected="">Chose your option</option>
                          <option value="0" name="salary">UnPaid</option>
                          <option value="1" name="salary">Paid</option>

                        </select>
                      </div><hr> -->

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Choseoose employee image file</label>
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