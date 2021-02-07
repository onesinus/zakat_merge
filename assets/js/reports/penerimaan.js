$(document).ready(function() {
    const fillReportData = (datas) => {
        $("#reportData").empty();
        datas.map(data => {
            $("#reportData").append(`
                <tr>
                    <td>
                        ${data['id']}
                    </td>
                    <td>
                        ${data['note']}
                    </td>
                    <td>
                        ${data['type']} - ${data['type_detail']}
                    </td>
                    <td>
                        ${data['total_unit']}
                    </td>
                    <td>
                        ${data['amount']}
                    </td>
                    <td>
                        ${data['status']}
                    </td>
                    <td>
                        ${data['created_date']}
                    </td>
                </tr>    
            `)
        })
    }
    $("#from_date, #to_date, #status").change(function() {
        let from_date = $("#from_date").val();
        let to_date = $("#to_date").val();
        let status = $("#status").val();
        
        if (from_date && to_date) {
            $.ajax({
                url: "actions/reports/generate_penerimaan.php",
                type: "POST",
                data: { from_date, to_date, status },
                success: function (response) {
                    if (response) {
                        response = JSON.parse(response);
                        fillReportData(response)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        }

    });
});