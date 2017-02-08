@extends('test1')

@section('title', 'Title defined in Test 2 [@parent]')

@section('content')

    <div style="margin-left:50px">

        <h2>Test 2</h2>

        <p><b>Include Parent by Test 2:</b></p>
        @parent

        <p><b>Include Partial with data by Test 2:</b></p>
        @include('_test_partial', ['age' => 30])

        <p>End of Test 2</p>
    </div>

@endsection
