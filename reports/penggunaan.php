<h3 class="text-center">Laporan Penggunaan ZIS</h3>

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
        <th>Status</th>
        <td>
            <select id="status" class='form-control'>
                <option value="All">All</option>
                <option value="Open">Open</option>
                <option value="Closed">Closed</option>
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
                <th>Description</th>
                <th>Total</th>
                <th>Status</th>
                <th>Created Date</th>
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
<script src="assets/js/reports/penggunaan.js"></script>
