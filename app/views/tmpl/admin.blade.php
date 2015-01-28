<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
        
    	<title>@yield('title')</title>
        <!-- Bootstrap core CSS -->
    	<link rel="stylesheet" type="text/css" href="/packages/bootstrap-3.1.1-dist/css/bootstrap.min.css">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
        <!-- Placed at the end of the document so the pages load faster -->
    	<script src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
        <script src="/packages/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>
        <script src="/js/tinymce/tinymce.min.js"></script>
        @yield('_head')
    </head>

    <body>
        @if(Auth::user())
        @include('admin.partial.header')
        <div class="container-fluid">
            <div class="row">
                @include('admin.partial.navigation')
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @endif
                    @yield('content')
        @if(Auth::user())
                </div>
            </div>
        </div>
        @yield('_tail')
        @endif
    </body>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
         });
    </script>
</html>