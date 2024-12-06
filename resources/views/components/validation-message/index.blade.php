@if($errors->any())
    <div class="col-12 alert alert-warning alert-dismissible fade show" role="alert">
        @foreach($errors->all() as $error)
        <ul>
            <li>{!! $error !!}</li>
        </ul>    
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
        {!! session('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
