@extends('layouts.master')

@section('extra-css')
<style>
input.input-animate { height: 45px;}
.input-animate { -webkit-appearance: none; padding: 0;cursor: text; border: 0; border-bottom: 1px solid #ccc; margin-bottom: 15px;
  display: block;
  width: 100%;
  font-size: 20px;
  color: #555555;
  line-height: 1.2;
}

input.input-animate:focus, textarea.input-animate:focus{ outline: 0; border-bottom: 1px solid #d9534f !important; }

input.input-animate:not(:focus){ outline: 0; border-bottom: 1px solid #ccc !important; }

span.focus-input-animate { margin: 0 15px; font-weight: 800; }
span.focus-input-animate::after { font-size: 20px; color: #333; }
.focus-input-animate {
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
}

.focus-input-animate::before {
  content: ""; padding: 0 15px;
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;

  background: rgba(219,21,99,1);
  background: -webkit-linear-gradient(45deg, #d5007d, #e53935);
  background: -o-linear-gradient(45deg, #d5007d, #e53935);
  background: -moz-linear-gradient(45deg, #d5007d, #e53935);
  background: linear-gradient(45deg, #d5007d, #e53935);
}

.focus-input-animate::after {
  content: attr(data-placeholder);
  display: block;
  /*width: 100%;*/
  position: absolute;
  top: 0px;
  left: 0;
  font-size: 13px;
  color: #999999;
  line-height: 1.2;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

input.input-animate + .focus-input-animate::after { top: 16px; left: 0; }
textarea.input-animate {
	min-height: 115px;
	padding-top: 13px;
	padding-bottom: 13px;
}
textarea.input-animate + .focus-input-animate::after { top: 16px; left: 0; }
.input-animate:focus + .focus-input-animate::after { top: -13px; }
.input-animate:focus + .focus-input-animate::before { /*width: 100%;*/ 	}

.has-val.input-animate + .focus-input-animate::after { top: -13px; }
.has-val.input-animate + .focus-input-animate::before { /*width: 100%;*/ }
</style>
@endsection

@section('content')
<div class="container">
  @if (session()->has('success_message'))
      <div class="alert alert-success">
          {{ session()->get('success_message') }}
      </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="alert alert-success" id="box-message-success"></div>

  <div class="alert alert-danger" id="box-message-error"></div>

	<div class="box-heading">
		<h2>Đặt Bài</h2>
	</div>
	<form action="{{ route('page.store.datbai') }}" method="post" name="frmDatbai">
		{!! csrf_field() !!}
		<div class="section-contact">
			<div class="row">
				<div class="col-md-6">
					<input type="text" name="fullname" id="frm-datbai-fullname" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Name"></span>
				</div>

				<div class="col-md-6">
					<input type="text" name="email" id="frm-datbai-email" class="input-animate" placeholder="" required>
					<span class="focus-input-animate" data-placeholder="Email"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input type="text" name="phone" id="frm-datbai-phone" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Điện thoại liên lạc"></span>
				</div>
        <div class="col-md-6">
					<input type="text" name="country" id="frm-datbai-country" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Quốc gia"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
          <input type="text" name="song" id="frm-datbai-song" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Tên bài hát"></span>
				</div>
			</div>
      <div class="row">
				<div class="col-md-12">
          <input type="text" name="singer" id="frm-datbai-singer" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Ca sĩ"></span>
				</div>
			</div>

      <div class="row">
				<div class="col-md-12">
          <input type="text" name="link" id="frm-datbai-link" class="input-animate" placeholder="">
					<span class="focus-input-animate" data-placeholder="Link"></span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<input type="submit" name="submit" value="Đặt Bài" class="btn btn-danger" id="contact-submit">
				</div>
			</div>
		</div>
	</form>

</div>
@endsection

@section('extra-js')
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        })();

				(function ($) {
				    "use strict";
				    $('.input-animate').each(function(){
				        $(this).on('blur', function(){
				            if($(this).val().trim() != "") {
				                $(this).addClass('has-val');
				            }
				            else {
				                $(this).removeClass('has-val');
				            }
				        })
				    });

					})(jQuery);

        $(document).ready(function(){
            $('#box-message-error').hide();
            $('#box-message-success').hide();
        });
    </script>
@endsection
