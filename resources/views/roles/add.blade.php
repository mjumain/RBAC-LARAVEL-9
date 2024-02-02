@push('css')
@endpush
@extends('layouts.app')
@section('title', 'User Management')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0 text-uppercase">tambah role</h5>
                </div>
                <div class="ms-auto">
                    @include('tombol.back')

                </div>
            </div>
        </div>
        <form action="{{ route($datas['url_add']) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Role</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Nama Role" name="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="guard_name" class="form-label">Guard</label>
                    <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name"
                        placeholder="Guard Name" name="guard_name">
                    @error('guard_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="permissions[]" class="form-label">Permission</label>
                    @foreach ($permissions as $permission)
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <input class="form-check-input" type="checkbox" id="{{ $permission->name }}"
                                name="permissions[]" value="{{ $permission->name }}">
                            <label for="{{ $permission->name }}" class="form-label">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                    @error('permissions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                @include('tombol.save')
            </div>
        </form>
    </div>
@endsection
@push('js')
@endpush
