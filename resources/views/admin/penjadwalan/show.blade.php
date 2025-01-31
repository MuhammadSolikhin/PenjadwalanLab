@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detail Penjadwalan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('penjadwalan.update-verifikasi', $penjadwalan->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="pending" {{ $penjadwalan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ $penjadwalan->status == 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="rejected" {{ $penjadwalan->status == 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
            <p><strong>Status:</strong> {{ $penjadwalan->status }}</p>
            <p><strong>Keperluan:</strong> {{ $penjadwalan->keperluan }}</p>
            <p><strong>Jenis:</strong> {{ $penjadwalan->jenis }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $penjadwalan->start_date }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $penjadwalan->end_date }}</p>
            <p><strong>User:</strong> {{ $penjadwalan->user->name }}</p>

            <h4>Laboratorium yang Digunakan:</h4>
            <ul>
                @foreach ($penjadwalan->labs as $lab)
                    <li>{{ $lab->name }} (Lokasi: {{ $lab->lokasi }}, Kapasitas: {{ $lab->kapasitas }})</li>
                @endforeach
            </ul>

            <h4>Filter Detail Jadwal:</h4>
            <form method="GET" action="{{ route('penjadwalan.show', $penjadwalan->id) }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ $startDate }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <h4>Detail Jadwal:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detailJadwal as $detail)
                        <tr>
                            <td>{{ $detail->tanggal }}</td>
                            <td>{{ $detail->jam->waktu_mulai }}</td>
                            <td>{{ $detail->jam->waktu_selesai }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada jadwal dalam rentang tanggal ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <a href="{{ route('admin.penjadwalan') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection