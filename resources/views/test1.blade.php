@extends('test_layout')

@section('title', 'Title defined in Test 1 [@parent]')

@section('content')

            <div style="margin-left:50px">

                <h3>Test 1</h3>

                <p><b>Include Partial by Test 1:</b></p>
                @include('_test_partial')

                <p>End of Test 1</p>
            </div>

@endsection