@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form method="post" action="{{route('add-question')}}" enctype="multipart/form-data" id="questionForm">
		@csrf
		<div class="form-group row offset-md-1">
			<div class="col-md-10">
				<label for="#description">Question</label>
				<textarea type="text" name="description"  class="form-control" id="description"></textarea>
			</div>
		</div> <br><br>
		<div class="form-group row offset-md-1">
			<div class="col-md-5">
				<select name="category_id" id="category_id" class="form-control">
					<option selected disabled>Select A Category</option>
					@foreach($categories as $key => $category)
						<option value="{{$key}}">{{$category}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-5">
				<select name="difficulty_level" id="difficulty_level" class="form-control ">
					<option selected disabled>Select Difficulty Level..</option>
					@foreach($difficulty_levels as $key => $difficulty_level)
						<option value="{{$key}}">{{$difficulty_level}}</option>
					@endforeach

				</select>
			</div>
			
			
		</div>
		
		<input type="button" class="btn btn-success my-3" style="float: right;margin-right:210px;" value="Add Choice" id="add_choice">
		<div class="form-group row offset-md-1 my-3" id="choices"></div>
		<br><br>
		<input type="submit" class="btn btn-success my-3" style="float: right;margin-right: 200px;" value="Add Question">
		
	</form>
@endsection
@section('scripts')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
	function removeAnswer(id,removeId)
	{
		// console.log(id);
		$('#'+id).remove();
		let el = $('#choices').children();
		for(let i=0;i<el.length;i++)
		{
			let nodes = el[i].querySelector('.choice_parent .choice_child');
            // let label = el[i].querySelector('.choice_parent .choice_label');
			let id = removeId;
			if(nodes.value > removeId)
			{
				let value = nodes.value--;
				nodes.setAttribute('id','correct_'+nodes.value);
				nodes.nextElementSibling.setAttribute('for','correct_'+nodes.value);

			}
			id++;
		}

	}
	function bindCorrectAnswer(val)
	{
		console.log(val);
	}
	$(document).ready(function(){
		let choice_number = 1;
		
		$('#add_choice').click(function(){
			let content = `
			<div class='d-flex common_value' id='answer_no_${choice_number}'>
				<div class='col-md-4 mt-3'>
					<input type='text' class='form-control' placeholder='Multiple Choice' name='choices[]'>
				</div>
				<div class='col-md-4 mt-3'>
					<input type='text' class='form-control'
						placeholder='Description... (optional)' 
						name='descriptions[]' >
				</div>
				<div class='col-md-3 mt-3 custom-control custom-radio d-flex choice_parent'>
					<input type="radio" id="correct_${choice_number}" name="correct" class="custom-control-input choice_child" value='${choice_number}'>
					<label for='correct_${choice_number}' class='custom-control-label choice_label'>Correct Answer</label>

					<div id='deleteAnswer_${choice_number}' style='margin-top:-20px;margin-left:10px;cursor:pointer' onclick="removeAnswer('answer_no_'+${choice_number},${choice_number})">
						<span id='deleteAnswers'>&times;</span>
					</div>
				</div>
			</div>
				`;
				$('#choices').append(content);
				choice_number++;
				
		
			
			// if(localStorage.getItem('choice_number'))
				
			// console.log(typeof());
			
		});
	});
	let ids = [];
    class MyUploadAdapter {
    constructor( loader ) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );

            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', "{{route('editor-upload',['_token'=>csrf_token()])}}", true );
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            /*resolve( {
                default: response.url
            } );*/
            // ids.push(response.id);

            let form = $("#questionForm");
            let content = `<input type='hidden' name='ids[]' value='${response.id}'>`;
            // $('#questionForm').text();
            form.append(content);
            resolve(response);
        } );

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest( file ) {
        // Prepare the form data.
        const data = new FormData();

        data.append( 'upload', file );

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send( data );
    }
}

// ...

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}
ClassicEditor
.create( document.querySelector( '#description' ), {
        extraPlugins: [ MyCustomUploadAdapterPlugin ],
        fontFamily: {
            options: [
                'default',
                'Ubuntu, Arial, sans-serif',
                'Ubuntu Mono, Courier New, Courier, monospace'
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );
</script>
@endsection