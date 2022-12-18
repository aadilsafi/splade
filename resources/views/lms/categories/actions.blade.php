<div class="d-flex justify-content-cetner align-items-center">
    <a href="{{route('category.show',$slug)}}"
        class="btn btn-relief-outline-warning waves-effect waves-float waves-light" style="margin: 5px"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Go To"><i class='bi bi-eye' style="font-size: 1.1rem"
            class="m-10"></i>
    </a>

    <a class="btn btn-relief-outline-warning waves-effect waves-float waves-light" style="margin: 5px"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Category" href="{{ route('category.edit', $id) }}">
        <i class="bi bi-pencil" style="font-size: 1.1rem" class="m-10"></i>
    </a>
    <a class="btn btn-relief-outline-warning waves-effect waves-float waves-light" onclick="deleteByID('{{ route('category.destroys',$id) }}')" href="javascript:void(0);">
        <i class="bi bi-trash" style="font-size: 1.1rem" class="me-50"></i>
    </a>

    <a class="btn btn-relief-outline-warning waves-effect waves-float waves-light" style="margin: 5px"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Move Up"
        onclick='move(this,`up`,{{$position}},{{$id}})'><i class='bi bi-arrow-up' style="font-size: 1.1rem"
            class="m-10"></i>
    </a>
    <a class="btn btn-relief-outline-warning waves-effect waves-float waves-light" style="margin: 5px"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Move Down"
        onclick='move(this,"down",{{$position}},{{$id}})'><i class='bi bi-arrow-down' style="font-size: 1.1rem"
            class="m-10"></i>
    </a>
</div>