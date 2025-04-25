@extends('html.html')

@push('css')
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/3.0.0/css/select.bootstrap5.css" rel="stylesheet">
    <style>
        /* Jika ingin warna teks tetap hitam, gunakan ini */
        .table.dataTable tbody tr.selected td {
            color: black !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/3.0.0/js/select.bootstrap5.js"></script>
    {{-- datatables --}}
    <script>
        $(document).ready(function () {
            // Mendeklarasikan dan menginisialisasi variabel table dengan DataTable
            var table = $('.table').DataTable({
                columnDefs: [
                    {
                        orderable: false,
                        render: DataTable.render.select(),
                        targets: 0
                    }
                ],
                order: [],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                info: true,
            });

            // Menangani klik pada tombol hapus
            $('#btnHapus').on('click', function () {
                // Mendapatkan data dari baris yang dipilih
                var selectedRows = table.rows({ selected: true }).data();

                // Mengecek apakah ada baris yang dipilih
                if (selectedRows.length === 0) {
                    Swal.fire({
                        text: 'Tidak ada data yang dipilih',
                        icon: 'warning',
                        confirmButtonText:'OK',
                        showCloseButton: true,
                        timer: 2000,
                    })
                } else {
                    // Mengambil ID dari baris yang dipilih
                    var selectedIds = [];
                    selectedRows.each(function (rowData) {
                        console.log(rowData);
                        selectedIds.push(rowData[0]); // ID pegawai ada di kolom pertama (index 0)
                    });

                    // Menyimpan ID yang dipilih ke input hidden dalam form
                    $('#hapusId').val(selectedIds.join(','));

                    // Menampilkan modal hapus
                    $('#hapusModal').modal('show');
                }
            });
    });

    </script>
    {{-- chart domisili --}}
    <script>
        const domisili = document.getElementById('domisili');

        new Chart(domisili, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 2, // 1 artinya tinggi = lebar
            }
        });
    </script>
    {{-- chart golongan --}}
    <script>
        const golongan = document.getElementById('golongan');

        new Chart(golongan, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 2, // 1 artinya tinggi = lebar
            }
        });
    </script>
@endpush


@section('content')
    @include('components.navbar')

    @include('components.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-capitalize">Kelola Pegawai</h1>
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
                <div class="col-12" id="kelola-admin">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Kelola Pegawai</h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex flex-column flex-md-row justify-content-start mb-2">
                                    <div class="me-md-2 mb-2 mb-md-0">
                                        <button class="btn btn-main" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                            <i class="bi bi-plus-circle-fill"></i> Tambah Baru
                                        </button>
                                    </div>
                                    <div class="me-md-2 mb-2 mb-md-0">
                                        <button class="btn btn-danger" id="btnHapus">
                                            <i class="bi bi-trash"></i> Hapus Pilihan
                                        </button>
                                    </div>
                                </div>
                                <a class="btn btn-main" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    Filter <i class="bi bi-filter-right"></i>
                                </a>
                            </div>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Tahun Pengabdian</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Gol.</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataPegawai as $index => $data )
                                        <tr>
                                            <td>{{ $data->id_user }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->jabatan->nama_jabatan }}</td>
                                            <td>{{ $data->tanggal_masuk }}</td>
                                            @php
                                                $selisih = \Carbon\Carbon::parse($data->tanggal_masuk)->diff(\Carbon\Carbon::now());

                                                // Ambil tahun dan bulan
                                                $tahun = $selisih->y;
                                                $bulan = $selisih->m;
                                            @endphp
                                            <td>{{ $tahun }} tahun {{ $bulan }} bulan</td>
                                            <td>{{ $data->user->email }}</td>
                                            <td>{{ $data->golongan->nama_golongan }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn rounded-3" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('hrd.kelola.pegawai.edit.page',['pegawai' => '1']) }}">
                                                                <i class="bi bi-pencil-square"></i> Detail Profil
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('hrd.kelola.pegawai.rekap.absen.page',['pegawai' => '1']) }}">
                                                                <i class="bi bi-calendar-check"></i>Rekap Absensi
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card p-3">
                        <h5 class="card-title">Domisili Pegawai</h5>
                        <canvas id="domisili"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card p-3">
                        <h5 class="card-title">Golongan Pegawai</h5>
                        <canvas id="golongan"></canvas>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    {{-- filter offcanvas --}}
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter Tabel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex justify-content-start align-items-start flex-wrap gap-3">
                <div class="collapse-group">
                    <a class="text-dark" data-bs-toggle="collapse" href="#kecamatan" role="button">
                        Kecamatan <i class="bi bi-chevron-compact-down"></i>
                    </a>
                    <div class="collapse" id="kecamatan">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkChecked">
                                Checked checkbox
                            </label>
                        </div>
                    </div>
                </div>
                <div class="collapse-group">
                    <a class="text-dark" data-bs-toggle="collapse" href="#golonganDarah" role="button">
                        Golongan Darah <i class="bi bi-chevron-compact-down"></i>
                    </a>
                    <div class="collapse" id="golonganDarah">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkChecked">
                                Checked checkbox
                            </label>
                        </div>
                    </div>
                </div>
                <div class="collapse-group">
                    <a class="text-dark" data-bs-toggle="collapse" href="#rentangUsia" role="button">
                        Rentang Usia <i class="bi bi-chevron-compact-down"></i>
                    </a>
                    <div class="collapse" id="rentangUsia">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkChecked">
                                Checked checkbox
                            </label>
                        </div>
                    </div>
                </div>
                <div class="collapse-group">
                    <a class="text-dark" data-bs-toggle="collapse" href="#golonganPegawai" role="button">
                        Golongan Pegawai <i class="bi bi-chevron-compact-down"></i>
                    </a>
                    <div class="collapse" id="golonganPegawai">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkDefault">
                                Default checkbox
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="checkChecked">
                                Checked checkbox
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-main">
                    Telusuri <i class="bi bi-caret-right"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- tambah modal --}}
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tambah Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hrd.kelola.pegawai.store') }}" method="post" enctype="multipart/form-data">
                        @csrf @method('post')
                        <div class="container-fluid">
                            <div class="row gy-2">
                                <div class="col-12">
                                    <label for="">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                    <h1 class="modal-title fs-5">Hapus Pegawai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hrd.kelola.pegawai.mass.delete') }}" method="post">
                        @csrf @method('delete')
                        <div class="container-fluid">
                            <input type="hidden" name="id" id="hapusId">
                            <h4 class="text-capitalize">
                                Apakah anda yakin ingin <span class="text-danger fw-bold">menghapus data</span> yang dipilih ?</span>
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
