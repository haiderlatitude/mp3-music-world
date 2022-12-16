<script>
    let hostname = "{{ url('') }}";
    let table = $('#playlist-table');

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


    $.fn.addPlaylist = function() {
        Swal.fire({
            title: 'Add Playlist',
            html: '<input type="text" id="playlist" class="form-control" name="playlist" placeholder="Enter Playlist Name">',
            showCancelButton: true,
            confirmButtonText: "Add",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            preConfirm: (input)=>{
                let name = $('#playlist').val();

                if(name){
                    let playlist = {
                        _token: '{{ csrf_token() }}',
                        name: name,
                    }
                    
                    return $.ajax({
                        url: hostname + "/playlist",
                        type: "POST",
                        dataType: "json",
                        contentType: "application/json",
                        data: JSON.stringify(playlist),

                        success: function (response) {
                                    let data = JSON.stringify(response);
                                    let status = $.parseJSON(data);
                                    Toast.fire({
                                        icon: status.type,
                                        title: status.message,
                                    });
                                },
                        error: function (response) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'An error occurred!'
                                    });
                                }
                    });

                }
                else{
                    Swal.showValidationMessage('Please Enter Values.');
                }
            }
        });
    }

    /*
     * Edit Playlist Name
     */
    $.fn.editPlaylist = function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        
        Swal.fire({
            title: 'Edit Playlist',
            html: '<input type="text" class="form-control" id="playlist-name" name="playlist-name" value="' + name + '"/>',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonText: 'Update',
            confirmButtonColor: '#009efb',
            cancelButtonColor: '#f62d51',

            preConfirm: (input) => {
                let new_name = $('#playlist-name').val();
                let token = {
                    _token: '{{ csrf_token() }}',
                    name: new_name
                }
                if(new_name){
                    $.ajax({
                        url: hostname + "/playlist/" + id,
                        type: "PUT",
                        dataType: "json",
                        contentType: "application/json",
                        data: JSON.stringify(token),

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
                else Swal.showValidationMessage('Please enter a name');
            }
        });
    }

    /*
     * Delete Playlist
     */
    $.fn.deletePlaylist = function(){
        let id = $(this).data('id');

        Swal.fire({
            title: "Delete Playlist",
            text: "Are you sure, you want to delete the playlist?",
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonColor: '#009efb',
            confirmButtonColor: '#f62d51',
            confirmButtonText: "Delete",

            preConfirm: (input) => {
                let token = {
                    _token: "{{ csrf_token() }}",
                    id: id
                }

                $.ajax({
                    url: hostname + "/playlist/" + id,
                    type: "DELETE",
                    dataType: 'json',
                    contentType: "application/json",
                    data: JSON.stringify(token),

                    success: function(response){
                        Toast.fire({
                            icon: 'success',
                            title: 'Playlist has been deleted'
                        });
                    },

                    error: function(response){
                        Toast.fire({
                            icon: 'error',
                            title: 'An error occurred!'
                        });
                    }
                });
            }
        });
    }
</script>