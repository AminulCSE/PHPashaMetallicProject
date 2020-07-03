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
    $taka        = $_POST['taka'];
    $description = $_POST['description'];

    $name        = $fm->validation($name);
    $taka        = $fm->validation($taka);
    $description = $fm->validation($description);

    $name        = mysqli_real_escape_string($db->link, $name);
    $taka        = mysqli_real_escape_string($db->link, $taka);
    $description = mysqli_real_escape_string($db->link, $description);

    if (empty($name)||empty($taka)||empty($description)) {
      echo "<span style='color:red;font-size:18px;'>Field must not be empty !!</span>";
    }else{
        $query = "INSERT INTO tbl_salary_advanced(name, taka, description) 
        VALUES('$name', '$taka', '$description')";
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
                  <form class="user" action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="sel1">Name:</label>
                        <select class="form-control" id="sel1" name="name">
                          <option selected="">Chose advancer name</option>
                            <?php
                              $query = "SELECT * FROM tbl_employee";
                              $result = $db->select($query);
                              if ($result) {
                                $i=0;
                                while ($value = $result->fetch_assoc()) {
                                $i++;
                            ?>
                                <option value="<?php echo $value['name']; ?>" name="name"><?php echo $value['name']; ?></option>
                            <?php }} ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Amount of taka</label>
                        <input type="text" name="taka" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter advanced amount in taka....">
                      </div>

                      <div class="form-group">
                        <label for="comment">Description:</label>
                        <textarea class="form-control" rows="5" id="comment" name="description"></textarea>
                      </div>

                      

                      <div class="mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Advanced</button>
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