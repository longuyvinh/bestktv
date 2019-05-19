@extends('layouts.master')

@section('content')

    <div class="container">
        <section>
          <h2 class="heading"> {{ $genre->name }}</h2>
          <div id="detail_content_block" class="col-md-9 col-sm-12 col-xs-12">
            @foreach($output as $key=>$val)
                <section>
                    <h3 class="heading">Top {{ strtoupper($key) }}</h3>
                    <ul class="listing-home">
                        @foreach ($val as $items)
                            <li class="one_items">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                      <h5>[{{ ucfirst($items->category) }}] <a href="{{ $items->slug }}" >{{ $items->name }}</a> - @foreach($items->singers as $key=>$singer) @if($key>0) , <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a> @else <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a>@endif  @endforeach</h5>
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
    	    		<h4>Danh sách thể loại nhạc</h4>
            </div>

            <ul class="listing-home">
            @foreach ($lgenre as $item)
              <li>
                  <i class="fa fa-music" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<a class="" href="{{ route('genre.detail', $item->slug) }}" >{{ $item->name }}</a>
                <hr>
              </li>
            @endforeach
            </ul>

        	</div>

    </div> <!-- end container -->

@endsection
