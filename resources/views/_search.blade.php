<div class="search">
    <form method="GET" action="{{request()->url()}}" accept-charset="UTF-8" class="form-inline">
        {{--todo!--}}
        {{--@foreach(Request::except(['search', 'page']) as $key => $value)--}}
            {{--{!! Form::hidden($key, $value) !!}--}}
        {{--@endforeach--}}
        <input name="page" value="" type="hidden"/>
        <div class="input-group has-feedback has-clear {{empty(request()->input('search')) ? 'has-empty-value' : ''}}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
            <input name="search" value="{{old('search')}}" type="text" class="form-control has-feedback has-clear" placeholder="Suche..."/>
            <span class="glyphicon glyphicon-remove form-control-feedback form-control-clear" aria-hidden="true" title="Suche zurücksetzen" data-clear-redirect="{{url()}}"></span>
        </div>
    </form>
</div>



