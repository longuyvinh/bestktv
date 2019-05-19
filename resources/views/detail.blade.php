@extends('layouts.master')

@section('title', $product->name.' - '. $list_singer_text. ' | Beat, Karaoke, Lyrics' )

@section('content')

    <div class="container">

    	@if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        <div class="alert alert-success" id="box-message-success"></div>

        <div class="alert alert-danger" id="box-message-error"></div>

    	<div id="detail_content_block" class="col-md-9 col-sm-12 col-xs-12">
	    	<section>
	    		<div class="detail-header">
	    			<div class="detail-thumbnail">
	    				@if($product->image !== null)
	    					<img src="/images/products/{{ $product->image }}" width="150">
	    				@else
	    					<img src="/images/beat_icon.png" width="150">
	    				@endif
	    			</div>

	    			<div>
					    <h3>[<span style="text-transform: capitalize;">{{$product->category}}</span>] {{$product->name}} - @foreach($singers as $key=>$sing) @if($key != (count($singers) - 1)) <a href=" {{ route('singer.detail', $sing['slug']) }} "> {{ $sing['name'] }}</a>, @else <a href=" {{ route('singer.detail', $sing['slug']) }} "> {{ $sing['name'] }}</a> @endif  @endforeach</h3>
					    <div>Genre: @if(count($types) > 0) @foreach($types as $type) <a href="{{ route('genre.detail', $type['slug']) }}">{{ $type['name'] }}</a>&nbsp; @endforeach @else N/A @endif</div>
					    <div>Album: @if(count($albums) > 0) @foreach($albums as $album) <a href="{{ route('album.detail', $album['slug']) }}">{{ $album['name'] }}</a>&nbsp; @endforeach @else N/A @endif</div>
					    <div>Giá: ${{ $product->price_usd }} / {{ $product->price_vnd }}K VND</div>
					    <div style="margin-top: 15px;">
					    	<span class="pull-left">
					    		<a href="#" class="pull-right btn btn-danger btn-sm btn-cart" id="cart_{{$product->id}}">
                                    <span class="fa fa-shopping-cart"></span> Add to Cart
                                </a>
					    	</span>
					    	<span class="pull-right">
					    		<a href="#" class="pull-right btn btn-danger btn-sm btn-detail">
                                    <span class="fa fa-cloud-download"></span>
                                </a>
                                <a href="#" class="pull-right btn btn-danger btn-sm btn-detail">
                                    <span class="fa fa-facebook"></span>
                                </a>
                                <a href="#" class="pull-right btn btn-danger btn-sm btn-detail">
                                    <span class="fa fa-google-plus"></span>
                                </a>
					    	</span>
					    </div>
				    </div>
				</div>

				<div style="clear:both;"></div>
				<div class="audio-player">
					@if($product->category == 'beat')
						<audio autoplay style="width: 100%" id="audio-player" src="/resources/{{ $product->resources->path }}" type="audio/mp3" controls="controls"></audio>
					@else
						<?php
						echo \LaravelVideoEmbed::parse($url, $whitelist, $params , $attributes);
						?>
					@endif
				</div>
	    	</section>

	    	@foreach($list_by_singer as $key=>$val)
	    	<section>
	    		<div class="box-related">
	    			<h4>@if($key == "beats") BEAT / PLAYBACK @else VIDEO KARAOKE @endif @foreach($singers as $key=>$sing) @if($key>0) ,{{ strtoupper($sing['name']) }} @else {{ strtoupper($sing['name']) }} @endif @endforeach</h4>
	    		</div>
	    		<ul class="list_thumnails">
	    			@foreach ($val as $item)
	    			<li >
	    				<div style="border-bottom: 1px solid #efefef; padding: 10px 0; margin: 0 10px; height: 120px;">
		    				<div class="detail-thumbnail" style="width: 120px; float: left;">
		    				@if($item->image !== null && $item->image !== "")
		    					<a class="detail_link" href="{{ route('detail', $item->slug) }}" ><img src="/images/products/{{ $item->image }}" width="100"></a>
		    				@else
		    					<a class="detail_link" href="{{ route('detail', $item->slug) }}" ><img src="/images/beat_icon.png" width="100"></a>
		    				@endif
		    				</div>
		    				<div class="" style="margin-top: 10px; ">
		    					<div><a class="detail_link" href="{{ route('detail', $item->slug) }}" >{{ $item->name }}</a></div>

		    					@foreach($item->singers as $key=>$sing) @if($key>0) ,<a class="related_link" href="{{ route('singer.detail', $sing['slug']) }}">{{ $sing['name'] }}</a> @else <a class="related_link" href="{{ route('singer.detail', $sing['slug']) }}">{{ $sing['name'] }}</a>@endif @endforeach
		    				</div>
		    			</div>
	    			</li>
	    			@endforeach
	    		</ul>
	    	</section>
	    	<div style="clear:both;"></div>
	    	@endforeach
    	</div>

    	<div id="sidebar_block" class="col-md-3 col-sm-12 col-xs-12">
    		<div class="box-related">
	    		<h4>{{ $product->category }} cùng thể loại</h4>
	    	</div>
    		<ul>
    			@foreach ($list_by_genre as $item)
    			<li>
    				<div class="detail-thumbnail" style="width: 60px; float: left;">
    				@if($item->image !== null && $item->image !== "")
    					<a class="detail_link" href="{{ route('detail', $item->slug) }}" ><img src="/images/products/{{ $item->image }}" width="48"></a>
    				@else
    					<a class="detail_link" href="{{ route('detail', $item->slug) }}" ><img src="/images/beat_icon.png" width="48"></a>
    				@endif
    				</div>
    				<div class="" style="margin-top: 10px; ">
    					<div><a class="detail_link" href="{{ route('detail', $item->slug) }}" >{{ $item->name }}</a></div>
    					@foreach($item->singers as $key=>$sing) @if($key>0) ,<a class="related_link" href="{{ route('singer.detail', $sing['slug']) }}">{{ $sing['name'] }}</a> @else <a class="related_link" href="{{ route('singer.detail', $sing['slug']) }}">{{ $sing['name'] }}</a>@endif @endforeach
    				</div>
    				<hr>
    			</li>
    			@endforeach
    		</ul>
    	</div>
    </div>

    <script type="text/javascript">
    	$('#box-message-error').hide();
        $('#box-message-success').hide();
    	$('.btn-cart').click(function(e){
            e.preventDefault();
            var getid = $(this).attr('id').split('_');
            var id = getid[1];
            //console.log(id);
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('cart.add') }}",
                dataType: 'json',
                data: { pid: id },
                success: function (data) {

                    if(data.code == "error"){
                        $('#box-message-success').hide();
                        $('#box-message-error').show().html(data.message);
                    }else{
                        $('#box-message-error').hide();
                        $('#box-message-success').show().html(data.message);
                    }
                    $('#cart-total').text( data.count);

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        });
    </script>
@endsection
