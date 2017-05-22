<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <title>Error</title>
    <meta charset="utf-8"/>
    <meta name="base-url" content="{{request()->baseUrl()}}"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/error.css')}}"/>
    <!--suppress CssUnusedSymbol -->
    <style>
        body {
            padding-top: 30px;
        }
        div.title {
            font-size: 36px;
            margin-bottom: 10px;
        }
        div.subtitle {
            /*font-weight: bold;*/
            margin-bottom: 10px;
        }
        h3.bg-danger {
            font-size: 16px;
            margin-bottom: 20px;
        }
        table.code td:first-child {
            text-align: right;
            background: #f0f0f0;
            color: #aaaaaa;
            padding-left: 5px;
            padding-right: 5px;
        }
        table.code td:nth-child(2) {
            text-align: left;
            padding-left: 3px;
        }
        table.code span.errorline {
            color: white;
            background: red;
        }
        code {
            background: inherit;
            color: inherit;
            padding: 0;
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            font-size: 12px;
        }
        div#code {
            /*border: 1px solid grey;*/
            padding: 0;
            width: 100%;
            height: 260px;
            overflow: auto;
            text-align: left;
        }
        div#code pre {
            padding: 0;
            margin: 0;
            line-height: 20px;
            border: 0;
        }
        div#trace {
            /*border: 1px solid grey;*/
            padding: 0;
            padding-top: 10px;
            width: 100%;
            height: 260px;
            overflow: auto;
            text-align: left;
            white-space: nowrap;
        }
        div#trace ul {
            padding-left: 30px;
        }
        div.panel-heading {
            font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
            font-size: 13px;
            text-align: left;
        }
    </style>
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
    <div class="container">
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
