$(".btnDelete").on('click', function() {
    const id = $(this).attr('data-id');
    const description = $(this).attr('data-description');
    
    if(id) {
        swal({
            title: "Confirm Delete",
            text: `Are you sure you want to delete '${description}'`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = `actions/masters/delete_data.php?id=${id}`;
            }
          });
    }
});