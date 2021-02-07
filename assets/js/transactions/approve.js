$(".btnApprove").on('click', function() {
    const id = $(this).attr('data-id');
    
    if(id) {
        swal({
            title: "Confirm Approve",
            text: `Are you sure you want to approve #${id}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willApprove) => {
            if (willApprove) {
                window.location.href = `actions/transactions/approve_data.php?id=${id}`;
            }
          });
    }
});