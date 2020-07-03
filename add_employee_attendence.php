<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->
<?php
  if(isset($_POST['submit'])) {

  foreach ($_POST['attendence_status'] as $id => $attendence_status) {
    $name               = $_POST['name'][$id];
    $designation        = $_POST['designation'][$id];
    $date               = date("Y-m-d");

    $query = "INSERT INTO tbl_attendence(name,designation,attendence_status,$date)
      VALUES('$name','$designation','$attendence_status','date')";
      $inserted_rows = $db->insert($query);
  }
}
?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <form class="user" action="" method="post" enctype="multipart/form-data">
            <table class="table table-striped" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>SL NO.</th>
                  <th>Image</th>
                  <th>Designation</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Present/ Absent</th>
                </tr>
              </thead>
              <tbody>
<?php
  $query = "SELECT * FROM tbl_employee";
  $result = $db->select($query);
  if ($result) {
    $i=0;
    $counter=0;
    while ($value = $result->fetch_array()) {
    $i++;
?>
<tr>
<td><?php echo $i; ?></td>
<td><img src="<?php echo $value['image']; ?>" height="50px;" width="50px;"></td>
<td name="designation[]"><?php echo $value['designation']; ?></td>
<td style="color: green;font-weight:bold;"  name="name[]"><?php echo $value['name']; ?></td>
<td style="color: green;font-weight:bold;" ><?php echo date("M - d - Y"); ?></td>

<td>  
<label>Present&nbsp;
<input type="radio" value="Present" name="attendence_status[<?php echo $counter; ?>]">
</label>

<label class="checkbox-inline">||
Absent&nbsp;<input type="radio" value="Absent" name="attendence_status[<?php echo $counter; ?>]">
</label>

</td>


</tr>
<?php 
  $counter++;
}
} ?>
</tbody>
</table>
  <div class="d-flex p-3 bg-secondary text-white">
    <button style="margin:auto;" type="submit" name="submit" class="btn btn-warning">Submit</button>
  </div>
</form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
  <?php include 'inc/footer.php'; ?>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>