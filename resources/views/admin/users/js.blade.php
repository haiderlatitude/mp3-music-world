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
        // toast.addEventListener('mouseenter', Swal.stopTimer)
        // toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$.ajax({
            url: hostname + '/' + 'admin/users/get_users',
            type: 'Get',
            dataType: 'json',
            contentType: 'application/json',
})

error: function () {
                Toast.fire({
                    icon: 'error',
                    title: 'Some error occurred!'
                });
            }

</script>