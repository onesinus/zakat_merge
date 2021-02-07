<?php
  $user = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : null;
  $username = isset($user['username']) ? $user['username'] : '';
?>