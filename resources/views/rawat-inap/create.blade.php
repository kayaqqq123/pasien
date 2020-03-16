@extends('layouts.master')
​
@section('title')
    <title>Tambah Rawat Inap</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('rawat-inap.index') }}">Rawat Inap</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')

                            @endslot

                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            <form action="{{ route('rawat-inap.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nomor Kamar</label>
                                    <input type="text" name="no_kamar" required
                                        class="form-control {{ $errors->has('no_kamar') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('no_kamar') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Perawat</label>
                                    <select name="id_perawat" id="id_perawat"
                                        required class="form-control {{ $errors->has('id_perawat') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($perawat as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->nama) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('id_perawat') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Simpan
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
