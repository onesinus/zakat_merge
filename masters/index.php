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
    href='index.php?page=masters&action=form' 
    class="btn btn-primary"
    style='float: left;'
>
    Tambah Kategori ZIS
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
      <th>Kode</th>
      <th>Keterangan</th>
      <th
          style='width: 35%'  
      >
        Aksi
    </th>
    </tr>
  </thead>
  <tbody>
      <?php
            $query = "SELECT * FROM masters";
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
                        <?php echo $row['code'] ?>
                    </td>
                    <td>
                        <?php echo $row['description'] ?>
                    </td>
                    <td>
                        <a href='index.php?page=masters&action=detail&id=<?php echo $row["id"]; ?>' class="btn btn-success">
                            Detail
                        </a>
                        <a href='index.php?page=masters&action=form&id=<?php echo $row["id"]; ?>' class="btn btn-warning">
                            Edit
                        </a>
                        <button 
                            data-id='<?php echo $row["id"]; ?>' 
                            data-description='<?php echo $row["description"]; ?>' 
                            class="btnDelete btn btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
        <?php
                endwhile;
            endif;
        ?>
  </tbody>
  <tfoot>
    <tr>
        <th colspan='6'></th>
    </tr>
  </tfoot>
</table>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src='assets/js/dataTables.bootstrap5.min.js'></script>
<script src="assets/js/common/list.js"></script>
<script src="assets/js/masters/delete.js"></script>