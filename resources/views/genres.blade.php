@extends('layouts.master')

@section('content')

    <div class="container">

        <section>
            <div class="box-heading">
              <h2>Nhạc theo chủ đề</h2>
            </div>
            <ul class="listing-home">
                @foreach ($genres as $items)
                    <li class="col-md-4 col-sm-6 co-xs-12">
                      <div class="genres-name">
                        <div style="width: 100%; height: 100%; position: relative;">
                          <a href="{{ route('genre.detail', $items->slug) }}"> {{ $items->name }} </a>
                        </div>
                      </div>
                    </li>
                @endforeach
            </ul>
            <div style="clear:both;"></div>
            <p class="text-center">{{ $genres->links() }}</p>
        </section>


    </div> <!-- end container -->

    <script type="text/javascript">
    $(document).ready(function(){
        $('#box-message-error').hide();
        $('#box-message-success').hide();

    });
    </script>
@endsection
