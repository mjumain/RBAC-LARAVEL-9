@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">profil pengguna</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        </div>
                        <form method="post" action="{{ route('profil.update', auth()->user()->id) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="text" name="current_password"
                                        class="form-control @error('current_password')is-invalid @enderror"
                                        placeholder="Password saat ini">
                                    @error('current_password')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="text" name="password"
                                        class="form-control @error('password')is-invalid @enderror"
                                        placeholder="Password baru">
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="text" name="password_confirmation"
                                        class="form-control @error('password_confirmation')is-invalid @enderror"
                                        placeholder="Password saat ini">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('js')
@endpush
