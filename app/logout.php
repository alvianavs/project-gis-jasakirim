<?php
session_start();

session_destroy();
header("location: http://localhost/project-akhir-gis/app/login.php");
?>