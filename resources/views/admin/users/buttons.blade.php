<button type="submit"
        onclick="$(this).deleteUser()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete User"
        data-id="{{ $user->id }}">
    <i class="bi bi-trash"> </i>
</button>