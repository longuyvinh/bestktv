@extends('backend.layout')

@section('title', 'Tạo Mới')
@section('subtitle', 'Thể loại nhạc tại Beat Karaoke')

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
        
		<form role="form" method="post" action="{{ route('admin.style.store') }}">
			{{csrf_field()}}
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>Name (*)</label>
				<input name="name" id="type-form-name" type="text" class="form-control" placeholder="" onkeypress="getSlug()">
				@if ($errors->has('name'))
					<span class="help-block">Field Name không được rỗng</span>
				@endif
			</div>

			<div class="form-group @if ($errors->has('slug')) has-error @endif"">
				<label>Slug (*)</label>
				<input name="slug" id="type-form-slug" type="text" class="form-control" placeholder="">
				@if ($errors->has('slug'))
					<span class="help-block">Field Slug không được rỗng</span>
				@endif
			</div>

			<!-- textarea -->
			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control" rows="3" placeholder=""></textarea>
			</div>

			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>

		</form>
	</div>
</div>
@endsection