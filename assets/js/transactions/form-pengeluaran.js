$(document).ready(function() {
    const validatePengeluranDetail = () => {
        let row = []
        const masters = $('.master');
        
        masters.each(function() {
            const idx = $(this).attr('idx')
            const master = $(`.master[idx=${idx}]`)[0];
            const description = $(`.description_pengeluaran[idx=${idx}]`)[0];
            const balance = $(`.balance[idx=${idx}]`)[0];
            const remaining_balance = $(`.remaining_balance[idx=${idx}]`)[0];
            const amount_pengeluaran = $(`.amount_pengeluaran[idx=${idx}]`)[0];

            if ($(description).val().length > 0) {
                row.push([
                    $(master).val() + $(description).val(),
                    $(balance).val(),
                    $(remaining_balance).val(),
                    $(amount_pengeluaran).val()
                ]);
            }
        });

        if (row.length < 1) {
            swal({
                title: "Please fill all Transaction Detail Data input",
                text: `There is empty input field in Transaction Detail`,
                icon: "error",
                dangerMode: true,
            });
            return false;
        }else {
            return row;
        }
    }

    const getPengeluaran= () => {
        return validatePengeluranDetail();
    }
    
    $(".amount_pengeluaran").change(function() {
        const idx = $(this).attr('idx')

        let balance = $($(`.balance[idx=${idx}]`)[0]).val();
        let amount = $($(`.amount_pengeluaran[idx=${idx}]`)[0]).val();
        if (parseFloat(amount) > parseFloat(balance)) {
            $($(`.amount_pengeluaran[idx=${idx}]`)[0]).val(balance)
            amount = balance
        }

        const remaining_balance = balance - amount;

        $($(`.remaining_balance[idx=${idx}]`)[0]).val(remaining_balance);        
        $("#total_balance").val(remaining_balance);

        const grand_total = $("#grand_total");
        grand_total.val(parseFloat(grand_total.val()) + parseFloat(amount));

    });

    $('#btnSavePengeluaran').click(function() {
        if(getPengeluaran()) {
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
                    const values = {data: [type, grand_total], detail: getPengeluaran()}
                    saveData(values)
                }
            });
        }
    });
})