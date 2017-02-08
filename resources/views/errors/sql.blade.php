<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <base href="{{ request()->baseUrl() }}"/>
    <title>Error</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/error.css') }}"/>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function scrollToErrorLine()
        {
            var list = $('#code');
            var line = list.data('line');
            var td = list.find('td:eq(0)');
            var br = td.find('br').eq(line);
            list.scrollTop((br.length ? br.offset().top : 0) - list.offset().top + list.scrollTop() + - list.height()*2/3);
        }
        jQuery(document).ready(function() {
            scrollToErrorLine();
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title">SQL Error</div>
            <div class="subtitle">
                @if(isset($exception->errorInfo[0]))
                    <span>ANSI SQLSTATE Error Code: {{ $exception->errorInfo[0] }}</span><br/>
                @endif
                @if(isset($exception->errorInfo[1]))
                    <span>Driver-specific Error Code: {{ $exception->errorInfo[1] }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="bg-danger">{{ !empty($exception->errorInfo[2]) ? $exception->errorInfo[2] : $exception->getMessage() }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <pre>File:  {{ trim(str_replace(base_path(), '', $exception->getFile()), '\/ ') }} (line {{ $exception->getLine() }}) </pre>
                </div>
            </div>
            <div class="row">
                <div id="code" data-line="{{ $exception->getLine() }}" class="class col-xs-12" style="border: 1px solid grey; width: 600px; height: 200px; overflow: auto">
                    {!! $sql !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <pre>Bindings: [{{ implode(', ', $exception->getBindings()) }}]</pre>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
