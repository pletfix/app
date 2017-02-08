{{--@section('title', 'Title defined in Partial')--}}

<div style="margin-left:50px">
    <h4>Partial</h4>
    <p>Name: {{$name}}</p>
    <p>Age: {{$age or 'missing'}}</p>
    {{--{{dump(get_defined_vars())}}--}}
</div>
