<?php
    session_start();
    if ($_SESSION != null){
        session_destroy();
        header('Location: ../index.php');
    }
?>