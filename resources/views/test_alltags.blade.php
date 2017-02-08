<html>
<body>


<h2>Displaying Data</h2>

<p>{{--comment--}}</p>
<p>{{'regular' }}</p>
<p>{!!'raw'!!}</p>
<p>@{{'skip regular'}}</p>
<p>@{!!'skip raw'!!}</p>
<p>{{$name or 'Default'}}</p>
<p>{!!$name or 'Default'!!}</p>
<p>{{'feed line' }}
    Next Line
</p>


<h2>Defining and Extending a Layout</h2>

@extends('layouts.app')
@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@yield('content')
@yield('title', 'default title')


<h2>Including Sub-Views</h2>

@include('_test-partial')
@include('view.name', ['some' => 'data'])


<h2>If Statements</h2>

@if (count($records) === 1)
    I have one record!
@elseif (count($records) > 1)
    I have multiple records!
@else
    I don't have any records!
@endif


<h2>Loops</h2>

@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
@endforeach

@foreach ($users as $key => $user)

    <li>{{ $user->name }}</li>

    @if ($user->type == 1)
        @continue
    @endif

    @if ($user->number == 5)
        @break
    @endif

    @continue($user->type == 1)

    @break($user->number == 5)

@endforeach

@while (false)
    <p>I'm looping never.</p>
@endwhile


<h2>Check authorization and permissions</h2>

@can('delete-item')
@elsecan('delete-item')
@elsecan
@endcan

@cannot('delete-item')
@elsecannot('delete-item')
@elsecannot
@endcannot


<h2>PHP</h2>

@php
    // PHP code
    $d = 3;
@endphp

</body>
</html>
