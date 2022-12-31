<script>
    let hostname = "{{ url('') }}";
    let table = $('#category-table');

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

    /*
     * Add new Category
     */
    $.fn.addCategory = function() {
        let hostname = "{{ url('') }}";

        Swal.fire({
            title: 'Add Category',
            html: '<input type="text" class="form-control" id="add-category" name="add-category" placeholder="Enter the Category name" autofocus/>',
            showCancelButton: true,
            confirmButtonText: 'Add',
            confirmButtonColor: '#009efb',
            cancelButtonColor: '#f62d51',

            preConfirm: (input) => {
                let category = $('#add-category').val();
                let token = {
                    _token: '{{ csrf_token() }}',
                    name: category
                }

                if(category){
                    $.ajax({
                        url: hostname + "/admin/categories",
                        type: "Post",
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
                else Swal.showValidationMessage('Please enter a Category name');
            }
        });
    }

    /*
     * Edit Category Name
     */
    $.fn.editCategory = function(){
        let id = $(this).data('id');
        let name = $(this).data('name');
        
        Swal.fire({
            title: 'Edit Category',
            html: '<input type="text" class="form-control" id="category-name" name="category-name" value="' + name + '" autofocus/>',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonText: 'Update',
            confirmButtonColor: '#009efb',
            cancelButtonColor: '#f62d51',

            preConfirm: (input) => {
                let new_name = $('#category-name').val();
                let token = {
                    _token: '{{ csrf_token() }}',
                    name: new_name
                }
                if(new_name){
                    $.ajax({
                        url: hostname + "/admin/categories/" + id,
                        type: "PUT",
                        dataType: "json",
                        contentType: "application/json",
                        data: JSON.stringify(token),

                        success: function (response) {
                                        let data = JSON.stringify(response);
                                        let status = JSON.parse(data);
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
                                    }
                    });
                }
                else Swal.showValidationMessage('Please enter a name');
            }
        });
    }

    /*
     * Delete Category
     */
    $.fn.deleteCategory = function(){
        let id = $(this).data('id');

        Swal.fire({
            title: "Delete Category",
            text: "Are you sure, you want to delete this Category?",
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
                    url: hostname + "/admin/categories/" + id,
                    type: "DELETE",
                    dataType: 'json',
                    contentType: "application/json",
                    data: JSON.stringify(token),

                    success: function(response){
                                    let data = JSON.stringify(response);
                                    let status = $.parseJSON(data);
                                    Toast.fire({
                                        icon: status.type,
                                        title: status.message,
                                    });
                    },

                    error: function(response){
                                    let data = JSON.stringify(response);
                                    let status = $.parseJSON(data);
                                    Toast.fire({
                                        icon: status.type,
                                        title: status.message,
                                    });
                    }
                });
            }
        });
    }
</script> 