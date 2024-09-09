@extends('layouts.app')

@section('content')
    <div class="col-md-12 p-5">
        <h1 class="mb-4">Tambah Karyawan</h1>

        <form action="{{ route('post.employee') }}" method="POST">
            @csrf
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Biodata Karyawan</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 row px-3">
                            <label for="name" class="col-4 col-form-label">Nama Karyawan*:</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6 row px-3">
                            <label for="birth" class="col-4 col-form-label">Tanggal Lahir:</label>
                            <div class="col-8">
                                <input type="date" class="form-control" id="birth" name="birth">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 row px-4">
                            <label for="address" class="col-2 col-form-label ps-1">Alamat:</label>
                            <div class="col-10 ps-0 pe-4">
                                <textarea class="form-control w-100" name="address" id="address" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 row px-4">
                            <label for="email" class="col-2 col-form-label ps-1">Email:</label>
                            <div class="col-10 ps-0 pe-4">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4" id="family">
                <div class="card-header bg-primary text-white">
                    <h4>Keluarga</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless w-100">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Hubungan Keluarga</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="h2 text-success">
                                    <i type="button" class="bi bi-plus-circle btn-add"></i>
                                </td>
                                <td>
                                    <select class="form-select" name="family[0][relationship]">
                                        <option value="" selected>--select--</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="suami">Suami</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                        <option value="saudara">Saudara</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="family[0][name]">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="family[0][birth]">
                                </td>
                            </tr>
                            <tr>
                                <td class="h2 text-danger">
                                    <i type="button" class="bi bi-dash-circle btn-delete"></i>
                                </td>
                                <td>
                                    <select class="form-select" name="family[1][relationship]">
                                        <option value="" selected>--select--</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="suami">Suami</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                        <option value="saudara">Saudara</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="family[1][name]">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="family[1][birth]">
                                </td>
                            </tr>
                            <tr>
                                <td class="h2 text-danger">
                                    <i type="button" class="bi bi-dash-circle btn-delete"></i>
                                </td>
                                <td>
                                    <select class="form-select" name="family[2][relationship]">
                                        <option value="" selected>--select--</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="suami">Suami</option>
                                        <option value="istri">Istri</option>
                                        <option value="anak">Anak</option>
                                        <option value="saudara">Saudara</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="family[2][name]">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="family[2][birth]">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i> Simpan</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let family = 2;

            $('.btn-add').click(function() {
                family++;
                let row = $(this).closest('tr').clone();
                row.find('i').removeClass('bi-plus-circle btn-add').addClass('bi-dash-circle btn-delete');
                row.find('select').val('').attr('name', `family[${family}][relationship]`);
                row.find('input').val('');
                row.find('input[name="family[0][birth]"]').attr('name', `family[${family}][birth]`);
                row.find('input[name="family[0][name]"]').attr('name', `family[${family}][name]`);
                row.find('.h2').removeClass('text-success').addClass('text-danger');
                $(this).closest('tbody').append(row);
            });

            $(document).on('click', '.btn-delete', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
