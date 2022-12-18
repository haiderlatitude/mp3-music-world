<script>
    let hostname = "{{ url('') }}";

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
    timerProgressBar: false,
});

$.fn.editProfile = function(){
    let id = {{auth()->id()}};
    let name = $('#name').val();
    let username = $('#username').val();
    let email = $('#email').val();
    
    let user = {
        _token: "{{ csrf_token() }}",
        name: name,
        username: username,
        email: email
    }

    $.ajax({
        url: hostname + "/update_profile/" + id,
        type: "PUT",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(user),

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

$.fn.editPassword = function(){
    let newPassword = $('#new-password').val();
    let confirmPassword = $('#confirm-password').val();
    
    if(newPassword === confirmPassword && ((newPassword.length > 7) && (confirmPassword.length > 7))){
        let password = {
            _token: "{{ csrf_token() }}",
            password: newPassword
        }
        
        $.ajax({
            url: hostname + '/update_password/' + {{auth()->id()}},
            type: 'put',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(password),

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
    else{
        return $('#error').text('Make sure password matches and is 8 charaters long!');
    }
}
</script>