@extends('layouts.main')
@section('content')

<section class="content">
    <div class="container-fluid">
        <form action="{{ $page_meta['url'] }}" method="POST">
            @method($page_meta['method'])
            @csrf
            <div class="col-12 mb-3">
                <label for="laboratorium-type">Nama Jenis Laboratorium</label>
                <input type="text" name="name" id="laboratorium-type" class="form-control @error('name') is-invalid @enderror" autocomplete="off" value="{{ old('name', $laboratorium_type->name) }}">    
                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="description-laboratorium-type">Deskripsi</label>
                <textarea name="description" id="description-laboratorium-type" class="form-control @error('description') is-invalid @enderror" autocomplete="off" style="min-height:100px; max-height:100px;">{{ old('description', $laboratorium_type->description) }}</textarea>
                @error('description')
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