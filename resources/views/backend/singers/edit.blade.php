@extends('backend.layout')

@section('title', 'Edit')
@section('subtitle', 'Ca sĩ tại Beat Karaoke')

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
		<form role="form" method="post" action="{{ route('admin.singer.update', $singer->id) }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('name', 'Name (*)') !!}</label>
				{!! Form::text('name', $singer->name, ['class'=>'form-control', 'placeholder' => 'Tên ca sĩ'] ) !!}
				@if ($errors->has('name'))
					<span class="help-block">Field Name không được rỗng</span>
				@endif
			</div>

			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('slug', 'Slug (*)') !!}</label>
				{!! Form::text('slug', $singer->slug, ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!}
				@if ($errors->has('name'))
					<span class="help-block">Field Slug không được rỗng</span>
				@endif
			</div>

			<div class="form-group">
				<label>Giới tính:</label>
				{!! Form::select('gender', ['male' => 'Male', 'female' => 'Female', 'third'=>'Bede'], $singer->gender); !!}
			</div>

			<div class="form-group">
				<label>Hình đại diện: ( <i>width x height: {!! config('image.thumnail_with').'x'.config('image.thumnail_height') !!}</i> )</label>
				<p><img src="{!! url('/images/singers/'.$singer->image) !!}" id="image-tag" height="200"></p>
				{!! Form::file('image', ['id'=>'image-field']) !!}
			</div>

			<div class="form-group">
				<label>Hình background: ( <i>width x height: {!! config('image.background_with').'x'.config('image.background_height') !!}</i> )</label>
				<p><img src="{!! url('/images/singers/'.$singer->background) !!}" id="image-bg-tag" height="200"></p>
				{!! Form::file('image_bg', ['id'=>'image-bg-field']) !!}
			</div>
			<div class="form-group">
				<label>{!! Form::label('description', 'Description') !!}</label>
				{!! Form::textarea ('description', $singer->description, ['id' => 'editor1', 'class'=>'form-control', 'placeholder' => 'Place some description here', 'rows'=>'20', 'cols' => '80'] ) !!}
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		</form>
	</div>
</div>
<script src=" {{ url('/components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  function readURL(input, target) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $(target).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#image-field").change(function(){
      readURL(this, '#image-tag' );
  });

  $("#image-bg-field").change(function(){
      readURL(this, '#image-bg-tag' );
  });
  $(function () {
    CKEDITOR.replace('editor1');
  })
</script>
@endsection
