<button type="submit"
        onclick="$(this).editCategory()"
        class="btn btn-outline-primary rounded-circle btn-sm d-inline"
        data-toggle="tooltip" data-placement="top" title="Edit Category"
        data-id="{{ $category->id }}"
        data-name="{{ $category->name }}">
    <i class="bi bi-pen"> </i>
</button>

<button type="submit"
        onclick="$(this).deleteCategory()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete Category"
        data-id="{{ $category->id }}">
    <i class="bi bi-trash"> </i>
</button>