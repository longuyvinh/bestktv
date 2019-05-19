@extends('layouts.master')

@section('content')

    <div class="container">

        <section>
            <div class="box-heading">
              <h2>Danh sách ca sĩ</h2>
            </div>
            <ul class="listing-home">
                @foreach ($singers as $items)
                    <li style="width: 20%; float: left;">
                        <div style="text-align: center;">
                            <a href="{{ route('singer.detail', $items->slug) }}"><img src="{{ url('/images/singers/'.$items->image) }}" width="150" height="150" /></a>
                            <br>
                            <p align="center"><a href="{{ route('singer.detail', $items->slug) }}"> {{ $items->name }} </a></p>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div style="clear:both;"></div>
            <div class="text-center">{{ $singers->links() }}</div>
        </section>


    </div> <!-- end container -->

@endsection
