@extends('layouts.master')

@section('content')

    <div class="container">

        <section >

            <div style="background: url({{ url('/images/singers/'.$singer->background) }}); background-repeat: no-repeat; background-size: cover;  position: relative; height: 300px;">
                <div class="singer-top-box">
                  <img src="{{ url('/images/singers/'.$singer->image) }}" style="border: 2px solid #C9302C; border-radius: 50%; float: left; margin-right: 20px;" width="150" />
                  <div style="color: #eee; letter-spacing: 1px;">
                    <h3>{{ $singer->name }}</h3>
                    <div class="singer-info">{{ str_limit(strip_tags($singer->description), 650) }}</div>
                </div>
              </div>
            </div>

        </section>

        <section>
          <div id="detail_content_block" class="col-md-9 col-sm-12 col-xs-12">
            @foreach($output as $key=>$val)
                <section>
                    <h3 class="heading">Top {{ strtoupper($key) }}</h3>
                    <ul class="listing-home">
                        @foreach ($val as $items)
                            <li class="one_items">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                      <h5>[{{ ucfirst($items->category) }}] <a href="{{ route('detail', $items->slug) }}" >{{ $items->name }}</a> - @foreach($items->singers as $key=>$singer) @if($key>0) , <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a> @else <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a>@endif  @endforeach</h5>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">${{ $items->price_usd }} / {{ $items->price_vnd }}K VND</div>
                                    <div class="col-md-3 col-sm-6 col-xs-6 text-right">
                                        <a href="#" class="pull-right btn-listing btn btn-danger btn-sm">
                                            <span class="fa fa-google-plus"></span>
                                        </a>
                                        <a href="#" class="pull-right btn-listing btn btn-danger btn-sm">
                                            <span class="fa fa-cloud-download"></span>
                                        </a>
                                        <a href="#" class="pull-right btn-listing btn btn-danger btn-sm">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                        <a href="#" class="pull-right btn-listing btn btn-danger btn-sm btn-cart" id="addcart_{{ $items->id }}">
                                            <span class="fa fa-shopping-cart"></span>
                                        </a>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        	</div>

        	<div id="sidebar_block" class="col-md-3 col-sm-12 col-xs-12">
        		<div class="box-related">
    	    		<h4>Ca si tuong tu</h4>
            </div>

            <ul class="listing-home">
            @foreach ($lsinger as $item)
              <li>
                <div class="detail-thumbnail" style="width: 60px; float: left;">
                @if($item->image !== null && $item->image !== "")
                  <a class="detail_link" href="{{ route('singer.detail', $item->slug) }}" ><img src="/images/singers/{{ $item->image }}" width="48"></a>
                @else
                  <a class="detail_link" href="{{ route('singer.detail', $item->slug) }}" ><img src="/images/beat_icon.png" width="48"></a>
                @endif
                </div>
                <div class="" style="margin-top: 10px; ">
                  <a class="singer_detail_link" href="{{ route('singer.detail', $item->slug) }}" >{{ $item->name }}</a>
                </div>
                <hr>
              </li>
            @endforeach
            </ul>

        	</div>

    </div> <!-- end container -->

@endsection
