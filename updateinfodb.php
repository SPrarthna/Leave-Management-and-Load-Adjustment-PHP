<?php
  include('loginCheck.php');
?>

<?php   



        if(isset($_POST['update']))
        {

            $conn=mysqli_connect("localhost","root","","flms");
            if($conn ->connect_error)
            {
                die("connection failed:". $conn -> connect_error);

            }
            $sql="update faculty set fac_email_id='".$_POST['facultyEmails']."',
                    $_POST['facultyName']."',
            short_name='".$_POST['facultyShortName']."',
            department='".$_POST['facultyDepartment']."',
            designation='".$_POST['facultyDesignation']."' WHERE fac_no='".$_POST['fac_no']."'
            ";
            
            $result=$conn -> query($sql);
            $conn ->close();
        }
    ?>