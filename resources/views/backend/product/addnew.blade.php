@extends('backend.layout')

@section('title', 'Tạo Mới')
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
		{!! Form::open(['route' => 'admin.product.store', 'enctype' => "multipart/form-data"]) !!}
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Category:</label>
						{!! Form::select('category', ['beat' => 'Beat', 'karaoke' => 'Karaoke']); !!}
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Type:</label>
						{!! Form::select('type', $types); !!}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Singer:</label>
						<div class="dropdown-mul-1">
					        <select style="display:none" id="" multiple placeholder="Select Singer"> </select>
					    </div>
						<input type="hidden" name="singer" value="" id="singer_id">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Albums:</label>
						<div class="dropdown-mul-2">
					        <select style="display:none" id="" multiple placeholder="Select album"> </select>
					    </div>
						<input type="hidden" name="album" value="" id="album_id">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>{!! Form::label('name', 'Name') !!} (*)</label>
				{!! Form::text('name', '', ['class'=>'form-control', 'placeholder' => 'Tên bài hát'] ) !!} 
			</div>

			<div class="form-group">
				<label>{!! Form::label('slug', 'Slug') !!} (*)</label>
				{!! Form::text('slug', '', ['class'=>'form-control', 'placeholder' => 'slug will show on url'] ) !!} 
			</div>

			<div class="form-group">
				<label>Giá vnđ: (*) <small>(Ex: 120.000 vnđ, bạn sẽ điền là: 120)</small></label>
				{!! Form::text('price_vnd', '', ['class'=>'form-control', 'placeholder' => 'Đơn vị 1k:1000 vnđ'] ) !!} 
				<label>Giá usd: (*) </label>
				{!! Form::text('price_usd', '', ['class'=>'form-control', 'placeholder' => ''] ) !!} 
			</div>

			<div class="form-group">
				<label>Hình đại diện: ( <i>width x height: {!! config('image.thumnail_with').'x'.config('image.thumnail_height') !!}</i> )</label>
				{!! Form::file('image') !!}
			</div>

			<div class="form-group">
				<label>Resources:</label>
				<!-- Custom tabs (Charts with tabs)-->
	          	<div class="nav-tabs-custom">
		            <!-- Tabs within a box -->
		            <ul class="nav nav-tabs pull-right">
			            <li class="pull-left active"><a href="#dirrect-upload" data-toggle="tab">Dirrect Upload</a></li>
			            <li class="pull-left"><a href="#other-upload" data-toggle="tab">Youtube / Others ...</a></li>
			            <!--
			            <li class="pull-left"><i class="fa fa-inbox"></i> Resources</li>-->
		            </ul>
		            <div class="tab-content">
			            <!-- Morris chart - Sales -->
			            <div class="chart tab-pane active" id="dirrect-upload" style="position: relative; height: 150px;">
			              	<div class="form-group">
								<label>Type resouces:</label>
								{!! Form::select('resource_type', ['audio'=>'Audio', 'video' => 'Videos'] ) !!} 
							</div>
							<div class="form-group">
								<label>Upload:</label>
								{!! Form::file('resource_file') !!} 
							</div>
			            </div>
			            <div class="chart tab-pane" id="other-upload" style="position: relative; height: 150px;">
			              	<div class="form-group">
								<label>From:</label>
								{!! Form::select('resource_from', ['youtube'=>'Youtube', 'others' => 'Others'] ) !!} 
							</div>
							<div class="form-group">
								<label>Link URL:</label>
								{!! Form::text('resource_url', '', ['class'=>'form-control', 'placeholder' => 'url of resources'] ) !!} 
							</div>
			            </div>
		            </div>
	          	</div>
	          	<!-- /.nav-tabs-custom -->
          	</div>

			<div class="form-group">
				<label>{!! Form::label('description', 'Description') !!}</label>
				{!! Form::textarea ('description', '', ['class'=>'form-control', 'placeholder' => ''] ) !!} 
			</div>
			<div class="form-group">
		     	<input type="submit" class="btn btn-primary">
		    </div>
		{!! Form::close() !!}

	</div>
</div>
@endsection

@section('extra-javascript')
<!--
<script src="{{ asset('plugins/multi-selected-dropdown/jquery.dropdown.min.js') }}"></script>-->
<script src="{{ asset('plugins/multi-selected-dropdown/jquery.dropdown.js') }}"></script>
<script type="text/javascript">
    var data = []; var data2 = []; 
    @foreach($singers as $singer)
    	var object={};
    	object.name = "{{ $singer->name }}";
    	object.id = {{ $singer->id }};
    	object.selected = false;
    	data.push(object);
    @endforeach

    @foreach($albums as $album)
    	var object={};
    	object.name = "{{ $album->name }}";
    	object.id = {{ $album->id }};
    	object.selected = false;
    	data2.push(object);
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

    var listAlbum = [];
    $('.dropdown-mul-2').dropdown({
		data: data2,
		limitCount: 40,
		multipleMode: 'label',
		choice: function () {
			//console.log(arguments[1]);
			//{name: "Phi Nhung", id: 2, selected: false}
			var object = arguments[1];
			if(object.selected == false){
				var index = listAlbum.indexOf( object.id );
			    if (index >= 0) {
			       listAlbum.splice(index, 1);
			    }
			}else if(object.selected == true){
				listAlbum.push(object.id);
			}
			$("#album_id").val( listAlbum.toString() );
		}
    });

</script>
@endsection