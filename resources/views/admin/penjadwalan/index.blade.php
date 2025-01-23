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
                            <a href="{{ route('penjadwalan.create') }}" class="col-12 col-md-3 btn btn-primary">
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
                                    <th>Peminjam</th>
                                    <th>Lab</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjadwalan as $jadwal)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $jadwal->user->name}}</td>
                                        <td>{{ $jadwal->laboratorium->name}}</td>
                                        <td>{{ $jadwal->status}}</td>
                                        <td>{{ $jadwal->tgl_mulai}}</td>
                                        <td>{{ $jadwal->tgl_selesai}}</td>
                                        <td>
                                            <form id="delete-form-{{ $jadwal->id }}"
                                                action="{{ route('penjadwalan.destroy', $jadwal->id) }}" method="POST">

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('penjadwalan.show', $jadwal->id) }}">
                                                    <i class="fas fa-list"></i> Show</a>

                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('penjadwalan.edit', $jadwal->id) }}">
                                                    <i class="fas fa-edit"></i> Edit</a>

                                                @csrf
                                                @method('DELETE')

                                                <!-- Trigger Modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#confirmDeleteModal"
                                                    onclick="setDeleteForm({{ $jadwal->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Peminjam</th>
                                    <th>Lab</th>
                                    <th>Status</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this data? This action cannot be undone.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="confirmDelete()">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script>
        let deleteFormId = null;

        // Set the form ID to delete
        function setDeleteForm(id) {
            deleteFormId = `delete-form-${id}`;
        }

        // Confirm delete action
        function confirmDelete() {
            if (deleteFormId) {
                const form = document.getElementById(deleteFormId);
                if (form) {
                    form.submit();
                } else {
                    console.error(`Form with ID ${deleteFormId} not found.`);
                }
            } else {
                console.error('Delete form ID is not set.');
            }
        }

    </script>
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