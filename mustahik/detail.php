<?php
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $query = "SELECT * FROM mustahik WHERE id = '$id'";
    $datas = $conn->query($query);    
    $mustahik = $datas->fetch_assoc();
?>
<a href='index.php?page=mustahik' class="btn btn-primary mb-2 float-right">List Master</a>
<h1 class='text-center'>Detail Master</h1>
<table class='table'>
    <tr>
        <th>ID</th>
        <td>
            <?php echo $mustahik['id'] ?>
        </td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>
            <?php echo $mustahik['name'] ?>
        </td>
    </tr>    
    <tr>
        <th>HP/WA</th>
        <td>
            <?php echo $mustahik['phone_number'] ?>
        </td>
    </tr>        
    <tr>
        <th>Alamat</th>
        <td>
            <?php echo $mustahik['address'] ?>
        </td>
    </tr>        
</table>