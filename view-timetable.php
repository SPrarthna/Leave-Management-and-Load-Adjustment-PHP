<?php
  include('loginCheck.php');
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    .sorting, .sorting_asc, .sorting_desc {
    background : none;
}
 </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Faculty| View Timetable</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'menu.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Timetable
        <!--<small>advanced tables</small>-->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header"></div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Day</th>
                  <th>9:00-9:50</th>
                  <th>9:50-10:50</th>
                  <th>11:15-12:15</th>
                  <th>12:15-1:15</th>
                  <th>2:00-3:00</th>
                  <th>3:00-4:00</th>
                  <th>4:15-5:15</th>
                  <th>5:15-6:10</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $conn=mysqli_connect("localhost","root","","flms");
                if($conn ->connect_error){
                    die("connection failed:". $conn -> connect_error);
                }
                $fac_no = $_SESSION['fac_no'];

                // array of days
                $days = array("MON","TUE","WED","THU","FRI","SAT");

                // loop for days
                foreach ($days as $day) {
                  
                    $sql="SELECT master.branchID,master.slot_no,master.batch,master.division,master.loc_no,master.sem_no ,master.day 
                    FROM faculty join master on master.fac_no=faculty.fac_no join branch on branch.branchID=master.branchID 
                    where master.fac_no='$fac_no' ANd master.day='$day'";

                    // strings for data of the slots
                    $slot_data = array("","","","","","","","");
                    
                    $result=$conn -> query($sql);
                    if( !empty($result) && $result -> num_rows > 0){
                      while($row =$result ->fetch_assoc()){
                        $slot = $row['slot_no'];
                        if(isset($slot)){
                          $slot_data[$slot-1] = $slot_data[$slot-1]."<br>".$row['branchID']."  ".$row['division']."  ".$row['batch']."<br>".$row['loc_no'];
                        }  
              ?>  
                <tr>
                <td><?php echo $day;?></td>
                <?php 
                  foreach($slot_data as $data_to_print){  
                    echo "<td>".$data_to_print."</td>";
                  }
                ?>
                </tr>
                <?php
                $slot_data = array("","","","","","","","");
            }
          }
            }
                $conn ->close();
                ?>  
                </tbody>
                <tfoot>
                <tr>
                  <th>Day</th>
                  <th>9:00-9:50</th>
                  <th>9:50-10:50</th>
                  <th>11:15-12:15</th>
                  <th>12:15-1:15</th>
                  <th>2:00-3:00</th>
                  <th>3:00-4:00</th>
                  <th>4:15-5:15</th>
                  <th>5:15-6:10</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --><footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="">Nirma University</a></strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      "bSortable": false, 
      
       'order'      :false
    })
  })
</script>
</body>
</html>
