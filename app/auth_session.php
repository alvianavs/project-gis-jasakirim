<?php
    session_start();
    if(!isset($_SESSION["is_login"])) {
        header("Location: http://localhost/project-akhir-gis/app/login.php");
        exit();
    }
?>