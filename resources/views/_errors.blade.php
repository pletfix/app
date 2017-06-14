@if(error() !== null)
    @foreach(error() as $i => $error)
        @if(is_int($i))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $error }}
            </div>
        @endif
    @endforeach
@endif