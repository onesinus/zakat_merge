<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['user_logged_in']);
    Header('Location: ../../index.php');
?>