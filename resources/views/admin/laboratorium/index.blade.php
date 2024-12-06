@extends('layouts.main')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
@endpush 
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            {{-- <x.validation-message></x.validation-message> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <h3 class="card-title mb-2 mb-md-0">Data Laboratorium</h3>
                            <a href="{{ route('admin.laboratorium.create') }}" class="col-12 col-md-3 btn btn-primary">
                                <i class="fas fa-solid fa-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Laboratorium</th>
                                    <th>Lokasi</th>
                                    <th>Kapasitas</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laboratoriums as $laboratorium)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $laboratorium->name}}</td>
                                        <td>{{ $laboratorium->lokasi}}</td>
                                        <td>{{ $laboratorium->kapasitas}}</td>
                                        <td>{{ $laboratorium->status}}</td>
                                        <td>
                                            <a href="{{ route('admin.laboratorium.edit', $laboratorium) }}" class="text-dark bg-primary p-2 rounded">
                                                <i class="fas fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="" class="text-dark bg-danger rounded p-2 ml-2">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('AdminLte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush