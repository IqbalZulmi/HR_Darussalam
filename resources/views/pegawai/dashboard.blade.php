@extends('html.html')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/styles/index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/styles/layout.css">
    <style>
        .status-container {
            display: flex;
            align-items: center;
            gap: 15px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .status {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .status-box {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }
        .approved { background-color: #22bb33; } /* Biru */
        .rejected { background-color: #bb2124; }  /* Merah */
        .pending  { background-color: #f0ad4e; }  /* Oranye */
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/index.js" defer></script>

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

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Izin', 'Sakit', 'Tanpa Keterangan', 'Cuti Singkat'],
                datasets: [{
                    axis: 'y',
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81],
                    fill: false,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
            }
        });
    </script>

@endpush


@section('content')
    @include('components.navbar')

    @include('components.sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1 class="text-capitalize">Selamat Datang, {{ Auth::user()->getRoleNames()->implode(',') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pegawai.dashboard.page') }}">Home</a></li>
                    <li class="breadcrumb-item active text-capitalize">
                        {{ ucwords(str_replace('/', ' / ', Request::path())) }}
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8 order-0 order-lg-0">
                    <div class="row">
                        <div class="card bg-second text-light">
                            <div class="row">
                                <div class="col-4 col-md-2">
                                    <img src="{{ Auth::user()->pegawai->foto ? asset('storage/'.Auth::user()->pegawai->foto) : asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle my-2" >
                                </div>
                                <div class="col-8 col-md-10 my-2">
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Nama</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->nama }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Jabatan</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->jabatan->nama_jabatan }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Alamat</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->alamat }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->user->email }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Nomor Telepon</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->no_telepon }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Tahun Masuk</div>
                                        <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($dataProfile->tanggal_masuk)->translatedFormat('F Y') }}
                                        </div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Tahun Pengabdian</div>
                                        <div class="col-lg-9 col-md-8">{{ $tahunPengabdian. ' Tahun' }} {{ $bulanPengabdian. ' Bulan' }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Tahun Kelahiran</div>
                                        <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($dataProfile->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                                    </div>
                                    <div class="row m-2">
                                        <div class="col-lg-3 col-md-4 label fw-semibold">Golongan</div>
                                        <div class="col-lg-9 col-md-8">{{ $dataProfile->golongan->nama_golongan }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4 order-3 order-lg-1">
                    <div id="calendar"></div>
                </div><!-- End Right side columns -->

                {{-- Horizontal chart --}}
                <div class="col-lg-6 mt-3 mt-lg-0 order-2 order-lg-2">
                    <div class="card p-3">
                        <h5 class="card-title">Kehadiran</h5>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                {{-- table --}}
                <div class="col-lg-6 order-1 order-lg-3">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-title px-3">
                            <p class="second-color fw-semibold">
                                Absensi Kehadiran
                            </p>
                            <hr class="border border-3 opacity-100 shadow" style="border-color: #D5C584 !important;">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="btn-group btn-group-lg mb-3" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-main">
                                        <i class="bi bi-building-check"></i> Check In
                                    </button>
                                    <button type="button" class="btn btn-light">
                                        <i class="bi bi-person-down"></i> Check Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @include('components.footer')
@endsection
