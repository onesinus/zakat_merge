<h3 class="text-center">Laporan Pengumpulan ZIS</h3>

<table class='table'>
    <tr>
        <th>Dari Tanggal</th>
        <td>
            <input class='form-control col-md-8' type="date" id="from_date">
        </td>
        <th>Ke Tanggal</th>
        <td>
            <input class='form-control col-md-8' type="date" id="to_date">
        </td>
        <th>Jenis</th>
        <td>
            <select id="type" class='form-control'>
                <option value="All">All</option>
                <option value="Makanan">Makanan</option>
                <option value="Beras">Beras</option>
                <option value="Uang">Uang</option>
            </select>
        </td>
    </tr>    
</table>
<div style='overflow-y: scroll; height: 425px'>
    <table 
        class="table table-blue"
    >
        <thead>
            <tr>
                <th>ID</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody id="reportData">
            <tr>
                <td colspan="5" class='text-center'>
                    No Data
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script src="assets/js/reports/pengumpulan.js"></script>
