<?php
  require "helpers/get_data_from_db.php";

  $lastId = getLastId('masters');

  $data = array(
    'id'    => $lastId + 1,
    'code' => '',
    'description' => '',
  );

  $id = isset($_GET['id']) ? $_GET['id'] : 0;
  $title = $id == 0 ? 'Tambah Kategori' : 'Ubah Kategori';

  if($id) {
    $query = "SELECT * FROM masters WHERE id = '$id'";
    $execute_query = $conn->query($query);    
    $data = $execute_query->fetch_assoc();    
  }
?>
<h2 class='text-center'>Form Kategori</h2>
<form action="actions/masters/save_data.php" method="post">
    <table class='table'>
        <tr>
            <th>ID</th>
            <td>
                <?php echo $data['id']; ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </td>        
        </tr>
        <tr>
            <th>Code</th>
            <td>
                <input 
                    type="text" 
                    name="code" 
                    class="form-control col-md-6" 
                    value="<?php echo $data['code'] ?>"
                    required 
                />
            </td>
        </tr>    
        <tr>
            <th>Keterangan</th>
            <td>
                <input 
                    type="text" 
                    name="description" 
                    class="form-control col-md-6"
                    value="<?php echo $data['description'] ?>"
                    required 
                />
            </td>
        </tr>    
        <tr>
            <td colspan="2">
                <button type='submit' class='btn btn-primary'><i class="fas fa-save"></i> Simpan Kateori</button>
                <a href='index.php?page=masters' class='btn btn-secondary'><i class="fas fa-arrow-left"></i> Batal</a>
            </td>
        </tr>
    </table>
</form>    
<script src="assets/js/masters/form.js"></script>