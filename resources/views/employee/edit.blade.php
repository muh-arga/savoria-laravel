@extends('layouts.app')

@section('content')
    <div class="col-md-12 p-5">
        <h1 class="mb-4">Edit
            Karyawan</h1>

        <form action="{{ route('update.employee', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4>Biodata Karyawan</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 row px-3">
                            <label for="name" class="col-4 col-form-label">Nama Karyawan*:</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $employee->nama_karyawan }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 row px-3">
                            <label for="birth" class="col-4 col-form-label">Tanggal Lahir:</label>
                            <div class="col-8">
                                <input type="date" class="form-control" id="birth" name="birth"
                                    value="{{ $employee->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 row
                            px-4">
                            <label for="address" class="col-2 col-form-label ps-1">Alamat:</label>
                            <div class="col-10 ps-0 pe-4">
                                <textarea class="form-control w-100" name="address" id="address" rows="10">{{ $employee->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 row
                            px-4">
                            <label for="email" class="col-2 col-form-label ps-1">Email:</label>
                            <div class="col-10 ps-0 pe-4">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $employee->email }}">
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
                                    @if ($employee->family->isEmpty())
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
                                    @endif
                                    @foreach ($employee->family as $family)
                                        <tr>
                                            <td class="h2 {{ $loop->first ? 'text-success' : 'text-danger' }}">
                                                @if ($loop->first)
                                                    <i type="button" class="bi bi-plus-circle btn-add"></i>
                                                @else
                                                    <i type="button" class="bi bi-dash-circle btn-delete"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-select"
                                                    name="family[{{ $loop->iteration }}][relationship]">
                                                    <option value="" selected>--select--</option>
                                                    <option value="Ibu"
                                                        {{ $family->hubungan_keluarga == 'Ibu' ? 'selected' : '' }}>Ibu
                                                    </option>
                                                    <option value="Ayah"
                                                        {{ $family->hubungan_keluarga == 'Ayah' ? 'selected' : '' }}>Ayah
                                                    </option>
                                                    <option value="suami"
                                                        {{ $family->hubungan_keluarga == 'suami' ? 'selected' : '' }}>Suami
                                                    </option>
                                                    <option value="istri"
                                                        {{ $family->hubungan_keluarga == 'istri' ? 'selected' : '' }}>Istri
                                                    </option>
                                                    <option value="anak"
                                                        {{ $family->hubungan_keluarga == 'anak' ? 'selected' : '' }}>Anak
                                                    </option>
                                                    <option value="saudara"
                                                        {{ $family->hubungan_keluarga == 'saudara' ? 'selected' : '' }}>
                                                        Saudara
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="family[{{ $loop->iteration }}][name]"
                                                    value="{{ $family->nama_anggota_keluarga }}">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control"
                                                    name="family[{{ $loop->iteration }}][birth]"
                                                    value="{{ $family->tanggal_lahir_anggota_keluarga }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i> Simpan</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let count = $('#family tbody tr').length;
            $('#family').on('click', '.btn-add', function() {
                count++;
                let html = `
                    <tr>
                        <td class="h2 text-danger">
                            <i type="button" class="bi bi-dash-circle btn-delete"></i>
                        </td>
                        <td>
                            <select class="form-select" name="family[${count}][relationship]">
                                <option value="" selected>--select--</option>
                                <option value="suami">Suami</option>
                                <option value="istri">Istri</option>
                                <option value="anak">Anak</option>
                                <option value="orang tua">Orang Tua</option>
                                <option value="saudara">Saudara</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="family[${count}][name]">
                        </td>
                        <td>
                            <input type="date" class="form-control" name="family[${count}][birth]">
                        </td>
                    </tr>
                `;
                $('#family tbody').append(html);
            });

            $('#family').on('click', '.btn-delete', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
