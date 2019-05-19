@extends('layouts.master')

@section('content')

    <div class="container">
        <p><a href="{{ url('shop') }}">Home</a> / Cart</p>
        <h1>Your Cart</h1>

        <hr>

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

        @if (sizeof(Cart::content()) > 0)

            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên bài hát</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $key=>$item)
                    <tr>
                        <td></td>
                        <td><a href="{{ url('shop', [$item->model->slug]) }}">{{ $item->name }}</a></td>
                        <td> 1 </td>
                        <td>${{ $item->subtotal }}</td>
               
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="row_id" value="{{ $key }}">
                                <input type="submit" class="btn btn-danger btn-sm" value="Remove">
                            </form>
                         
                            <form action="{{ url('switchToWishlist', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="submit" class="btn btn-success btn-sm" value="To Wishlist">
                            </form>
                        </td>
                    </tr>

                    @endforeach
                 
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Subtotal</td>
                        <td>${{ Cart::instance('default')->subtotal() }}</td>
             
                        <td></td>
                    </tr>
                    <tr>
                        <td class="table-image"></td>
                        <td></td>
                        <td class="small-caps table-bg" style="text-align: right">Tax</td>
                        <td>${{ Cart::instance('default')->tax() }}</td>
               
                        <td></td>
                    </tr>
                    
                    <tr class="border-bottom">
                        <td class="table-image"></td>
                        <td style="padding: 40px;"></td>
                        <td class="small-caps table-bg" style="text-align: right">Your Total</td>
                        <td class="table-bg">${{ Cart::total() }}</td>
                        <!--
                        <td class="column-spacer"></td>-->
                        <td></td>
                    </tr>

                </tbody>
            </table>
            @php $i=1; @endphp
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">
                <input type="hidden" name="business" value="bestktv2017@gmail.com">
                @foreach (Cart::content() as $item)
                    <input type="hidden" name="item_name_{{ $i }}" value="{{ $item->name }}">
                    <input type="hidden" name="amount_{{ $i }}" value="{{ $item->subtotal }}">
                    <input type="hidden" name="shipping_{{ $i }}" value="0.00">
                    @php $i++; @endphp
                @endforeach
                <input name="submit" type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-pill-paypal-44px.png" alt="PayPal">
            </form>
            <!--
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Continue Shopping</a> &nbsp;
            <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">Proceed to Checkout</a>
            -->
            <!--
            <div style="float:right">
                <form action="{{ url('/emptyCart') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger btn-lg" value="Empty Cart">
                </form>
            </div>
            -->
        @else

            <h3>You have no items in your shopping cart</h3>
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Continue Shopping</a>

        @endif

        <div class="spacer"></div>

    </div> <!-- end container -->

@endsection

@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '{{ url("/cart") }}' + '/' + id,
                  data: {
                    'quantity': this.value,
                  },
                  success: function(data) {
                    window.location.href = '{{ url('/cart') }}';
                  }
                });

            });

        })();

    </script>
@endsection
