@extends('layouts.main')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row pb-2">
            <x-validation-message></x-validation-message>
        </div>
        <div class="row pb-2">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('admin.jenis-laboratorium.create') }}"><button class="btn btn-primary">Tambah</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jenis Laboratorium</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratorium_types as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>
                                        <a href="{{ route('admin.jenis-laboratorium.edit', $data->slug) }}" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                    <!-- /.card-body -->
                    {{-- <div class="card-footer">
                        <a href="{{ route('admin.laboratorium-type.create') }}" class="btn btn-primary">Tambah Jenis Laboratorium</a>
                    </div> --}}
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection