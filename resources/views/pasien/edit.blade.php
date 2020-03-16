@extends('layouts.master')
@section('title', 'Edit Pasien')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Data Pasien
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <form action="{{route('pasien.update', $pasien->id)}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama siswa" value="{{$pasien->nama}}" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control"
                                    placeholder="Alamat siswa">{{$pasien->alamat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="number" class="form-control" id="telepon" placeholder="Telepon" value="{{$pasien->telepon}}" name="telepon">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelmain">Jenis Kelamin</label>
                                <select name="jenis_kelmain" id="jenis_kelmain" class="form-control">
                                    <option value="L" @if($pasien->jenis_kelmain == "L") selected @endif>L</option>
                                    <option value="P" @if($pasien->jenis_kelmain == "P") selected @endif>P</option>
                                </select>
                            </div>
                            <img src="{{asset('foto/'.$pasien->foto)}}" height="100px" alt="">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" id="foto" name="foto">

                                <p class="help-block">Masukkan Foto Pasien</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
