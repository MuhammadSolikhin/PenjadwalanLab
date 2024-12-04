@extends('layouts.main')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detail Data User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Lengkap:</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label>Email Address:</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <p>{{ ucfirst($user->role) }}</p>
                        </div>
                        <div class="form-group">
                            <label>Dibuat pada:</label>
                            <p>{{ $user->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Terakhir diperbarui:</label>
                            <p>{{ $user->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection
