@extends('html.html')

@push('css')

@endpush

@push('js')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                info: true,
                dom: '<"row"<"col-sm-6 d-flex justify-content-center justify-content-sm-start mb-2 mb-sm-0"l><"col-sm-6 d-flex justify-content-center justify-content-sm-end"f>>rt<"row"<"col-sm-6 mt-0"i><"col-sm-6 mt-2"p>>'
            });
        });
    </script>
@endpush


@section('content')
    @include('components.navbar')

    @include('components.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-capitalize">Pengajuan Cuti</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('hrd.dashboard.page') }}">Home</a></li>
                    <li class="breadcrumb-item active text-capitalize">
                        {{ ucwords(str_replace('/', ' / ', Request::path())) }}
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                {{-- tabel verifikasi cuti --}}
                <div class="col-12" id="kelola-admin">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Ajukan Cuti</h5>
                            <div class="d-flex flex-column flex-md-row justify-content-start mb-2">
                                <div class="me-md-2 mb-2">
                                    <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                        <i class="bi bi-plus-circle-fill"></i> Tambah Baru
                                    </button>
                                </div>
                            </div>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal Pengajuan</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tipe Pengajuan</th>
                                        <th scope="col">Durasi</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12/04/2024</td>
                                        <td>Ayu</td>
                                        <td>Cuti Tahunan</td>
                                        <td>02 hari (02 jan - 04 jan)</td>
                                        <td>
                                            <span class="badge text-bg-warning">Menunggu</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- tabel riwayat Pengajuan --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat Ajuan</h5>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal Pengajuan</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tipe Pengajuan</th>
                                        <th scope="col">Durasi</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12/04/2024</td>
                                        <td>Ayu</td>
                                        <td>Cuti Tahunan</td>
                                        <td>02 hari (02 jan - 04 jan)</td>
                                        <td>
                                            <span class="badge text-bg-success">Disetujui</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12/04/2024</td>
                                        <td>Ayu</td>
                                        <td>Cuti Tahunan</td>
                                        <td>02 hari (02 jan - 04 jan)</td>
                                        <td>
                                            <span class="badge text-bg-danger">ditolak</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    {{-- tambah modal --}}
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Ajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf @method('post')
                        <div class="container-fluid">
                            <div class="row gy-2">
                                <div class="col-12">
                                    <label for="exampleFormControlInput1" class="form-label">Tanggal Pengajuan</label>
                                    <input name="tanggal_pengajuan" type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('tanggal_pengajuan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex flex-column">
                                    <label for="">Nama</label>
                                    <select name="nama" id="search-name" class="form-select @error('nama') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Pegawai</option>
                                        <option value="">ahmad</option>
                                        <option value="">ayu</option>
                                        <option value="">when</option>
                                        <option value="">yh</option>
                                    </select>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai</label>
                                    <input name="tanggal_mulai" type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Tanggal Selesai</label>
                                    <input name="tanggal_selesai" type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlInput1" class="form-label">Tipe Cuti</label>
                                    <select name="tipe_cuti" class="form-select @error('tipe_cuti') is-invalid @enderror">
                                        <option value="">Hadir</option>
                                        <option value="">Sakit</option>
                                        <option value="">Izin</option>
                                        <option value="">Cuti</option>
                                    </select>
                                    @error('tipe_cuti')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-main">Simpan</button>
                    </form>
                </div>
        </div>
        </div>
    </div>
    @include('components.footer')
@endsection
