@extends('layouts.main')
@section('content')
  
<section class="content">
    <div class="container-fluid">
        <form action="{{ $page_meta['url'] }}" method="POST">
            @method($page_meta['method']) 
            @csrf
            <div class="col-12 mb-3">
                <label for="name-barang">Nama Barang</label>
                <input type="text" name="name" id="name-barang" class="form-control @error('name') is-invalid @enderror" autocomplete="off" value="{{ old('name', $barang->name) }}">    
                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="spesification-barang">Spesifikasi</label>
                <textarea name="spesification" id="spesification-barang" class="form-control @error('spesification') is-invalid @enderror" autocomplete="off" style="min-height:100px; max-height:100px;">{{ old('spesification', $barang->spesification) }}</textarea>
                @error('spesification')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="description-barang">Deskripsi</label>
                <textarea name="description" id="description-barang" class="form-control @error('description') is-invalid @enderror" autocomplete="off" style="min-height:100px; max-height:100px;">{{ old('description', $barang->description) }}</textarea>
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