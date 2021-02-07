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
    href='index.php?page=transactions&action=form' 
    class="btn btn-primary"
    style='float: left;'
>
    Tambah Transaksi
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
      <th>Jenis</th>
      <th>Total</th>
      <th>Status</th>
      <th>Dibuat</th>
      <th>
        Aksi
      </th>
    </tr>
  </thead>
  <tbody>
      <?php
            $query = "
                SELECT
                  trans.id,
                  trans.type as type,
                  trans.status as status,
                  trans.created_date as created_date,
                  transD.id as idTransDetail,
                  transD.amount as amount,
                  transD.type as typeD
                FROM transactions as trans
                LEFT JOIN transaction_details as transD on trans.id = transD.transaction_id
                WHERE 
                    trans.is_deleted = 0 
                AND transD.amount > 0
            ";

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
                    <?php echo $row['type']; ?>
                </td>
                <td>
                    <?php 
                        $params = $row['typeD'];
                        $valParams = '';
                        
                        switch ($params) {
                            case 'Uang': 
                                $valParams = 'Rp';
                                break;
                            case 'Makanan':
                                $valParams = 'Porsi';
                                break;
                            default :
                                $valParams = 'Kg';
                        }

                        $param1 = $row['typeD'] == 'Uang' ? 'Rp ' : '';
                        $param2 = $row['typeD'] != 'Uang' ? ' '. $valParams . '' : '';
                        
                        echo $param1 . $row['amount'] . $param2; 
                    ?>
                </td>
                <td>
                    <?php echo $row['status'] ?>
                </td>
                <td>
                    <?php echo $row['created_date'] ?>
                </td>
                    
                <td>
                    <a href='index.php?page=transactions&action=detail&id=<?php echo $row["id"]; ?>&idTransDetail=<?php echo $row["idTransDetail"]; ?>' class="btn btn-success">
                        Detail
                    </a>

                    <?php
                        if($row['status'] == 'Open'):
                    ?>
                        <!-- <a href='index.php?page=transactions&action=form&id=<?php echo $row["id"]; ?>' class="btn btn-warning">
                            Edit
                        </a> -->
                        <button 
                            data-id='<?php echo $row["id"]; ?>' data-amount='<?php echo $row['amount'] ?>' data-idDetails = '<?php echo $row["idTransDetail"]; ?>' 
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
        <th colspan='6'></th>
    </tr>
  </tfoot>
</table>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src='assets/js/dataTables.bootstrap5.min.js'></script>
<script src="assets/js/common/list.js"></script>
<script src="assets/js/transactions/delete.js"></script>