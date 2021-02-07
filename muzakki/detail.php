<?php
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $query = "
        SELECT * FROM muzakki WHERE id = '$id'
    ";
    $datas = $conn->query($query);    
    $muzakki = $datas->fetch_assoc();
?>
<?php
    if($muzakki['status'] == 'Open'):
?>
    <!-- <button 
        data-id='<?php echo $muzakki["id"]; ?>' 
        data-description='<?php echo $muzakki["description"]; ?>' 
        class="btnApprove btn btn-success float-right"
    >
    Validate
    </button> -->
<?php
    endif;
?>
<a href='index.php?page=muzakki' class="btn btn-primary mr-1 float-right">List Muzzaki</a>
<h1 class='text-center'>Detail muzzaki</h1>
<table class='table'>
    <tr>
        <th>ID Muzzaki</th>
        <td>
            <?php echo $muzakki['id'] ?>
        </td>
        <th>Nama</th>
        <td>
            <?php echo $muzakki['name'] ?>
        </td>
    </tr>
    <tr>
        <th>Keterangan</th>
        <td>
            <?php echo $muzakki['description'] ?>            
        </td>
        <th>HP/WA</th>
        <td>
            <?php echo $muzakki['phone_number'] ?>
        </td>
    </tr>
    <tr>
        <th>Jenis ZIS</th>
        <td>
            <?php echo $muzakki['type'] ?>            
        </td>
        <th>Jenis Penerimaan ZIS</th>
        <td>
            <?php echo $muzakki['receive_type'] ?>
        </td>
    </tr>
    <tr>
        <th>ZIS</th>
        <td>
            <?php echo $muzakki['description'] ?>            
        </td>
        <th>Keterangan</th>
        <td>
            <?php echo $muzakki['description'] ?>
        </td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>
            <?php echo $muzakki['qty'] ?>            
        </td>
        <th>Total</th>
        <td>
            <?php echo $muzakki['total'] ?>
        </td>
    </tr>    
    <tr>
        <th>Grand Total</th>
        <td>
            <?php echo $muzakki['grand_total'] ?>            
        </td>
        <th>Status</th>
        <td>
            <?php echo $muzakki['status'] ?>
        </td>
    </tr>
    <tr>
        <th>Validated?</th>
        <td>
            <?php echo ($muzakki['is_validated'] == 0 ? "No" : "Yes") ?>
        </td>
        <th>Note</th>
        <td>
            
        </td>
    </tr>       
</table>
<script src="assets/js/muzakki/approve.js"></script>