@extends('backend.layout')

@section('title', 'Ca sĩ')
@section('subtitle', 'Danh sách ca sĩ tại Beat Karaoke')

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
              <div class="pull-right box-tools" style="width: 70%;">
                <form role="search" method="_GET" action="">
                  {{csrf_field()}}
                  <div class="input-group add-on">
                    <input class="form-control" placeholder="Gõ tên không dấu" name="keyword" id="srch-term" type="text">
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm" style="margin-left: 5px;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Add New</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped">
                <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Price</th>
                  <th style="width: 150px;">Action</th>
                </tr>
                @foreach($products as $post)
                <tr id="row-{{ $post['id'] }}">
                  <td>{{ $post['id'] }}</td>
                  <td>{{ $post['category'] }}</td>
                  <td>{{ $post['name'] }}</td>
                  <td>{{ $post['created_at'] }}</td>
                  <td>${{ $post['price_usd'].' / '.$post['price_vnd'] }} vnd</td>
                  <td align="right">
                    <button class="btn btn-danger btn-sm" onclick="deletePost({{ $post['id'] }})"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                    &nbsp;
                    <a href="{{ route('admin.product.edit', $post['id']) }}">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                    </a>
                  </td>
                </tr>
                @endforeach
                <tr>
                <th colspan="6">{{ $products->links() }}</th>
                </tr>
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
    var params = "pid="+pid;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open("POST", "{{ route('admin.product.delAjax') }}", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content );
    xhttp.send(params);
  }
</script>
@endsection