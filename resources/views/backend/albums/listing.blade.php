@extends('backend.layout')

@section('title', 'Album')
@section('subtitle', 'Danh sách album tại Beat Karaoke')

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
              		<a href="{{ route('admin.album.create') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i> Add New</button></a>
	            </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Thumbnail</th>
                  <th>Name</th>
                  <th>Info</th>
                  <th>Date</th>
                  <th style="width: 150px;">Action</th>
                </tr>
                @foreach($albums as $post)
                <tr id="row-{{ $post['id'] }}">
                  <td>{{ $post['id'] }}</td>
                  <td><img src="{{ url('/images/albums/'.$post['images']) }}" width="50" height="50" /></td>
                  <td>{{ $post['name'] }}</td>
                  <td>{{ $post['description'] }}</td>
                  <td>{{ $post['created_at'] }}</td>
                  <td align="right">
                    <button class="btn btn-danger btn-sm" onclick="deletePost({{ $post['id'] }})"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                  	&nbsp;
                    <a href="{{ route('admin.album.edit', $post['id']) }}">
                  	<button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                    </a>
                  </td>
                </tr>
                @endforeach
                <th colspan="5">{{ $albums->links() }}</th>
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
    var params = "album_id="+pid;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open("POST", "{{ route('admin.album.delAjax') }}", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content );
    xhttp.send(params);
  }
</script>
@endsection