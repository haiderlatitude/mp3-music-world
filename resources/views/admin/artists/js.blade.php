<script>
    let hostname = "{{ url('') }}";
    let table = $('#artist-table');

    /***************************************************
    *
    * Toast setup...
    *
    ***************************************************/
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            table.DataTable().ajax.reload();
        }
    })

    $.fn.editArtist = function (){
        let artist = $(this).data();

        Swal.fire({
            title: "Edit Artist",
            html: "<input type='text' id='artist-name' class='form-control' placeholder='Enter Artist Name'/>",
            
            preConfirm: (input) => {
                let artistName = $('#artist-name').val();
                // return console.log(name);
               
                if(artistName){
                    artist.id = $(this).data('id');
                    artist.name = artistName;

                    // return console.log(artist);
                    return $.ajax({
                        _token: "{{ csrf_token() }}",
                        url: hostname + "/admin/artists/" + id,
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(artist),

                        success: function (response) {
                                    let data = JSON.stringify(response);
                                    let status = $.parseJSON(data);
                                    Toast.fire({
                                        icon: status.type,
                                        title: status.message,
                                    });
                                },
                        error: function () {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'An error occurred! Try Again.'
                                    });
                                }

                    });
                }

            },
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonText: 'Update',
            showLoaderOnConfirm: true
        });
    }
</script>