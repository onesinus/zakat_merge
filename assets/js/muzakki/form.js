$(document).ready(function() {
    $("#qty, #amount").change(function() {
        const qty = parseInt($("#qty").val()) || 0;
        const amount = parseFloat($("#amount").val()) || 0;
        $("#grand_total").val(qty*amount);
    });

    const validateData = () => {
        let name = $("#name").val();
        let phone_number = $("#phone_number").val();
        let type = $("#type").val();
        let receive_type = $("#receive_type").val();
        let receive_date = $("#receive_date").val();
        let zis = $("#zis").val();
        let description = $("#description").val();
        let qty = $("#qty").val();
        let amount = $("#amount").val();
        let grand_total = $("#grand_total").val();
        let is_validated = $("#is_validated").val();

        let data = [name, phone_number, type, receive_type, receive_date, zis, description, qty, amount, grand_total];

        if(data.includes("")) {
            swal({
                title: "Validation",
                text: `Please fill all required input`,
                icon: "error",
                dangerMode: true,
            });
            return false;
        }    

        data.push(is_validated);

        return data;        
    }

    const getData = () => {
        return validateData();
    }

    const saveData = (datas) => {
        $.ajax({
            url: "actions/muzakki/save_data.php",
            type: "POST",
            data: datas,
            success: function (response) {
                if (response == "ok") {
                    window.location.href = 'index.php?page=muzakki'
                }else if (response == "ok_without_user") {
                    alert("Muzakki has been saved");
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }
    
    $('#btnSaveMuzakki').click(function() {
        if(getData()) {
            swal({
                title: "Confirm Save",
                text: `Are you sure you want to save Muzakki`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willSave) => {
                if (willSave) {
                    const id = $("#id_muzakki").val();
                    const values = {data: getData(), id}
                    saveData(values)
                }
            });
        }
    });
})