$(".btnDelete").on('click', function() {
    const id = $(this).attr('data-id');
    
    if(id) {
        swal({
            title: "Confirm Delete",
            text: `Are you sure you want to delete #${id}`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = `actions/transactions/delete_data.php?id=${id}`;
            }
          });
    }
});