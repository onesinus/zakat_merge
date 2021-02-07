<?php
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $query = "SELECT * FROM masters WHERE id = '$id'";
    $datas = $conn->query($query);    
    $master = $datas->fetch_assoc();
?>
<a href='index.php?page=masters' class="btn btn-primary mb-2 float-right">List Kategori</a>
<h1 class='text-center'>Detail Kategori</h1>
<table class='table'>
    <tr>
        <th>ID</th>
        <td>
            <?php echo $master['id'] ?>
        </td>
    </tr>
    <tr>
        <th>Code</th>
        <td>
            <?php echo $master['code'] ?>
        </td>
    </tr>    
    <tr>
        <th>Keterangan</th>
        <td>
            <?php echo $master['description'] ?>
        </td>
    </tr>        
</table>