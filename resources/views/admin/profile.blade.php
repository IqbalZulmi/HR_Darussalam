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
            <h1>Profile</h1>
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
                        <ul class="nav nav-tabs nav-tabs-bordered mt-2">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Kata Sandi</button>
                            </li>
                        </ul>
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

            <div class="tab-content">
                <div class="tab-pane fade show active profile-edit" id="profile-edit">
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
                </div>

                <div class="tab-pane fade" id="profile-change-password">
                    <!-- Change Password Form -->
                    <div class="card">
                        <div class="card-body pt-3">
                            <form action="{{ route('profile.password.update') }}" method="post">
                                @csrf @method('put')
                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Sekarang</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_lama" type="password" class="form-control @error('password_lama') is-invalid @enderror" value="{{ old('password_lama') }}" required>
                                        @error('password_lama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Kata Sandi</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_baru" type="password" class="form-control @error('password_baru') is-invalid @enderror" value="{{ old('password_baru') }}" required>
                                        @error('password_baru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Ulangi Kata Sandi Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="konf_password" type="password" class="form-control @error('konf_password') is-invalid @enderror" value="{{ old('konf_password') }}" required>
                                        @error('konf_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-main">Ubah Kata Sandi</button>
                                </div>
                            </form><!-- End Change Password Form -->
                        </div>
                    </div>

                </div>
            </div>


        </section>

    </main>
    @include('components.footer')
@endsection
