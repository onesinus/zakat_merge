$(document).ready(function() {
    $(".penyaluranSection").hide();

    $('#type').change(function() {
        const type = $(this).val();
        
        if (type == "Pengeluaran") {
            $(".penyaluranSection").hide();
            $(".pengeluaranSection").show();
        }else if (type == "Penyaluran") {
            $(".penyaluranSection").show();
            $(".pengeluaranSection").hide();
        }
    });
});

function saveData(datas) {
    $.ajax({
        url: "actions/transactions/save_data.php",
        type: "POST",
        data: datas,
        success: function (response) {
            console.log(response)
            if (response == "ok") {
                window.location.href = 'index.php?page=transactions'
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}