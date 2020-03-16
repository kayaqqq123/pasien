@extends('layouts.master')
@section('title', 'Data Pasien')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pasien
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Jenis Kelmain</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                    <th style="text-align:center;">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fa fa-plus"></i> Tambah data
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasien as $row)
                                <tr>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->telepon}}</td>
                                    <td>{{$row->jenis_kelamin}}</td>
                                            <td>
                                                <img src="{{asset('foto/'.$row->foto)}}" alt="foto" height="50px">
                                            </td>
                                    <td width="25%" style="text-align:center;">
                                        <a href="{{route('pasien.edit', $row->id)}}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                        <form action="{{route('pasien.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return(confirm('Anda yakin ingin menghapus data ini?'));"></i>
                                                Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Data Pasien</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('pasien.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Pasien" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" class="form-control"
                                    placeholder="Alamat Pasien"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="number" class="form-control" id="telepon" placeholder="Telepon" name="telepon">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" id="foto" name="foto">

                                <p class="help-block">Masukkan foto pasien</p>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
</div>

@stop
