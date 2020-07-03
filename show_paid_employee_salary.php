<?php include 'inc/header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          
<?php
  if (isset($_GET['delid'])) {
   $id = $_GET['delid'];

   $getquery = "select * from  tbl_salary where id='$id'";
   $getImg = $db->select($getquery);
   if ($getImg) {
    while ($imgdata = $getImg->fetch_assoc()) {
    $delimg = $imgdata['image'];
    unlink($delimg);
    }
   }
   
   $query = "delete from  tbl_salary where id='$id'";
   $delImage = $db->delete($query);
   if ($delImage) {
     echo "<span class='success'>Image Deleted Successfully.
     </span>";
    }else {
     echo "<span class='error'>Image Not Deleted !</span>";
    }
   }
  ?>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All client bill info here....</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SL NO.</th>
                      <th>Name</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Amount</th>
                      <th>Overtime</th>
                      <th>Total Amount</th>
                      <th>Paid Date</th>
                      <th>Edit/ Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
              $query = "SELECT * FROM  tbl_salary";
              $result = $db->select($query);
              if ($result) {
                $i=0;
                while ($value = $result->fetch_assoc()) {
                $i++;
            ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value['name']; ?></td>
                      <td><?php echo $value['month']; ?></td>
                      <td><?php echo $value['year']; ?></td>
                      <td><?php echo $value['amount']; ?></td>
                      <td><?php echo $value['overtime']; ?></td>
                      <td>

    <?php
      $get_amount = $value['amount'];
      $amount_of_time = $value['overtime'];
      $overtime_amount_per_day  = $get_amount/30;
      $overtime_amount_per_hour = $overtime_amount_per_day/10;
      $total_overtime = $amount_of_time*$overtime_amount_per_hour;
    ?>

                        <?php 
                        $total_amount = $value['amount'] + $total_overtime;
                        echo $total_amount;

                        ?>

                      </td>
                      <td><?php echo $value['paid_date']; ?></td>                      
                      <td><a OnClick="return confirm('Are you sure to delet date??');" href="?delid=<?php echo $value['id']; ?>">Delete</a>||
                        <a href="edit_paid_salary.php?editid=<?php echo $value['id']; ?>">Edit</a>
                    </td>
                    </tr>

                    <?php } } ?>
                  </tbody>
                </table>
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