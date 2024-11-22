@extends('layouts.main')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>edit add</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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