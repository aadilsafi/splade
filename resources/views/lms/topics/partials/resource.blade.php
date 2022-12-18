<div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center">
                @if($content->type->id === \App\Utils\Common\ResourceTypes::FILE)
                    <img class="me-1" src="../../../lms/app-assets/images/icons/doc.png" alt="data.json" height="23" />
                @else
                    <img class="me-1" src="../../../lms/app-assets/images/icons/jpg.png" alt="data.json" height="23" />
                @endif
                <a href="{{$content->path}}">Click To Download</a>
            </div>
        </div>
    </div>
</div>
