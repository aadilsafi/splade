<div class="container">
    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center">
                    <h3 class="scorm-text" onclick="clicked('{{route('scorm.play',$content->uuid)}}')">Click To Open Scorm</h3>             
            </div>
        </div>
    </div>
</div>
@section('custom-js')
<script>
    function clicked(url){
        $('.scorm-text').text('Scorm is Opened');
        popup(url)
    }

    let win =undefined;
            $(document).ready(function(){
                var timer = setInterval(function() {
        if(win && win.closed) {
            clearInterval(timer);
            $('.scorm-text').html('Click To Open Scorm');
        }
    }, 1000);
            });
function popup (url) {      
    $('.scorm-text').html('Scorm is Opened');
    if(win==undefined){
        win = window.open(url, "Fenster",    "width=1200,height=600,resizable=yes,menubar=no,toolbar=no,status=no,location=no,directories=no"); 
        $(win.document).prop('title', 'your new title');
    }else if(win.closed){
        win = window.open(url, "Fenster",    "width=1200,height=600,resizable=yes,menubar=no,toolbar=no,status=no,location=no,directories=no"); 
    }
    else{
        $(win.document).prop('title', 'your new title');
        win.focus();
    }
}

</script>
@endsection
