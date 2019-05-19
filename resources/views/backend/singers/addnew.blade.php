@extends('backend.layout')

@section('title', 'Tạo Mới')
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

		{!! Form::open(['route' => 'admin.singer.store', 'enctype' => "multipart/form-data"]) !!}
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('name', 'Name (*)') !!}</label>
				{!! Form::text('name', '' , ['class'=>'form-control', 'placeholder' => 'Tên ca sĩ'] ) !!}
				@if ($errors->has('name'))
					<span class="help-block">Field Name không được rỗng</span>
				@endif
			</div>
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('slug', 'Slug (*)') !!}</label>
				{!! Form::text('slug', '' , ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!}
				@if ($errors->has('name'))
					<span class="help-block">Field Slug không được rỗng</span>
				@endif
			</div>
			<div class="form-group">
				<label>Giới tính:</label>
				{!! Form::select('gender', ['male' => 'Male', 'female' => 'Female', 'third'=>'Bede']); !!}
			</div>
			<div class="form-group">
				<label>Avatar: ( <i>width x height: {!! config('image.thumnail_with').'x'.config('image.thumnail_height') !!}</i> )</label>
				{!! Form::file('image') !!}
			</div>
			<div class="form-group">
				<label>Cover Picture: ( <i>width x height: {!! config('image.background_with').'x'.config('image.background_height') !!}</i> )</label>
				{!! Form::file('image_bg') !!}
			</div>
			<div class="form-group">
				<label>{!! Form::label('description', 'Description') !!}</label>
				{!! Form::textarea ('description', '', ['id' => 'editor1', 'class'=>'form-control', 'placeholder' => 'Place some description here', 'rows'=>'10', 'cols' => '80'] ) !!}
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		{!! Form::close() !!}
	</div>
</div>
<script src=" {{ url('/components/ckeditor/ckeditor.js') }}"></script>
<script>
  $(function () {
    CKEDITOR.replace('editor1');
  })
</script>
@endsection
