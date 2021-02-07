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
                        ${data['description']}
                    </td>
                    <td>
                        ${data['type']}
                    </td>
                    <td>
                        ${data['grand_total']}
                    </td>
                    <td>
                        ${data['created_date']}
                    </td>
                </tr>    
            `)
        })
    }
    $("#from_date, #to_date, #type").change(function() {
        let from_date = $("#from_date").val();
        let to_date = $("#to_date").val();
        let type = $("#type").val();
        
        if (from_date && to_date) {
            $.ajax({
                url: "actions/reports/generate_pengumpulan.php",
                type: "POST",
                data: { from_date, to_date, type },
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