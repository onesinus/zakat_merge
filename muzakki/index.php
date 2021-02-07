<?php
    if(isset($_SESSION['message'])):
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php     
    unset($_SESSION['message']);
    endif; 
?>
<a 
    href='index.php?page=muzakki&action=form' 
    class="btn btn-primary"
    style='float: left;'
>
    Tambah Muzakki
</a>
<table 
    class="table"
>
  <thead>
    <tr>
    <th 
    style='width: 5%'
    >
        #
      </th>
      <th>Nama</th>
      <th>Jenis</th>
      <th>Keterangan</th>
      <th>Total</th>
      <th>Status</th>
      <th>Dibuat</th>
      <th
        style='width: 35%'  
      >
        Aksi
    </th>
  </tr>
  </thead>
  <tbody>
      <?php
            $query = "
                SELECT * FROM muzakki WHERE is_deleted = 0";
            $datas = $conn->query($query);
            if ($datas->num_rows > 0):
                $i = 0;
                while ($row = $datas->fetch_assoc()):		      				
                    $i++;
      ?>
                <tr>
                    <td scope="row">
                        <?php echo $i ?>
                    </td>
                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                    <td>
                        <?php echo $row['type'] ?>
                    </td>
                    <td>
                        <?php echo $row['description'] ?>
                    </td>
                    <td>
                        <?php echo $row['grand_total'] ?>
                    </td>
                    <td>
                        <?php echo $row['status'] ?>
                    </td>
                    <td>
                        <?php echo $row['created_date'] ?>
                    </td>

                    <td>
                        <a href='index.php?page=muzakki&action=detail&id=<?php echo $row["id"]; ?>' class="btn btn-success">
                            Detail
                        </a>

                        <?php
                            if(in_array($row['status'], array('Open', 'Pickup'))):
                        ?>
                            <a href='index.php?page=muzakki&action=form&id=<?php echo $row["id"]; ?>' class="btn btn-warning">
                                Validasi
                            </a>
                            <button 
                                data-id='<?php echo $row["id"]; ?>' 
                                data-description='<?php echo $row["description"]; ?>' 
                                class="btnDelete btn btn-danger"
                            >
                                Delete
                            </button>
                        <?php
                            endif;
                        ?>
                    </td>
                </tr>
        <?php
                endwhile;
            endif;
        ?>
  </tbody>
  <tfoot>
    <tr>
        <th colspan='8'></th>
    </tr>
  </tfoot>
</table>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src='assets/js/dataTables.bootstrap5.min.js'></script>
<script src="assets/js/common/list.js"></script>
<script src="assets/js/muzakki/delete.js"></script>