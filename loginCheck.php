<?php
    session_start();
    if (!isset($_SESSION['fac_no'])) {
		header('Location:login.php');
  }
?>