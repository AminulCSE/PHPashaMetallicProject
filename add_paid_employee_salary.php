<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
<?php
  if(!isset($_GET['salarid']) || $_GET['salarid'] == NULL) {
      echo "<script>window.location='show_employee.php';</script>";
   }else{
      $salarid = $_GET['salarid'];
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
    $month        = $_POST['month'];
    $amount       = $_POST['amount'];
    $overtime     = $_POST['overtime'];

    $name         = $fm->validation($name);
    $month        = $fm->validation($month);
    $amount       = $fm->validation($amount);
    $overtime     = $fm->validation($overtime);

    $name         = mysqli_real_escape_string($db->link, $name);
    $month        = mysqli_real_escape_string($db->link, $month);
    $amount       = mysqli_real_escape_string($db->link, $amount);
    $overtime     = mysqli_real_escape_string($db->link, $overtime);

    $overtime_amount_per_day  = $amount/30;
    $overtime_amount_per_hour = $overtime_amount_per_day/10;
    $total_overtime = $overtime_amount_per_hour*$overtime;
    echo $total_overtime ;

    if (empty($name)||empty($month)||empty($amount)||empty($overtime)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{

    $year = date('Y');
    $query = "INSERT INTO tbl_salary(name, month, year, amount, overtime) 
        VALUES('$name', '$month', '$year','$amount','$overtime')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Not Inserted !</span>";
      }
    }
   }
?>


<?php
  $query = "SELECT * FROM  tbl_employee WHERE id='$salarid'";
              $result = $db->select($query);
              if ($result) {
                while ($value = $result->fetch_assoc()) {
  
?>
                      <div class="form-group">
                        <div style="font-size:25px; height:50px; width:auto; background:#36b9cc; color:white; text-align:center; border:solid 3px #1cc88a; "><?php echo 'Employee Name: '.$value['name']; ?></div>
                      </div>
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group" style="display:none;">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['name']; ?>">
                      </div>

                      <div class="form-group" style="display:none;">
                        <input type="text" name="amount" class="form-control form-control-user" id="exampleInputPassword" value="<?php echo $value['salary']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Enter Month:</label>
                        <input type="text" name="month" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter your salary month....">
                      </div>

                      <div class="form-group">
                        <label>Overtime Duration:</label>
                        <input type="text" name="overtime" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter your salary month....">
                      </div>

                      <div class="mt-3">
                        <button type="submit" style="font-size:25px; height:50px; width:150px; background:green; color:white; text-align:center; " name="submit" class="btn btn-success">Paid</button>
                      </div>
                  </form>
                  <div class="mt-3">
                        <a href="show_employee.php">
                          <button style="font-size:18px; height:40px; width:150px; background:#858796; color:white; text-align:center; " type="button" class="btn btn-default">Back</button>
                        </a>
                      </div>
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