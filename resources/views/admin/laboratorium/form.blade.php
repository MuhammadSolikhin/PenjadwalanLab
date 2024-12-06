@extends('layouts.main')
@section('content')
  
<section class="content">
    <div class="container-fluid">
        <form action="{{ $page_meta['url'] }}" method="POST">
            @method($page_meta['method']) 
            @csrf
            <div class="col-12 mb-3">
                <label for="name-laboratorium">Nama Laboratorium</label>
                <input type="text" name="name" id="name-laboratorium" class="form-control @error('name') is-invalid @enderror" autocomplete="off" value="{{ old('name', $laboratorium->name) }}">    
                @error('name')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="lokasi-laboratorium">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi-laboratorium" class="form-control @error('lokasi') is-invalid @enderror" autocomplete="off" value="{{ old('lokasi', $laboratorium->lokasi) }}">    
                @error('lokasi')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="kapasitas-laboratorium">Kapasitas</label>
                <input type="text" name="kapasitas" id="kapasitas-laboratorium" class="form-control @error('kapasitas') is-invalid @enderror" autocomplete="off" value="{{ old('kapasitas', $laboratorium->kapasitas) }}">    
                @error('kapasitas')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="status-laboratorium">Status</label>
                <select 
                    name="status" 
                    id="status-laboratorium" 
                    class="form-control @error('status') is-invalid @enderror"
                >
                    <option value="" disabled {{ old('status', $laboratorium->status) === null ? 'selected' : '' }}>
                    Pilih Status
                    </option>
                    <option value="aktif" {{ old('status', $laboratorium->status) === 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="tidak aktif" {{ old('status', $laboratorium->status) === 'tidak aktif' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
                @error('status')
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