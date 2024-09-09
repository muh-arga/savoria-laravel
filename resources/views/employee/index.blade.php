@extends('layouts.app')

@section('content')
    <div class="col-8 p-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>Data Karyawan</h4>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <a href="{{ route('create.employee') }}" class="btn btn-primary"><i class="bi bi-plus me-2"></i> Tambah
                        Karyawan</a>
                </div>
                <table id="employee-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->nama_karyawan }}</td>
                                <td>{{ $employee->tanggal_lahir }}</td>
                                <td>{{ $employee->alamat }}</td>
                                <td>
                                    <div class="row gap-2">
                                        <a href="{{ route('edit.employee', $employee->id) }}"
                                            class="btn btn-warning w-auto"><i class="bi bi-pencil"></i> Edit</a>
                                        <button type="button" class="btn btn-danger w-auto delete"
                                            data-id="{{ $employee->id }}"><i class="bi bi-trash me-2"></i>Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#employee-table').DataTable();

            $('#employee-table').on('click', '.delete', function() {
                let id = $(this).data('id');

                var url = "{{ route('delete.employee', ':id') }}";
                url = url.replace(':id', id);

                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Data berhasil dihapus');
                            location.reload();
                        },
                        error: function(err) {
                            alert('Data gagal dihapus');
                        }
                    });
                }
            });
        });
    </script>
@endsection
