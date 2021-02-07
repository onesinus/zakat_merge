$(".btnApprove").on('click', function() {
    const id = $(this).attr('data-id');
    const description = $(this).attr('data-description');
    
    if(id) {
        swal({
            title: "Confirm Approve",
            text: `Are you sure you want to approve '${description}'`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willApprove) => {
            if (willApprove) {
                window.location.href = `actions/muzakki/approve_data.php?id=${id}`;
            }
          });
    }
});