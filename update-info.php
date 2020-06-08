<?php
  include('loginCheck.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Faculty | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
      .pull-right{
          float:right;
      }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'menu.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Personal Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="post">
                    <div class="box-body" style="padding:25px;">
                        <div class="form-group">
                            <label for="facultyEmail">Email</label>
                            <input type="email" class="form-control" id="facultyEmails" name="email">
                        </div>
                        <div class="form-group">
                            <label for="facultyName">Name</label>
                            <input type="text" class="form-control" id="facultyName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="facultyShortName">Short-Name</label>
                            <input type="text" class="form-control" id="facultyShortName" name="short-name">
                        </div>
                        <div class="form-group">
                        <?php
                         $conn=mysqli_connect("localhost","root","","flms");
                         if($conn ->connect_error)
                        {
                            die("connection failed:". $conn -> connect_error);

                        }
                    $sql="SELECT branchID FROM branch";
                    $sql2="SELECT Designation FROM designation";
                    $result2=$conn ->query($sql2);
                    $result=$conn -> query($sql);
                    ?>

                        <label>Department</label>
                            <select class="form-control" id="facultyDepartment" name="branch">
                                <option value="">Select Department</option>
                                <?php 
                                if($result -> num_rows>0)
                                { 
                                while($row = $result ->fetch_assoc())
                                {
                                    echo "<option>".$row[branchID]."</option>";
                                 }
                                }
                                else{
                                    echo "result not found";
                                }
                                    $conn ->close();?>

                            </select>
                        </div>
                        <div class="form-group">
                        <label>Select Faculty Designation</label>
                            <select class="form-control" id="facultyDesignation" name="designation">
                                <option value="">Select Designation</option>
                                <?php 
                                if($result2 -> num_rows>0)
                                { 
                                while($row = $result2 ->fetch_assoc())
                                {
                                    echo "<option>".$row[Designation]."</option>";
                                 }
                                }
                                else{
                                    echo "result not found";
                                }
                                    $conn ->close();?>

                                </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit"class="btn btn-primary pull-right" id="submit" name="submit">Update</button>
                    </div>
                    </form>

                    <?php
                    
                         $conn=mysqli_connect("localhost","root","","flms");
                         if($conn ->connect_error)
                        {
                            die("connection failed:". $conn -> connect_error);

                        }
                        if(isset($_POST['submit'])){
                                
                                $email = $_POST['email'];
                                $name = $_POST['name'];
                                $short_name = $_POST['short-name'];
                                $branch=$_POST['branch'];
                                $designation=$_POST['designation'];
                                $fac_no=$_SESSION['fac_no'];
                                //echo $email." ".$name." ".$short_name." ".$branch." ".$designation;

                                $sql3= "UPDATE faculty SET full_name='$name', short_name='$short_name',
                                 fac_email_id='$email', designation='$designation',department='$branch' WHERE fac_no='$fac_no'";
                                
                                //echo "<br>".$sql3;
                                if ($conn->query($sql3) === TRUE) {
                                    echo "<script>alert('Information Updated !');</script>";
                                } else {
                                    //echo "Error: ". $conn->error;
                                    echo "<script>alert('Something went wrong !');</script>";
                                }
                            } 
                            $conn ->close();

                    ?>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="">Nirma University</a></strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
