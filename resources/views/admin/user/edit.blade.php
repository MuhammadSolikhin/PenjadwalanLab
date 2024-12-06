@extends('layouts.main')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama lengkap</label>
                                <input name="name" type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="nama" 
                                    placeholder="Enter Name" 
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="exampleInputEmail1" 
                                    placeholder="Enter email" 
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password (Opsional)</label>
                                <input name="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    id="exampleInputPassword1" 
                                    placeholder="Isi jika ingin mengganti password">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" 
                                    class="form-control @error('role') is-invalid @enderror" 
                                    id="role">
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="laboran" {{ old('role', $user->role) == 'laboran' ? 'selected' : '' }}>Laboran</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="/user" class="btn btn-default">Kembali</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection
