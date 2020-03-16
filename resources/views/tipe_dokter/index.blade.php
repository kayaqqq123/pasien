@extends('layouts.master')
​
@section('title')
    <title>Tipe Dokter</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tipe Dokter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        @card
                            @slot('title')
                            Tambah
                            @endslot

                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('tipe_dokter.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="tipe_dokter">Tipe Dokter</label>
                                    <input type="text"
                                    name="tipe_dokter"
                                    class="form-control {{ $errors->has('tipe_dokter') ? 'is-invalid':'' }}" id="tipe_dokter" required>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                    <div class="col-md-8">
                        @card
                            @slot('title')
                            Tipe Dokter
                            @endslot

                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td>Tipe Dokter</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($tipe_dokter as $row)
                                        <tr>
                                            <td>{{ $row->tipe_dokter }}</td>
                                            <td width="25%" style="text-align:center;">
                                                <a href="{{route('tipe_dokter.edit', $row->id)}}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                                <form action="{{route('tipe_dokter.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return(confirm('Anda yakin ingin menghapus data ini?'));"></i>
                                                        Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
