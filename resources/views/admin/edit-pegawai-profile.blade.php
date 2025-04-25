@extends('html.html')

@push('js')
    <script>
        $(document).ready(function () {
            let isEditMode = false; // Flag manual

            $('#toggle-edit').on('click', function () {
                let $form = $('#form-edit');

                if (!isEditMode) {
                    // Masuk ke mode edit
                    $form.find('input, select, textarea').prop('disabled', false).prop('readonly', false);
                    $(this).html('<i class="bi bi-x"></i> Batal Sunting');
                } else {
                    // Kembali ke mode tampilan (read-only)
                    $form.find('input, select, textarea').prop('disabled', true).prop('readonly', true);
                    $(this).html('<i class="bi bi-pencil"></i> Sunting');
                }

                isEditMode = !isEditMode; // Toggle status
            });
        });
    </script>
@endpush

@section('content')

    @include('components.navbar')

    @include('components.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('hrd.dashboard.page') }}">Home</a></li>
                    <li class="breadcrumb-item active text-capitalize">
                        {{ ucwords(str_replace('/', ' / ', Request::path())) }}
                    </li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            {{-- foto profile --}}
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="h2 fw-semibold text-uppercase">
                                puma
                            </div>
                            <div class="img-container">
                                <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="" class="rounded-circle" height="120" width="120">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="form-edit" action="" method="post">
                @csrf @method('put')
                {{-- data diri --}}
                <div class="row">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="h5 text-capitalize fw-semibold mt-2">Ubah data diri</p>
                                <hr class="border border-dark opacity-100">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="text-end">
                                            <button type="button" id="toggle-edit" class="btn btn-sm btn-main">
                                                <i class="bi bi-pencil"></i> Sunting
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- data pekerjaan --}}
                <div class="row">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="h5 text-capitalize fw-semibold mt-2">Ubah data pekerjaan</p>
                                <hr class="border border-dark opacity-100">
                            </div>
                            <div class="col-lg-9 bg-light">
                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="formFile" class="form-label">Email</label>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="test@gmail.com" disabled>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- button submit --}}
                <div class="row">
                    <button type="submit" class="btn btn-main">Simpan Perubahan</button>
                </div>
            </form>
        </section>

    </main>
    @include('components.footer')
@endsection
