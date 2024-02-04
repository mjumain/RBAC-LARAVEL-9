@extends('layouts.app')
@push('css')
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                    <h4 class="m-0">Tambah Menu</h4>
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
                            <h5 class="card-title m-0"></h5>
                            <div class="card-tools">
                                <a href="{{ route('manage-menu.index') }}" class="btn btn-tool"><i
                                        class="fas fa-arrow-alt-circle-left"></i></a>
                            </div>
                        </div>
                        <form action="{{ route('manage-menu.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu"
                                        class="form-control @error('nama_menu')is-invalid @enderror"
                                        placeholder="Nama Menu">
                                    @error('nama_menu')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="url" class="form-control" placeholder="URL">
                                </div>
                                <div class="form-group">
                                    <label>Icon Menu</label> <a href="https://fontawesome.com/v5/search?o=r&m=free"
                                    target="_blank">Dokumentasi icon</a>
                                    <input type="text" name="icon" class="form-control" placeholder="Icon">
                                </div>
                                <div class="form-group">
                                    <label>Parent Menu</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="0">Sebagai Parent Menu</option>
                                        @foreach ($menus as $item)
                                            <option value="{{ $item->id }}">Child dari menu
                                                {{ $item->parent_id == 0 ? strtoupper($item->nama_menu) : ucwords($item->nama_menu) }}
                                            </option>
                                        @endforeach
                                    </select>
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
@endsection
@push('js')
@endpush
