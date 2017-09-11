<div class="search">
    <form method="GET" action="{{request()->url()}}" accept-charset="UTF-8" class="form-inline">
        @foreach(request()->input() as $key => $value)
            @if(!in_array($key, ['search', 'page']))
                <input name="{{$key}}" value="{{$value}}" type="hidden"/>
            @endif
        @endforeach
        <input name="page" value="" type="hidden"/>
        <div class="input-group has-feedback has-clear {{empty(request()->input('search')) ? 'has-empty-value' : ''}}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </button>
            </span>
            <input name="search" value="{{request()->input('search')}}" type="text" class="form-control has-feedback has-clear" placeholder="Search..."/>
            <span class="glyphicon glyphicon-remove form-control-feedback form-control-clear" aria-hidden="true" title="reset search" data-clear-redirect="{{url()}}"></span>
        </div>
    </form>
</div>