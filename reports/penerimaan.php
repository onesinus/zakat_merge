<h3 class="text-center">Laporan Penerima ZIS</h3>

<table class='table'>
    <tr>
        <th>From Date</th>
        <td>
            <input class='form-control col-md-8' type="date" id="from_date">
        </td>
        <th>To Date</th>
        <td>
            <input class='form-control col-md-8' type="date" id="to_date">
        </td>
    </tr>    
</table>
<table 
    class="table table-blue"
>
    <thead>
        <tr>
            <th>ID</th>
            <th>Description / Mustahik</th>
            <th>Type</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Status</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody id="reportData">
        <tr>
            <td colspan="6" class='text-center'>
                No Data
            </td>
        </tr>
    </tbody>
</table>
<script src="assets/js/reports/penerimaan.js"></script>
