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
        let id = $(this).data('id');
        let name = $(this).data('name');

        Swal.fire({
            title: "Edit Artist",
            html: "<input type='text' id='artist-name' class='form-control' placeholder='Enter Artist Name' value='" + name + "'/>",

            preConfirm: (input) => {
                let artistName = $('#artist-name').val();
                // return console.log(name);

                if(artistName){
                    let artist = {
                        _token: '{{ csrf_token() }}',
                        name: artistName,
                    }

                    return $.ajax({
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




    /***************************************************
     *
     * Delete Faculty Functionality...
     *
     ***************************************************/

    $.fn.deleteArtist = function () {
        let id = $(this).data('id');
        let artist = {
            _token: "{{ csrf_token() }}",
        }
        Swal.fire({
            title: "Are you sure you want to delete?",
            text: "Once deleted, you will not be able to recover this Artist!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {

                /***************************************************
                 *
                 * Send Delete AJAX request to backend...
                 *
                 ***************************************************/

                return $.ajax({
                    url: hostname + '/admin/artists/' + id,
                    type: 'DELETE',
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
                            title: 'An error occurred!'
                        });
                    },
                });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        })
    }

</script>
