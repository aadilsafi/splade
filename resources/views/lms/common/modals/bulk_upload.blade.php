<div class="modal fade" id="{{$modal_id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{$route}}" class="form" method="post" enctype="multipart/form-data">
                @csrf()
                @isset($hidden_fields)
                    @foreach($hidden_fields as $key => $value)
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                    @endforeach
                @endisset
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Upload .csv File</h1>
                    </div>
                    <p class="text-center">
                        Please upload <code>.csv</code> file with following content.
                        <br>
                        <a href="{{$sample_file}}" target="_blank">Download Sample File</a>
                    </p>

                        <input class="form-control" name="file" type="file" multiple />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
