<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <title>Error</title>
    <meta charset="utf-8"/>
    <meta name="base-url" content="{{request()->baseUrl()}}"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/error.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        function scrollToErrorLine()
        {
            var list = $('#code');
            var line = list.data('line');
            var td = list.find('td:eq(0)');
            var br = td.find('span.errorline');
            list.scrollTop((br.length ? br.offset().top : 0) - list.offset().top + list.scrollTop() - list.height() / 2);
        }
        jQuery(document).ready(function() {
            scrollToErrorLine();
        });
    </script>
</head>
<body>
<div class="error-debug-section">
    <div class="title">{{$title}}</div>
    <div class="subtitle">{{$subtitle}}</div>
    @if(!empty($message))
        <div class="row">
            <div class="col-md-12">
                <h3 class="bg-danger">{{$message}}</h3>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">File: {{$file}} (line {{$line}})</div>
                <div id="code" class="panel-body">
                    {!!$source!!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Request ({{request()->method()}}):  {{request()->fullUrl()}}</div>
                <div id="trace" class="panel-body">
                    {!!$trace!!}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>