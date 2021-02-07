<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  
  require "configurations/connect.php";

  $page = isset($_GET['page']) ? $_GET['page'] : '';

  $user = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : null;
  $username = isset($user['username']) ? $user['username'] : '';
  $user_id = isset($user['id']) ? $user['id'] : 0;

  $activeMenuClass = "alert alert-dark";
?>
<header class="
  d-flex flex-column 
  flex-md-row 
  align-items-center 
  p-2
  px-md-4 
  mb-3
  border-bottom 
  shadow-sm"
>
  <a
     href='index.php' 
     class="btn my-0 mr-md-auto"
     style='font-size: 15pt; font-weight: bold;'
  >
    Aplikasi ZIS
  </a>
  <?php
   if($user):
  ?>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark <?php if ($page == 'users'){ echo $activeMenuClass; } ?> " href="index.php?page=users">Pengguna</a>
    <a class="p-2 text-dark <?php if ($page == 'masters'){ echo $activeMenuClass; } ?>" href="index.php?page=masters">Kategori ZIS</a>
    <a class="p-2 text-dark <?php if ($page == 'muzakki'){ echo $activeMenuClass; } ?>" href="index.php?page=muzakki">Muzakki</a>
    <a class="p-2 text-dark <?php if ($page == 'mustahik'){ echo $activeMenuClass; } ?>" href="index.php?page=mustahik">Mustahik</a>
    <a class="p-2 text-dark <?php if ($page == 'transactions'){ echo $activeMenuClass; } ?>" href="index.php?page=transactions">Transaksi</a>
    <button class="btn dropdown-toggle mb-1" type="button" id="dropdownReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Laporan
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownReport">
      <a class="dropdown-item" href="index.php?page=reports">Pengumpulan ZIS</a>
      <a class="dropdown-item" href="index.php?page=reports&action=penggunaan">Penggunaan ZIS</a>
      <a class="dropdown-item" href="index.php?page=reports&action=penerimaan">Penerima ZIS</a>
    </div>
  </nav>
  <div class="btn-group">
    <button type="button" class="btn btn-primary">
      <i class="fas fa-user-circle"></i>
      <?php echo $username; ?>
    </button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="actions/auth/logout.php">Sign Out</a>
    </div>
  </div>  
  <?php
    endif;
  ?>
</header>