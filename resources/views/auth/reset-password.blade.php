@extends('dashboard.app', ['title' => 'Reset Password'])

@section('body')
<div class="main-wrapper mt-5">
    <div class="account-page">
        <div class="account-box">
            <div class="card-title fw-bold fs-5">Reset Password</div>
            <div>
                <div class="form-group">
                    <label>Email</label>
                    <x-jet-input id="email" class="form-control" type="text" name="email" required/>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <x-jet-input id="new-password" class="form-control" type="password" name="new-password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <x-jet-input id="confirm-password" class="form-control" type="password" name="confirm-password" required/>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" onclick="$(this).resetPassword()">Reset</button>
                    <div class="text-danger mt-3" id='error' name='error'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: false,
    });
    
    let hostname = "{{ url('') }}";

    $.fn.resetPassword = function(){
        let email = $('#email').val();
        let newPassword = $('#new-password').val();
        let confirmPassword = $('#confirm-password').val();
        
        if(newPassword === confirmPassword && ((newPassword.length > 7) && (confirmPassword.length > 7))){
            let password = {
                _token: "{{ csrf_token() }}",
                password: newPassword
            }
            
            $.ajax({
                url: hostname + '/reset-password/' + email,
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
@endsection