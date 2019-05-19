@extends('layouts.master')

@section('title', config('app.name', 'Best KTV'))

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

        <div class="alert alert-success" id="box-message-success">
        </div>

        <div class="alert alert-danger" id="box-message-error"></div>

        @foreach($output as $key=>$val)
            <section>
              <div class="box-heading">
                <h2>NEW {{ strtoupper($key) }}</h2>
              </div>

                <ul class="listing-home">
                    <li>
                        <div class="row">
                            <div class="col-md-2 col-sm-3 hidden-xs">Date</div>
                            <div class="col-md-5 col-sm-6 col-xs-8">Song name</div>
                            <div class="col-md-2 col-sm-3 col-xs-4">Prices</div>
                            <div class="col-md-3 hidden-sm hidden-xs"></div>
                        </div>
                    </li>
                    @foreach ($val as $items)
                        <li class="one_items">
                            <div class="row">
                                <div class="col-md-2 col-sm-3 hidden-xs"> {{ \Carbon\Carbon::parse($items->updated_at)->format('d-m-Y') }} </div>
                                <div class="col-md-5 col-sm-6 col-xs-8"><h5>[{{ ucfirst($items->category) }}] <a href="{{ $items->slug }}" >{{ $items->name }}</a> - @foreach($items->singers as $key=>$singer) @if($key>0) , <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a> @else <a href="{{ route('singer.detail',$singer->slug) }}">{{ $singer->name }}</a>@endif  @endforeach</h5></div>

                                <div class="col-md-2 col-sm-3 col-xs-4">${{ $items->price_usd }} / {{ $items->price_vnd }}K VND</div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
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


    </div> <!-- end container -->

    <script type="text/javascript">
    $(document).ready(function(){
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
        /*
        $('#submit').on('submit', function (e) {
            e.preventDefault();
            var title = $('#title').val();
            var body = $('#body').val();
            var published_at = $('#published_at').val();
            $.ajax({
                type: "POST",
                url: host + '/articles/create',
                data: {title: title, body: body, published_at: published_at},
                success: function( msg ) {
                    $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
            });
        });*/
    });
    </script>
@endsection
