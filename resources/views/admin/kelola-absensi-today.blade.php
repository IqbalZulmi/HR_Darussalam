@extends('html.html')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/styles/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/styles/layout.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/index.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search-name').select2({
                dropdownParent: $('#tambahModal')
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const { Calendar } = window.VanillaCalendarPro;

            const options = {
                selectedTheme: 'light' // Pastikan tema cocok dengan yang di-load di <head>
            };

            const calendar = new Calendar('#calendar', options);
            calendar.init();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                info: false,
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
            <h1 class="text-capitalize">Absensi</h1>
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
                {{-- tabel pengajuan cuti --}}
                <div class="col-lg-8" id="kelola-admin">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Absensi Hari ini</h5>
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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Andi Pratama</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <div class="p-2">
                                                <button class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <div id="calendar"></div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->

    {{-- tambah modal --}}
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Absensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf @method('post')
                        <div class="container-fluid">
                            <div class="row gy-2">
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
                                    <label for="exampleFormControlInput1" class="form-label">Jam Masuk</label>
                                    <input name="jam_masuk" type="datetime-local" class="form-control @error('jam_masuk') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Jam Keluar</label>
                                    <input name="jam_keluar" type="datetime-local" class="form-control @error('jam_keluar') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlInput1" class="form-label">Tipe Absen</label>
                                    <select name="tipe" class="form-select @error('tipe') is-invalid @enderror">
                                        <option value="">Hadir</option>
                                        <option value="">Sakit</option>
                                        <option value="">Izin</option>
                                        <option value="">Cuti</option>
                                    </select>
                                    @error('tipe')
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

    {{-- editModal --}}
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Absensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf @method('post')
                        <div class="container-fluid">
                            <div class="row gy-2">
                                <div class="d-flex flex-column">
                                    <label for="">Nama</label>
                                    <select name="nama" class="form-select @error('nama') is-invalid @enderror" disabled>
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
                                    <label for="exampleFormControlInput1" class="form-label">Jam Masuk</label>
                                    <input name="jam_masuk" type="datetime-local" class="form-control @error('jam_masuk') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Jam Keluar</label>
                                    <input name="jam_keluar" type="datetime-local" class="form-control @error('jam_keluar') is-invalid @enderror" value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="exampleFormControlInput1" class="form-label">Tipe Absen</label>
                                    <select name="tipe" class="form-select @error('tipe') is-invalid @enderror">
                                        <option value="">Hadir</option>
                                        <option value="">Sakit</option>
                                        <option value="">Izin</option>
                                        <option value="">Cuti</option>
                                    </select>
                                    @error('tipe')
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

    {{-- hapus modal --}}
    <div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Hapus Absensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('role.store') }}" method="post">
                        @csrf @method('delete')
                        <div class="container-fluid">
                            <h4 class="text-capitalize">
                                Apakah anda yakin ingin <span class="text-danger fw-bold">menghapus absensi</span> Ahmad?</span>
                            </h4>
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
