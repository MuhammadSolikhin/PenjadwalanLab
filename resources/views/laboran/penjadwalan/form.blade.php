@extends('layouts.main')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Penjadwalan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penjadwalan.generate') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="status" class="form-label">Jenis Penjadwalan</label>
                                <select class="form-control" name="jenis" id="status" class="form-select">
                                    <option value="generate">Generate</option>
                                    <option value="tentatif">Tentatif</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <input type="text" name="keperluan" id="keperluan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="lab_ids" class="form-label">Pilih Lab</label>
                                <select class="form-control" name="lab_ids[]" id="lab_ids" multiple required>
                                    @foreach($labs as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->name }} ({{ $lab->kapasitas }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jam_ids" class="form-label">Pilih Jam</label>
                                <select class="form-control" name="jam_ids[]" id="jam_ids" multiple required>
                                    @foreach($jams as $jam)
                                        <option value="{{ $jam->id }}">{{ $jam->waktu_mulai }} - {{ $jam->waktu_selesai }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Buat Penjadwalan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
@endsection