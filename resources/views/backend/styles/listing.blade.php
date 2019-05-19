@extends('backend.layout')

@section('title', 'Thể Loại Nhạc')
@section('subtitle', 'Tất cả các thể loại nhạc tại Beat Karaoke')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			@if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
			@endif
		</div>
	</div>

	<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listing</h3>

              <div class="pull-right box-tools">
              	<div class="btn-group">
              		<a href="{{ route('admin.style.addnew') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i> Add New</button></a>
              		<!--
	                <div class="input-group input-group-sm" style="width: 250px;">
	                  	<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

	                  	<div class="input-group-btn">
	                    	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	                  	</div>
	                </div>
	                -->
	            </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th style="width: 150px;">Action</th>
                </tr>
                @foreach($types as $post)
                <tr id="row-{{ $post['id'] }}">
                  <td>{{ $post['id'] }}</td>
                  <td>{{ $post['name'] }}</td>
                  <td>{{ $post['created_at'] }}</td>
                  <td>{{ $post['description'] }}</td>
                  <td align="right">
                  	<button class="btn btn-danger btn-sm" onclick="deletePost({{ $post['id'] }})"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                  	&nbsp;
                    <a href=" {{ route('admin.style.edit', $post['id']) }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <!--
                  	<button class="btn btn-primary btn-sm"></button>-->
                  </td>
                </tr>
                @endforeach
                <th colspan="5">{{ $types->links() }}</th>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

<script type="text/javascript">
  function deletePost(pid){
    document.getElementById('row-'+pid).setAttribute("style", "display: none;");
    var xhttp = new XMLHttpRequest();
    var params = "type_id="+pid;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open("POST", "{{ route('admin.style.delAjax') }}", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content );
    xhttp.send(params);
  }
</script>
@endsection