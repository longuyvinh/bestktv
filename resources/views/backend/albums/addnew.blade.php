@extends('backend.layout')

@section('title', 'Tạo Mới')
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

		{!! Form::open(['route' => 'admin.album.store', 'enctype' => "multipart/form-data"]) !!}
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('name', 'Name (*)') !!}</label>
				{!! Form::text('name', '' , ['class'=>'form-control', 'placeholder' => 'Tên album'] ) !!} 
			</div>
			<div class="form-group @if ($errors->has('name')) has-error @endif">
				<label>{!! Form::label('slug', 'Slug (*)') !!}</label>
				{!! Form::text('slug', '' , ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!} 
			</div>
			<div class="form-group">
				<label>Singer:</label>
				<div class="dropdown-mul-1">
			        <select style="display:none" id="" multiple placeholder="Select"> </select>
			    </div>
				<input type="hidden" name="singer" value="" id="singer_id">
			</div>
			<div class="form-group">
				<label>Hình đại diện: ( <i>width x height: {!! config('image.thumnail_with').'x'.config('image.thumnail_height') !!}</i> )</label>
				{!! Form::file('image') !!}
			</div>

			<div class="form-group">
				<label>{!! Form::label('description', 'Description') !!}</label>
				{!! Form::textarea ('description', '', ['class'=>'form-control', 'placeholder' => 'Place some description here'] ) !!} 
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('extra-javascript')
<script src="{{ asset('plugins/multi-selected-dropdown/jquery.dropdown.js') }}"></script>
<script type="text/javascript">
    var data = []; 
    @foreach($singers as $singer)
    	var object={};
    	object.name = "{{ $singer->name }}";
    	object.id = {{ $singer->id }};
    	object.selected = false;
    	data.push(object);
    @endforeach
    var listID = [];
    $('.dropdown-mul-1').dropdown({
		data: data,
		limitCount: 40,
		multipleMode: 'label',
		choice: function () {
			//console.log(arguments[1]);
			//{name: "Phi Nhung", id: 2, selected: false}
			var object = arguments[1];
			if(object.selected == false){
				var index = listID.indexOf( object.id );
			    if (index >= 0) {
			       listID.splice(index, 1);
			    }
			}else if(object.selected == true){
				listID.push(object.id);
			}
			$("#singer_id").val( listID.toString() );
		}
    });

</script>
@endsection