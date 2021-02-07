<?php
  require "helpers/get_data_from_db.php";

  $lastId = getLastId('transactions');

  $data = array(
    'id'    => $lastId + 1,
    'doc_num' => '',
    'total' => 0,
    'description' => ''
  );

  $id = isset($_GET['id']) ? $_GET['id'] : 0;
  $title = $id == 0 ? 'Tambah Transaksi' : 'Edit Transaksi';

  $get_balance = "
      SELECT 
        COALESCE(SUM(grand_total), 0) - COALESCE((SELECT SUM(amount) FROM transaction_details WHERE type = 'Uang' AND is_deleted = 0), 0) AS total_balance 
      FROM `muzakki` 
      WHERE 
        status = 'Closed'
        AND
        type = 'Uang'
  ";

  $execute_get_balance = $conn->query($get_balance);
  $balance = $execute_get_balance->fetch_assoc();

  $get_makanan = "
      SELECT 
        COALESCE(SUM(grand_total), 0) - COALESCE((SELECT SUM(amount) FROM transaction_details WHERE type = 'Makanan'), 0) AS total_makanan 
      FROM `muzakki` 
      WHERE 
        status = 'Closed'
        AND
        type = 'Makanan'
  ";

  $execute_get_makanan = $conn->query($get_makanan);
  $makanan = $execute_get_makanan->fetch_assoc();

  $get_beras = "
    SELECT 
        COALESCE(SUM(grand_total), 0) - COALESCE((SELECT SUM(amount) FROM transaction_details WHERE type = 'Beras'), 0) AS total_beras 
    FROM `muzakki` 
    WHERE 
        status = 'Closed'
        AND
        type = 'Beras'
    ";

    $execute_get_beras = $conn->query($get_beras);
    $beras = $execute_get_beras->fetch_assoc();

  if($id) {
    $query = "SELECT * FROM transactions WHERE id = '$id'";
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
<table class='table'>
    <input id="grand_total" class="d-none" value="0">
    <input id="total_balance" class='d-none' value="<?php echo $balance['total_balance'] ?>">
    <input id="total_makanan" class='d-none' value="<?php echo $makanan['total_makanan'] ?>">
    <input id="total_beras" class='d-none' value="<?php echo $beras['total_beras'] ?>">

    <tr>
        <th>ID ZIS</th>
        <td>
            <?php echo $data['id']; ?>
        </td>
        <th>Jenis</th>
        <td>
            <select 
                class="form-control" 
                id='type'
            >
                <option value="Pengeluaran">Pengeluaran</option>
                <option value="Penyaluran">Penyaluran</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>
            <input type="text" id="created_date" class="form-control" disabled />
        </td>
        <th>Tanggal Validasi</th>
        <td>
            <input type="text" id="approved_date" class="form-control col-md-8" disabled />
        </td>
    </tr>
</table>

<!-- Penyaluran Table -->
<table 
    class="table table-blue penyaluranSection"
    style='margin-top: -1%'
>
  <thead>
    <tr>
      <th>Jenis</th>
      <th>Pilih Mustahik</th>
      <th>Saldo</th>
      <th>Sisa Saldo</th>
      <th>Total Sesuai Jenis</th>
      <th>Total Mustahik</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
        $types = ["Makanan", "Beras", "Uang"];
        $balances = [$makanan['total_makanan'], $beras['total_beras'], $balance['total_balance']];
        foreach($types as $idx => $type):
    ?>
    <tr>
        <td>
            <?php echo $type; ?>
        </td>
        <td>
            <select 
                class="form-control ids"
                id="Mustahik<?php echo $idx; ?>"
                multiple="multiple"
                style="width: 100%"
                idx="<?php echo $idx; ?>"
            >
                <?php
                    $mustahik_query = "SELECT * FROM mustahik";
                    $mustahik = $conn->query($mustahik_query);
                    if ($mustahik->num_rows > 0):
                        while ($mustahik_row = $mustahik->fetch_assoc()):		      				
                ?>
                    <option 
                        value="<?php echo $mustahik_row['name']; ?>"
                    >
                        <?php echo $mustahik_row['name']; ?>
                    </option>
                <?php
                        endwhile;
                    endif;
                ?>
            </select>
            <input class="chkall" idx="<?php echo $idx; ?>" type="checkbox"> Select All
        </td>
        <td>
            <input 
                type="number" 
                class="form-control balances"
                placeholder="0"
                min="0"
                value="<?php echo $balances[$idx]; ?>"
                disabled
                id="balance<?php echo $idx; ?>"
                idx="<?php echo $idx; ?>"
            />
        </td>
        <td>
            <input 
                type="number" 
                class="form-control remaining_balances"
                placeholder="0"
                min="0"
                disabled
                id="remaining_balance<?php echo $idx; ?>"
                idx="<?php echo $idx; ?>"
            />
        </td>
        <td>
            <input 
                type="number" 
                class="form-control totals"
                placeholder="0"
                id="total<?php echo $idx; ?>"
                idx="<?php echo $idx; ?>"
            />            
        </td>
        <td>
            <input 
                type="number" 
                class="form-control total_mustahiks"
                placeholder="0"
                disabled
                id="TotalMustahik<?php echo $idx; ?>"
                idx="<?php echo $idx; ?>"
            />
        </td>
    </tr>
    <?php
        endforeach;
    ?>
    <tr>
        <th colspan="6"> </th>
    </tr>
  </tbody>
</table>
<div class="penyaluranSection">
    <button class='btn btn-primary' id='btnSavePenyaluran'><i class="fas fa-save"></i> Simpan Transaksi</button>
</div>
<!-- Akhir Penyaluran Table -->

<!-- Jika Pengeluaran -->
<table 
    class="table table-blue pengeluaranSection"
    style='margin-top: -1%;'
>
  <thead>
    <tr>
      <th>Kategori ZIS</th>
      <th>Keterangan</th>
      <th>Saldo</th>
      <th>Sisa Saldo</th>
      <th>Jumlah</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php
        $get_master = "SELECT * FROM masters";
    
        $masters = $conn->query($get_master) or die(mysqli_error($conn));
        $idx_pengeluaran = 0;
        while($master = $masters->fetch_assoc()):
            $master_id = $master["id"];
            $balance_per_zis_query = "
                SELECT 
                    COALESCE(SUM(grand_total), 0) - COALESCE((SELECT SUM(amount) FROM transaction_details WHERE type = 'Uang' AND is_deleted = 0), 0) AS total_balance 
                FROM `muzakki` 
                WHERE 
                    status = 'Closed'
                    AND
                    type = 'Uang'
                    AND
                    master_id = '$master_id'
            ";

            $execute_balance_per_zis_query = $conn->query($balance_per_zis_query);
            $balance_per_zis = $execute_balance_per_zis_query->fetch_assoc();            
            if ($balance_per_zis["total_balance"] < 0) {
                $balance_per_zis["total_balance"] = 0;
            }
    ?>
    <tr>
        <td>
            <?php echo $master['description']; ?>
            <input 
                type="hidden" 
                class="form-control master"
                id='master'
                idx="<?php echo $idx_pengeluaran; ?>"
                value="<?php echo $master['description']; ?>"
            />
        </td>
        <td>
            <input 
                type="text" 
                class="form-control description_pengeluaran"
                id='description_pengeluaran'
                idx="<?php echo $idx_pengeluaran; ?>"
            />
        </td>
        <td>
            <input 
                type="number" 
                class="form-control text-right balance" 
                id='balance'
                placeholder="0"
                min="0"
                value="<?php echo $balance_per_zis['total_balance']; ?>"
                idx="<?php echo $idx_pengeluaran; ?>"
                disabled
            />
        </td>
        <td>
            <input 
                type="number" 
                class="form-control text-right remaining_balance"
                id='remaining_balance'
                idx="<?php echo $idx_pengeluaran; ?>"
                placeholder="0"
                min="0"
                disabled
            />
        </td>
        <td>
            <input 
                type="number" 
                class="form-control text-right amount_pengeluaran"
                id='amount_pengeluaran'
                placeholder="0"
                idx="<?php echo $idx_pengeluaran; ?>"
                max="<?php echo $balance_per_zis['total_balance']; ?>"
                min=0
            />            
        </td>
        <td>
            <!-- <button class='btn btn-success' id='btnSaveRow'><i class="fas fa-check-circle"></i></button> -->
            <!-- <button class='btn btn-danger' id='btnDeleteRow'><i class="fas fa-trash"></i></button> -->
            <!-- <button class='btn btn-primary' id='btnSavePengeluaran'><i class="fas fa-save"></i> Save Transaction</button> -->
        </td>
    </tr>
    <?php
        $idx_pengeluaran++;
        endwhile;
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5"></td>
        </tr>
  </tfoot>
</table>
<div 
    style='margin-top: -1%; overflow-y: auto; height: 230px;' 
    class='pengeluaranSection'
>
    <button class='btn btn-primary' id='btnSavePengeluaran'><i class="fas fa-save"></i> Simpan Transaksi</button>

    <!-- <table class='table table-hover table-bordered'>
      <tbody style='cursor: pointer;' id='pengeluaranDetail'>
      </tbody>
      <tfoot>
        <tr>
            <td colspan="3" class="text-right">Total</td>
            <td style='width: 25%' class='text-right'>
                <input 
                    type="number" 
                    id='grand_total'
                    class='d-none'
                    value="<?php echo $data['total'] ?>"
                />
                <span id='display_total'>
                    <?php echo 'Rp. ' . $data['total'] ?>
                </span>            
            </td>
        </tr>
      </tfoot>
    </table> -->
</div>
<!-- Akhir Pengeluaran -->
<script src="assets/js/transactions/form.js"></script>
<script src="assets/js/transactions/form-pengeluaran.js"></script>
<script src="assets/js/transactions/form-penyaluran.js"></script>