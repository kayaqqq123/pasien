@extends('layouts.master')
​
@section('title')
    <title>Edit Data Dokter</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Dokter</a></li>
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
                            <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama Dokter</label>
                                    <input type="text" name="nama" required
                                        value="{{ $dokter->nama }}"
                                        class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipe Dokter</label>
                                    <select name="tipe_dokter_id" id="tipe_dokter_id"
                                        required class="form-control {{ $errors->has('tipe_dokter_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($tipe_dokter as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $dokter->tipe_dokter_id ? 'selected':'' }}>
                                                {{ ucfirst($row->tipe_dokter) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('tipe_dokter_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                        <option value="L" @if($dokter->jenis_kelamin == "L") selected @endif>L</option>
                                        <option value="P" @if($dokter->jenis_kelamin == "P") selected @endif>P</option>
                                    </select>
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
