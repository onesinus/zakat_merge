<?php
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $query = "
        SELECT 
            *
        FROM transactions
        WHERE 
            id = '$id'
    ";

    $datas = $conn->query($query) or die(mysqli_error($conn));
    $transaction = $datas->fetch_assoc();

    $query2 = "
        SELECT * FROM transaction_details
        WHERE transaction_id = '$id'
    ";

    $details = $conn->query($query2) or die(mysqli_error($conn));
?>
<?php
    if($transaction['status'] == 'Open'):
?>
<button 
    data-id='<?php echo $transaction["id"]; ?>' 
    class="btnApprove btn btn-success float-right"
>
    Approve
</button>
<?php
    endif;
?>
<a href='index.php?page=transactions' class="btn btn-primary mr-1 float-right">List Transaction</a>
<h1 class='text-center'>Detail Transaction</h1>
<table class='table'>
    <tr>
        <th>ID ZIS</th>
        <td>
            <?php echo $transaction['id'] ?>
        </td>
        <th>Type</th>
        <td>
            <?php echo $transaction['type'] ?>
        </td>
    </tr>
    <tr>
        <th>Created Date</th>
        <td>
            <?php echo $transaction['created_date'] ?>            
        </td>
        <th>Approved Date</th>
        <td>
            <?php echo $transaction['approved_date'] ?>
        </td>
    </tr>
</table>
<?php
    if ($transaction['type'] == 'Pengeluaran'):
?>
    <table 
        class="table table-blue"
    >
        <thead>
            <tr>
                <th>Description</th>
                <th>Balance</th>
                <th>Remaining Balance</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($detail = $details->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $detail['note']; ?></td>
                    <td><?php echo $detail['balance']; ?></td>
                    <td><?php echo $detail['remaining_balance']; ?></td>
                    <td><?php echo $detail['amount']; ?></td>
                </tr>

            <?php
                endwhile;
            ?>
        </tbody>
    </table>
<?php
    else:
?>
    <table 
        class="table table-blue"
    >
        <thead>
            <tr>
                <th>Mustahik</th>
                <th>Balance</th>
                <th>Remaining Balance</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($detail = $details->fetch_assoc()):
                    if (!empty($detail['note'])):
            ?>
                <tr>
                    <td><?php echo $detail['note']; ?></td>
                    <td><?php echo $detail['balance']; ?></td>
                    <td><?php echo $detail['remaining_balance']; ?></td>
                    <td><?php echo $detail['amount']; ?></td>
                </tr>

            <?php
                    endif;
                endwhile;
            ?>
        </tbody>
    </table>
<?php
    endif;
?>
<script src="assets/js/transactions/approve.js"></script>