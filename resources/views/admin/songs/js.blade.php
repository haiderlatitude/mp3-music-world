<script>
    let hostname = "{{ url('') }}";

    let table = $('#songslistadmin-table');

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

    $(document).ready(function (){

        /******************************
         * Filepond setup...
         ******************************/

        let inputElement = $('#song');
        let filePond = FilePond.create(inputElement[0],
            {
                allowFileTypeValidation: true,
                acceptedFileTypes: ['audio/mpeg'],
            });
        let hostname = "{{ url('/') }}";
        FilePond.setOptions({
            server: {
                url: hostname + '/admin/upload',
                headers:{
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }
        });

    });


    /*****************************
     * Edit song functionality...
     *****************************/

    $.fn.editSong = function (){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let artistId = $(this).data('artist-id');
        // console.log(id, name, artistId);

        Swal.fire({
            title: 'Please Wait!',
            showCancelButton: false,
            showConfirmButton: false,
            allowEscapeKey: false,
            allowOutsideClick: false,
            button: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });

        let payload = {
            _token: "{{ csrf_token() }}",
        }

        $.ajax({
            url: hostname + '/' + 'admin/artists/get_artists',
            type: 'Post',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(payload),
            success: function (response) {
                Swal.close();
                let data = JSON.stringify(response);
                let artists = $.parseJSON(data);

                let html = '<select class="form-control" id="pick-artist">';
                artists.forEach(function (artist) {
                    if (artist.id === artistId){
                        html += '<option id="' + artist.id + '" selected>' + artist.name + '</option>'
                    }
                    else {
                        html += '<option id="' + artist.id + '">' + artist.name + '</option>'
                    }
                })
                html += '</select> <br> <input class="form-control" id="song-name" value="' + name + '"/> ';

                Swal.fire({
                    title: 'Edit Song',
                    html: html,

                    preConfirm: (input) => {
                        
                        let artist = $('#pick-artist').find(':selected').attr('id');
                        let name = $('#song-name').val();
                       
                        if (artist && name) {

                            let song = {
                                _token: "{{ csrf_token() }}",
                                artist_id: artist,
                                name: name,
                            }

                            return $.ajax({
                                url: hostname + '/admin/songs/' + id,
                                type: 'PUT',
                                dataType: 'json',
                                contentType: 'application/json',
                                data: JSON.stringify(song),

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
                                        title: 'An error occurred! Try Again'
                                    });
                                }
                            });
                        } else {
                            Swal.showValidationMessage('Please Enter Values');

                        }
                    },
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    confirmButtonColor: '#009efb',
                    cancelButtonColor: '#f62d51',
                    showLoaderOnConfirm: true
                });
            },
            error: function () {
                Toast.fire({
                    icon: 'error',
                    title: 'Error occurred while fetching data'
                });
            }
        })

    }

    /*****************************
     * Delete song functinality
     *****************************/

    $.fn.deleteSong = function(){
        let id = $(this).data('id');

        let songToDelete = {
            _token: "{{ csrf_token() }}"
        }
        
        Swal.fire({
            title: "Are you sure? You are going to delete this song!",
            text: "This action can't be Undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            preConfirm: () => {
                return $.ajax({
                    url: hostname + '/admin/songs/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(songToDelete),
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
                            title: 'Some error occurred!',
                        });
                    },
                });
            }
        });
    }
</script>