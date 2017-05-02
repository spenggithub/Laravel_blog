<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/app.js"></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/wangEditor.min.css">
    <title>微博 - @yield('title','Sample')</title>
</head>
<body>
@include('layouts._header')
<div class="container">
    <div class="col-md-12">
        @include('shared.messsages')
        @yield('content')
        @include('layouts._footer')

    </div>
</div>
<script src="/js/app.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/wangEditor.min.js"></script>
<script type="text/javascript">
    var editor = new wangEditor('textarea1');
    editor.create();
</script>
</body>
</html>