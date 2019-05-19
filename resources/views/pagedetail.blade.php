@extends('layouts.master')

@section('content')

    <div class="container">

    	<div id="detail_content_block" class="col-md-9 col-sm-12 col-xs-12">
	    	<section>
                <div class="tinymce">
                    {!! $page->body !!}
                </div>
	    	</section>
    	</div>

    </div>

    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
    <script type="text/javascript">
        /*
        tinymce.init({
            selector: 'div.tinymce',
            theme: 'inlite',
            plugins: 'image media table link paste contextmenu textpattern autolink codesample',
            insert_toolbar: 'quickimage quicktable media codesample',
            selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
            inline: true,
            paste_data_images: true,
            //content_css: [
            //'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            //'//www.tinymce.com/css/codepen.min.css']
        });
        */
    </script>
@endsection