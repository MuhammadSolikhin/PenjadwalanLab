@extends('layouts.main')
@section('content')
  
<section class="content">
    <div class="container-fluid">
        <form action="{{ $page_meta['url'] }}" method="POST">
            @method($page_meta['method']) 
            @csrf

            @if(auth()->user()->role == 'laboran' || auth()->user()->role == 'admin')
                <div class="col-12 mb-3">
                    <label for="user">Nama User</label>
                    <select name="user_id" id="user" class="form-control @error('user_id') is-invalid @enderror">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $selectedUserId) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @endif

            <div class="col-12 mb-3">
                <label for="laboratorium">Laboratorium</label>
                <select name="lab_id" id="laboratorium" class="form-control @error('lab_id') is-invalid @enderror">
                    @foreach($laboratoriums as $laboratorium)
                        <option value="{{ $laboratorium->id }}" {{ old('lab_id', $selectedLaboratoriumId) == $laboratorium->id ? 'selected' : '' }}>{{ $laboratorium->name }}</option>
                    @endforeach
                </select>
                @error('lab_id')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="tanggal-mulai">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" id="tanggal-mulai" class="form-control @error('tgl_mulai') is-invalid @enderror" value="{{ old('tgl_mulai') }}">
                @error('tgl_mulai')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="tanggal-selesai">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" id="tanggal-selesai" class="form-control @error('tgl_selesai') is-invalid @enderror" value="{{ old('tgl_selesai') }}">
                @error('tgl_selesai')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="keperluan">Keperluan</label>
                <textarea name="keperluan" id="keperluan" class="form-control @error('keperluan') is-invalid @enderror">{{ old('keperluan') }}</textarea>
                @error('keperluan')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if(auth()->user()->role == 'laboran' || auth()->user()->role == 'admin')
                <div class="col-12 mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="status" value="pending">
            @endif
           
            <div class="col-12 d-flex justify-content-end">
                <button type="reset" class="btn btn-danger mr-2">Reset</button>
                <button type="submit" class="btn btn-primary">{{ $page_meta['button_text'] }}</button>
            </div> 
        </form>
    </div>
</section>
@endsection