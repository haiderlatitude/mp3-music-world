<button type="submit"
        onclick="$(this).editUser()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Edit User info"
        data-id="{{ $user->id }}"
        data-name="{{ $user->name }}"
        data-email=" {{ $user->email }}">
    <i class="bi bi-pen"> </i>
</button>

<button type="submit"
        onclick="$(this).deleteUser()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete User"
        data-id="{{ $user->id }}">
    <i class="bi bi-trash"> </i>
</button>