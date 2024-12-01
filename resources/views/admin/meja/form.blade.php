@extends('layouts.main')
@section('content')

<section class="content">
    <div class="container-fluid">
        <form action="{{ $page_meta['url'] }}" method="POST">
            @method($page_meta['method']) 
            @csrf
            <div class="col-12 mb-3">
                <label for="no-meja">Nomor Meja</label>
                <input type="text" name="no" id="no-meja" class="form-control @error('no') is-invalid @enderror" autocomplete="off" value="{{ old('no', $meja->no) }}">    
                @error('no')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="reset" class="btn btn-danger mr-2">Reset</button>
                <button type="submit" class="btn btn-primary">{{ $page_meta['button_text'] }}</button>
            </div> 
        </form>
    </div>
</section>
@endsection