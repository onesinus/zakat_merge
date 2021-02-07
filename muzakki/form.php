<?php
  require "helpers/get_data_from_db.php";
  require "helpers/date_formatter.php";


  $lastId = getLastId('muzakki');

  $data = array(
    'id'    => $lastId + 1,
    'name'  => '',
    'type'  => '',
    'receive_type'  => '',
    'master_id' => '',
    'description' => '',
    'phone_number'  => '',
    'qty'   => 0,
    'total'   => 0,
    'grand_total' => 0
  );

  $id = isset($_GET['id']) ? $_GET['id'] : 0;
  $title = $id == 0 ? 'Tambah Muzakki' : 'Validasi Muzakki';
  if($id) {
    $query = "SELECT * FROM muzakki WHERE id = '$id'";
    $execute_query = $conn->query($query);    
    $data = $execute_query->fetch_assoc();
  }
?>
<style>
    .table tr th{
        padding: 0.5%;
    }

    .table tr td {
        padding: 0.45%;
    }
</style>
<h2 class='text-center'><?php echo $title; ?></h2>
<table class='table'>
    <tr>
        <th>ID Muzakki</th>
        <td>
            <?php echo $data['id']; ?>
            <input id="id_muzakki" type="hidden" value="<?php echo $id; ?>">
        </td>
        <th>Tanggal</th>
        <td>
            <?php echo formatDate(date('m/d/yy'), 'd/m/yy'); ?>
        </td>
    </tr>
    <tr>
        <th>Nama Muzakki</th>
        <td>
            <input 
                type="text" 
                id="name" 
                class="form-control" 
                autocomplete="off" 
                value="<?php echo $data['name'] ?>"
            />
        </td>
        <th>HP/WA</th>
        <td>
            <input 
                type="text" 
                id="phone_number" 
                class="form-control" 
                autocomplete="off" 
                value="<?php echo $data['phone_number'] ?>"
            />
        </td>
    </tr>
    <tr>
        <th>Jenis ZIS</th>
        <td>
            <select 
                class="form-control" 
                id='type'
            >
                <option value="">-- Pilih jenis ZIS --</option>
                <option 
                    value="Uang" 
                    <?php if($data['type'] == "Uang") { echo 'selected="selected"'; }  ?>
                >
                    Uang
                </option>
                <option
                    value="Beras"
                    <?php if($data['type'] == "Beras") { echo 'selected="selected"'; }  ?>
                >
                    Beras
                </option>
                <option 
                    value="Makanan"
                    <?php if($data['type'] == "Makanan") { echo 'selected="selected"'; }  ?>
                >
                    Makanan
                </option>
            </select>
        </td>
        <th>Jenis Penerimaan ZIS</th>
        <td>
            <select 
                class="form-control" 
                id='receive_type'
            >
                <option value="">-- Pilih jenis Penerimaan ZIS --</option>
                <option 
                    value="Transfer"
                    <?php if($data['receive_type'] == "Transfer") { echo 'selected="selected"'; }  ?>
                >
                    Transfer
                </option>
                <option 
                    value="Cash/Jemput"
                    <?php if($data['receive_type'] == "Cash/Jemput") { echo 'selected="selected"'; }  ?>
                >
                    Cash/Jemput
                </option>
                <option 
                    value="Antar"
                    <?php if($data['receive_type'] == "Antar") { echo 'selected="selected"'; }  ?>
                >
                    Antar
                </option>
            </select>
        </td>        
    </tr>
    <tr>
        <th>Tanggal Penerimaan</th>
        <td>
            <input 
                type="date" 
                id="receive_date" 
                class="form-control" 
                value="<?php echo date('Y-m-d', strtotime($data['receive_date'])) ?>"
            />
        </td>
        <th>ZIS</th>
        <td>
            <select 
                class="form-control" 
                id='zis'
            >
                <option value="">-- Pilih ZIS --</option>
                <?php
                    $zis_query = "SELECT * FROM masters";
                    $zis = $conn->query($zis_query);
                    if ($zis->num_rows > 0):
                        while ($zis_row = $zis->fetch_assoc()):		      				
                ?>
                    <option 
                        value="<?php echo $zis_row['id']; ?>"
                        <?php if ($zis_row['id'] == $data['master_id']) { echo "selected"; } ?>
                    >
                        <?php echo $zis_row['description']; ?>
                    </option>
                <?php
                        endwhile;
                    endif;
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>
            <input 
                type="text" 
                id="description" 
                class="form-control" 
                autocomplete="off" 
                value="<?php echo $data['description']; ?>"
            />
        </td>
        <th></th>
        <td></td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>
            <input 
                type="number" 
                id="qty" 
                class="form-control" 
                min="0"
                value="<?php echo $data['qty']; ?>"
            />
        </td>
        <th>Total</th>
        <td>
            <input 
                type="number" 
                id="amount" 
                class="form-control" 
                min="0"
                value="<?php echo $data['total']; ?>"
            />
        </td>
    </tr>    
    <tr>
        <th>Grand Total</th>
        <td>
            <input 
                type="number" 
                id="grand_total" 
                class="form-control" 
                min="0" 
                disabled
                value="<?php echo $data['grand_total']; ?>"
            />
        </td>
        <th></th>
        <td></td>
    </tr>    
    <?php 
        if($id):
    ?>
    <tr>
        <th>Validasi</th>
        <td>
            <select 
                class="form-control" 
                id='is_validated'
            >
                <option 
                    value="Yes"
                    <?php if ($data['is_validated'] == 1) { echo "selected"; } ?>  
                >
                    Ya
                </option>
                <option 
                    value="No"
                    <?php if ($data['is_validated'] == 0) { echo "selected"; } ?>  
                >
                    Tidak
                </option>
            </select>            
        </td>
        <th>Keterangan</th>
        <td>
            <input type="text" id="note" class="form-control" autocomplete="off" disabled />
        </td>        
    </tr>
    <?php
        endif;
    ?>
    <tr>
        <td colspan="4">
            <button class='btn btn-primary' id='btnSaveMuzakki'><i class="fas fa-save"></i> Simpan Muzakki</button>
            <a href='index.php?page=muzakki' class='btn btn-secondary'><i class="fas fa-arrow-left"></i> Batal</a>
        </td>
    </tr>
</table>
<p style='margin-top: -1%;'>
    <span style='color: red;'>*</span>Note: Rekening Masjid Al Maghfirah BNI Syariah 1234567890 a/n Masjid Al Magfirah  
</p>
<script src="assets/js/muzakki/form.js"></script>