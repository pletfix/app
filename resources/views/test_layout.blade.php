<html>
<body>

<style src="{{asset('css/app.css')}}"></style>

<h1>Layout</h1>

<p>@yield('title', 'Default Title')</p>
<p>@yield('description', 'Default Description')</p>

@yield('content')

<p>End of Layout</p>
</body>
</html>
