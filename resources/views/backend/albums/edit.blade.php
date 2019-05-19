@extends('backend.layout')

@section('title', 'Edit')
@section('subtitle', 'Album tại Beat Karaoke')

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
		<form role="form" method="post" action="{{ route('admin.album.update', $album->id) }}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('name', 'Name (*)') !!}</label>
				{!! Form::text('name', $album->name, ['class'=>'form-control', 'placeholder' => 'Tên ca sĩ'] ) !!} 
			</div>
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('slug', 'Slug (*)') !!}</label>
				{!! Form::text('slug', $album->slug, ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!} 
			</div>
			<div class="form-group">
				<label>Singer</label>
				<ul>
					@foreach ($singers as $item)
					<li>{!! $item['name'] !!}</li>
					@endforeach
				</ul>
			</div>
			<div class="form-group">
				<label>Hình đại diện: ( <i>width x height: {!! config('image.thumnail_with').'x'.config('image.thumnail_height') !!}</i> )</label>
				<p><img src="{!! url('/images/albums/'.$album->images) !!}" width="100"></p>
				{!! Form::file('image') !!}
			</div>
			<div class="form-group">
				<label>{!! Form::label('description', 'Description') !!}</label>
				{!! Form::textarea ('description', $album->description, ['class'=>'form-control', 'placeholder' => 'Place some description here'] ) !!} 
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		</form>
	</div>
</div>
<script src=" {{ url('/components/ckeditor/ckeditor.js') }}"></script>
<script>
  $(function () {
    CKEDITOR.replace('editor1');
  })
</script>
@endsection