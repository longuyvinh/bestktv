<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="description" content="Best KTV - Hoà Âm - Phối Khí - Nhạc Nền - Beat / Playback - Karaoke HD">

    <!-- Store CSRF token for AJAX calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('extra-css')

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

</head>
<body>

    <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <div class="logo">
                            <a class="navbar-brand" href="{{ route('home') }}"><img src="../images/logobeat.png" /></a>
                        </div>
                    </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse ">
                    <div class="container">
                        <div class="main-menu-top">
                            <ul class="nav navbar-nav main-menu">
                                <li class="{{ set_active('shop') }}"><a href="{{ route('beats') }}">Beat</a></li>
                                <li><a href="{{ route('karaokes') }}">Karaoke</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right sub-menu">
                                <!--
                                <li class="{{ set_active('wishlist') }}"><a href="{{ url('/wishlist') }}">Wishlist ({{ Cart::instance('wishlist')->count(false) }})</a></li>-->
                                @if( Auth::guest() )
                                    <!--
                                    <li><a href="{{ route('login') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Login</a></li>
                                    -->
                                    <li class="dropdown">
                                        <!--
                                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Tutorials
                                        </button>-->
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Account
                                        <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li>
                                                <button class="btn btn-danger" style="width: 100%;" id="btn-sign-in">SIGN IN</button>
                                            </li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation">NEW CUSTOMER?<br><a class="active" role="menuitem" tabindex="-1" href="{{ route('register') }}">Create an Account</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('user.profile') }}">My Account</a></li>
                                            <li role="presentation" class="divider"></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('user.profile') }}">My Orders</a></li>
                                        </ul>
                                    </li>
                                    <!--
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Account
                                        <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('login') }}"><button>SIGN IN</button></a></li>
                                            <li>NEW CUSTOMER?<br><a href="{{ route('register') }}">Create an Account</a></li>
                                            <li><a href="#">My Account</a></li>
                                            <li><a href="#">My Orders</a></li>
                                        </ul>
                                    </li>-->
                                @else
                                    <li><a href="{{ route('login') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Hi! <strong>{{ Auth::user()->name }}</strong></a></li>
                                @endif
                                <li class="" id="giohang">
                                    <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart: <span id="cart-total">{{ Cart::instance('default')->count(false) }}</span> item(s)</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="menu-top" class="navbar-xs-top">
                        <div class="container">
                            <ul>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('home') }}">Trang chủ</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('singer.listing') }}">Ca sĩ</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('genre.listing') }}">Thể loại</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('page.detail','huong-dan-giao-dich') }}">Hướng dẫn giao dịch</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('page.detail','bang-gia') }}">Bảng giá</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('page.datbai') }}">Đặt bài</a></li>
                                <li class="{{ set_active('shop') }}"><a href="{{ route('page.lienhe') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="container">
                    <div class="col-sm-12 col-md-12">
                        <form class="navbar-form" role="search" action="{{route('searching')}}" method="POST">
                            {!! csrf_field() !!}
                            <div class="input-group" style="width: 100%; position: relative;">
                                <!--
                                <div style="position: absolute; z-index: 999; width: 100px;">
                                    <select class="form-control " id="select-option" name="options" style="width: 100%;">
                                        <option value="baihat">Bài hát</option>
                                        <option value="casi">Ca sĩ</option>
                                    </select>
                                </div>-->
                                <input type="text" class="form-control" id="search-box" name="keyword" placeholder="Nhập nội dung cần tìm" autocomplete="off">

                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>

                            </div>
                            <div class="input-group" style="width: 100%;">
                                <div id="suggesstion-box"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/.nav-collapse -->
            </nav>

    </header>

    @yield('content')

    <footer>
        <div style="background: #F3F3F3;">
            <div class="container" style="margin-top: 30px;">
                <h2>Dịch vụ của Best KTV</h2>
                <h4>Hoà Âm - Phối Khí - Nhạc Nền - Beat / Playback - Karaoke HD</h4>
                <div class="row" style="margin: 50px 0;">
                    <div class="col-md-3"></div>
                    <div class="col-md-2 text-center">
                        <img class="img-circle" style="border: 1px solid #C9302C; padding: 5px;" src="{{ URL::to('/images/beat.png') }}" />
                        <h4>Phối Beat</h4>
                        <p>Hòa âm, phối cover, phối sáng tác theo yêu cầu</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <img class="img-circle" style="border: 1px solid #C9302C; padding: 5px;" src="{{ URL::to('/images/karaoke.png') }}" />
                        <h4>Karaoke HD</h4>
                        <p>Làm karaoke chất lượng 1080p đến 4K</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <img class="img-circle" style="border: 1px solid #C9302C; padding: 5px;" src="{{ URL::to('/images/video.png') }}" />
                        <h4>Intro, TVC</h4>
                        <p>Làm intro, tvc quảng cáo cho doanh nghiệp</p>
                    </div>
                    <div class="col-md-3"></div>
                </div>

                <div style="background: #fff; margin: 10px 0;">
                    <div class="row" style="padding: 20px;">
                        <div class="col-md-4 col-sm-4 col-xs-12 text-left" style="border-right: 1px solid #ccc;">
                            <form action=" {{ route('page.store.subscribe') }}" name="frmSubscribe" method="post">
                                <h4>Sign up for Best KTV email</h4>
                                <div><input style="width: 80%; height: 40px; padding: 0 5px; line-height: 40px;" type="text" name="email" placeholder="your email address"></div>
                                <div><input type="submit" style="width: 80%; margin: 10px 0;" class="btn btn-danger" value="SUBSCRIBE"></div>
                            </form>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 text-left" style="margin: 25px;">
                            <p><i class="fa fa-check-square-o" aria-hidden="true"></i> Nhận thông báo beat, karaoke mới nhất</p>
                            <p><i class="fa fa-check-square-o" aria-hidden="true"></i> Nhận các chương trình ưu đãi đặc biệt</p>
                            <p><i class="fa fa-check-square-o" aria-hidden="true"></i> Nhận danh sách beat, karaoke hàng </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-bottom" style="background: #4d4d4d;">
            <ul>
                <li><a href="{{ route('page.detail','huong-dan-giao-dich') }}">Hướng dẫn giao dịch</a></li>
                <li><a href="{{ route('page.detail','bang-gia') }}">Bảng Giá</a></li>
                <li><a href="{{ route('page.detail.datbai') }}">Đặt Bài</a></li>
                <li><a href="{{ route('page.lienhe') }}">Liên Hệ</a></li>
            </ul>
        </div>
        <div class="container">
            <div style="margin-bottom: 20px;" class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4>Vietnam</h4>
                    <h5><strong>Hotline: +84984347346 | Email: <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=bestktv2014@gmail.comsu=Feeback_From_Best_KTV" target="_blank" rel="noopener">bestktv2014@gmail.com</a></strong></h5>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4>USA</h4>
                    <h5><strong>Phone: 480 329 7930 | Email: <a href="mailto:admin@best-ktv.com">admin@best-ktv.com</a></strong></h5>
                </div>
            </div>

            <div style="margin-bottom: 10px; border-top: 1px solid #ddd; padding-top: 20px;" class="">
            Join us: <a href="https://plus.google.com/+bestktv2014" target="_blank"><span class="fa fa-google-plus"></span></a> <a href="https://www.facebook.com/bestktv2014/" target="_blank"><span class="fa fa-facebook"></span></a>
            <br>
            Copyright © 2017 Best KTV, All Rights Reserved
            </div>

            <p>By <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=longuyvinh.ny@gmail.com&su=Feeback_From_Best_KTV">longuyvinh</a>
            </p>

        </div>
    </footer>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script async src="//static.zotabox.com/8/e/8ee75f062a863b0140b004a1cb3d8b7c/widgets.js"></script>
    <script>
    $(document).ready(function(){
        $(document).click(function (e) {
            if ($(e.target).parents("#search-list").length === 0) {
                $("#search-list").hide();
            }
        });

        $("#search-box").keyup(function(){
            //var selected = $("#select-option option:selected").val();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
            type: "POST",
            url: "{{ route('listsearch') }}",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                /*$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");*/
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background","#FFF");
            }
            });
        });
    });

    function selectCountry(slug, name) {
        $("#search-box").val(name);
        $("#keyword").val(slug);
        $("#suggesstion-box").hide();
    }

    </script>
    @yield('extra-js')

</body>
</html>
