$(".btnDelete").on('click', function() {
    const id = $(this).attr('data-id');
    const name = $(this).attr('data-name');
    
    if(id) {
        swal({
            title: "Confirm Delete",
            text: `Are you sure you want to delete '${name}'`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = `actions/mustahik/delete_data.php?id=${id}`;
            }
          });
    }
});