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
            <h1 class="text-capitalize">Absensi Pribadi</h1>
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
                {{-- tabel pengajuan cuti --}}
                <div class="col-12" id="kelola-admin">
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Rekap Absensi Pribadi</h5>
                            <table class="table table-striped table-hover border table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Presensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12 april 2024</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Maret 2023</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Maret 2025</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Maret 2025</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Maret 2025</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12 Maret 2025</td>
                                        <td>08:00</td>
                                        <td>16:00</td>
                                        <td>
                                            <span class="badge text-bg-success">Hadir</span>
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

    @include('components.footer')
@endsection
