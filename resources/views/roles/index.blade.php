@extends('template.app')
@push('css')

@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content-header text-uppercase">
            <h1>
                manajemen role pengguna
            </h1>
        </section>
        <section class="content container-fluid">
            {{-- @include('notify::components.notify') --}}
            {{-- @notifyJs --}}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <div class="box-body">
                </div>
            </div>
        </section>
    </div>
    @endsection
@push('js')
@endpush
