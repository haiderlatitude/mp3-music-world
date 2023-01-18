<script>
    let hostname = "{{ url('') }}";

    let table = $('#userslist-table');

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

    /*****************************
     * Edit User Information...
     *****************************/

    $.fn.editUser = function (){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let html = "<input type='text' name='name' class='mb-3 form-control' id='name' value='" + name + "' />" +
        "<input type='text' name='email' class='form-control' id='email' value='" + email + "' />";

        Swal.fire({
            title: "Edit User Details",
            html: html,
            showCancelButton: true,
            confirmButtonColor: '#009efb',
            cancelButtonColor: '#f62d51',
            allowOutsideClick: false,

            preConfirm: () => {
                let newName = $('#name').val();
                let newEmail = $('#email').val();                
                let token = {
                    _token: "{{ csrf_token() }}",
                    name: newName,
                    email: newEmail
                }
                
                $.ajax({
                    url: hostname + "/admin/users/" + id,
                    type: 'Put',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(token),

                    success: function(response){
                        let data = JSON.stringify(response);
                        let status = JSON.parse(data);
                        Toast.fire({
                            icon: status.type,
                            title: status.message
                        });
                    },

                    error: function(response){
                        let data = JSON.stringify(response);
                        let status = JSON.parse(data);
                        Toast.fire({
                            icon: status.type,
                            title: status.message
                        });
                    }
                });
            }
                    
            
        });
    }

    /*****************************
     * Delete User Information...
     *****************************/

    $.fn.deleteUser = function(){
        let id = $(this).data('id');
        
        let token = {
            _token: "{{ csrf_token() }}"
        }
        
        Swal.fire({
            title: "Are you sure? You are going to delete this user!",
            text: "This action can't be Undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            preConfirm: () => {
                return $.ajax({
                    url: hostname + '/admin/users/' + id,
                    type: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(token),
                    success: function (response) {
                        let data = JSON.stringify(response);
                        let status = $.parseJSON(data);
                        Toast.fire({
                            icon: status.type,
                            title: status.message,
                        });
                    },
                    error: function (response) {
                        let data = JSON.stringify(response);
                        let status = $.parseJSON(data);
                        Toast.fire({
                            icon: status.type,
                            title: status.message,
                        });
                    },
                });
            }
        });
    }
</script>