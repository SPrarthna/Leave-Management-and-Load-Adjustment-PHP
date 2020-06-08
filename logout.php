<?php
    session_start();
    unset($_SESSION['fac_no']);
    session_destroy();
    header("Location: login.php");
?>