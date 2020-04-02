@extends('layouts.master')
​
@section('title')
    <title>Edit Data Rawat Inap</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('rawat-inap.index') }}">Rawat Inap</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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

                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <form action="{{ route('rawat-inap.update', $rawat->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Kamar</label>
                                    <input type="text" name="kamar" required
                                        value="{{ $rawat->kamar }}"
                                        class="form-control {{ $errors->has('kamar') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('kamar') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Perawat</label>
                                    <select name="id_perawat" id="id_perawat"
                                        required class="form-control {{ $errors->has('id_perawat') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($perawat as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $rawat->id_perawat ? 'selected':'' }}>
                                                {{ ucfirst($row->nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('id_perawat') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Status Pengobatan</label>
                                    <select name="status_pengobatan_id" id="status_pengobatan_id"
                                        required class="form-control {{ $errors->has('status_pengobatan_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($status_pengobatan as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $rawat->status_pengobatan_id ? 'selected':'' }}>
                                                {{ ucfirst($row->nama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status_pengobatan_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
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
