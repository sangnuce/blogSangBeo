@if(Session::has('flash_message'))
    <div class="col-md-12">
        <div class="alert {!! Session::get('flash_class') !!} alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-remove"></i>
            </button>
            {!! Session::get('flash_message') !!}
        </div>
    </div>
@elseif(count($errors)>0)
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">
                <i class="fa fa-remove"></i>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>

    </div>
@endif