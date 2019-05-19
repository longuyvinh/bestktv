@extends('backend.layout')

@section('title', 'Edit')
@section('subtitle', 'Bài hát tại Beat Karaoke')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      	<h3 class="box-title">General Elements</h3>
    </div>
	<div class="box-body">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form role="form" method="post" action="{{ route('admin.page.update', $page->id) }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label>{!! Form::label('title', 'Title') !!} (*)</label>
				{!! Form::text('title', $page->title , ['class'=>'form-control', 'placeholder' => 'Page Title'] ) !!} 
			</div>

			<div class="form-group">
				<label>{!! Form::label('slug', 'Slug') !!} (*)</label>
				{!! Form::text('slug', $page->slug , ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!} 
			</div>

			<div class="form-group">
				<label>{!! Form::label('body', 'Description') !!}</label>
				{!! Form::textarea ('body', $page->body , ['class'=>'form-control', 'placeholder' => '', 'cols'=>"30", 'rows'=>"10"] ) !!} 
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		</form>

		

	</div>
</div>
@endsection

@section('extra-javascript')
<script src="{{ asset('tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
		selector: 'textarea',
		height: 500,
		menubar: true,
		file_picker_types: 'file image media',
		plugins: [
		'advlist autolink lists link image charmap print preview anchor textcolor',
		'searchreplace visualblocks code fullscreen',
		'insertdatetime media table contextmenu paste code help wordcount'
		],
		toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
		content_css: [
		'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
		'//www.tinymce.com/css/codepen.min.css'],
		images_upload_handler: function (blobInfo, success, failure) {
		    var xhr, formData;

		    xhr = new XMLHttpRequest();
		    xhr.withCredentials = false;
		    xhr.open('POST', 'postAcceptor.php');

		    xhr.onload = function() {
		      var json;

		      if (xhr.status != 200) {
		        failure('HTTP Error: ' + xhr.status);
		        return;
		      }

		      json = JSON.parse(xhr.responseText);

		      if (!json || typeof json.location != 'string') {
		        failure('Invalid JSON: ' + xhr.responseText);
		        return;
		      }

		      success(json.location);
		    };

		    formData = new FormData();
		    formData.append('file', blobInfo.blob(), blobInfo.filename());

		    xhr.send(formData);
		 }
	});
</script>@endsection