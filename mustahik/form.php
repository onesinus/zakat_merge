<?php
  require "helpers/get_data_from_db.php";

  $lastId = getLastId('mustahik');

  $data = array(
    'id'    => $lastId + 1,
    'name' => '',
    'phone_number' => '',
    'address' => '',
  );

  $id = isset($_GET['id']) ? $_GET['id'] : 0;
  $title = $id == 0 ? 'Add Mustahik' : 'Edit Mustahik';

  if($id) {
    $query = "SELECT * FROM mustahik WHERE id = '$id'";
    $execute_query = $conn->query($query);    
    $data = $execute_query->fetch_assoc();    
  }
?>
<h2 class='text-center'>Tambah Mustahik</h2>
<form action="actions/mustahik/save_data.php" method="post">
    <table class='table'>
        <tr>
            <th>ID</th>
            <td>
                <?php echo $data['id']; ?>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
            </td>        
        </tr>
        <tr>
            <th>Nama</th>
            <td>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control col-md-6" 
                    value="<?php echo $data['name'] ?>"
                    required 
                />
            </td>
        </tr>
        <tr>
            <th>HP/WA</th>
            <td>
                <input 
                    type="text" 
                    name="phone_number" 
                    class="form-control col-md-6"
                    value="<?php echo $data['phone_number'] ?>"
                    required 
                />
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>
                <input 
                    type="text" 
                    name="address" 
                    class="form-control col-md-6"
                    value="<?php echo $data['address'] ?>"
                    required 
                />
            </td>
        </tr>

    </table>
    <button type='submit' class='btn btn-primary'><i class="fas fa-save"></i> Simpan Mustahik</button>
    <a href='index.php?page=mustahik' class='btn btn-secondary'><i class="fas fa-arrow-left"></i> Batal</a>

</form>    
<script src="assets/js/mustahik/form.js"></script>