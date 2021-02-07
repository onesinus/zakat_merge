$(document).ready(function() {
    $(".totals").change(function() {
        const idx = $(this).attr('idx');

        const total = $("#total"+idx);
        const balance = $("#balance"+idx);
        const remaining_balance = $("#remaining_balance"+idx);

        if (parseFloat(total.val()) > parseFloat(balance.val())) {
            total.val(balance.val());
        }

        remaining_balance.val(parseFloat(balance.val()) - parseFloat(total.val()));

        if (idx == 2) { // Jika Uang
            $("#grand_total").val(parseFloat(total.val()));
        }
    });

    $("#btnSavePenyaluran").click(function() {
        swal({
            title: "Confirm Save",
            text: `Are you sure you want to save Transaction`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willSave) => {
            if (willSave) {
                const type = $("#type").val();
                const grand_total = $("#grand_total").val();
                const detail = [
                    [],
                    [],
                    []
                ];
                for (let i = 0; i < 3; i++) {
                    let mustahik = $('select[idx='+i+']').val();
                    mustahik = mustahik.join(", ")

                    let balance = $('#balance'+i).val();
                    let remaining_balance = $('#remaining_balance'+i).val();
                    let total = $('#total'+i).val();
                    let total_mustahik = $('#TotalMustahik'+i).val();

                    detail[i].push(mustahik, balance, remaining_balance, total, total_mustahik);
                }

                detail[0].push("Makanan");
                detail[1].push("Beras");
                detail[2].push("Uang");

                const values = {data: [type, grand_total], detail}       
                saveData(values)
            }
        });
    });
});