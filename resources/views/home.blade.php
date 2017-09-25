@extends('app')

@section('styles')
    <style>
        .content {
            text-align: center;
            padding-top: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="center">
            <div class="cover-image">
                <img src="{{url('images/pletfix_logo_gray.png')}}"/>
            </div>
        </div>
        @include('_message')
        @include('_errors')
    </div>
@endsection
