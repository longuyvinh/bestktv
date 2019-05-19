<!DOCTYPE html>
<html>
<head>
	<title>Send Email</title>
	<style>
		.container{width: 80%; margin: 10px auto;}
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
			<div><img src="http://best-ktv.com/images/logobeat.png" /></div>
			<div>Best KTV ( Hoà Âm - Phối Khí - Nhạc Nền - Beat / Playback - Karaoke HD ) </div>
		</div>

		<hr>

		<div style="margin: 20px;">
			<h2>All informations from your customer:</h2>
			<div style="font-size: 1.5em;">
				<p>Name: {{$input['name']}}</p>
				<p>Email: {{$input['email']}}</p>
				<p>Subject: {{$input['sub']}}</p>
				<p>Message: {{$input['mess']}}</p>
			</div>
		</div>

		<hr>

		<div class="footer">
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
				Join us: <a href="https://plus.google.com/+bestktv2014" target="_blank"><img src="https://www.gstatic.com/images/branding/product/1x/google_plus_96dp.png" /></a> <a href="https://www.facebook.com/bestktv2014/" target="_blank"></a>
				<br>
				Copyright © 2017 Best KTV, All Rights Reserved
				</div>
		</div>
	</div>
</body>
</html>
