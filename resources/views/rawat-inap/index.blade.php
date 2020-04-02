@extends('layouts.master')
​
@section('title')
    <title>Rawat Inap</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Rawat Inap</h1>
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
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            <a href="{{ route('rawat-inap.create') }}"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot

                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kamar</th>
                                            <th>Nama Perawat</th>
                                            {{-- <th>Status Pengobatan</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rawat as $row)
                                        <tr>
                                            <td>{{ $row->kamar }}</td>
                                            <td>{{ $row->perawat()->first()->nama}}</td>
                                            {{-- <td>{{ $row->status_pengobatan->status }}</td> --}}
                                            <td width="25%" style="text-align:center;">
                                                <a href="{{route('rawat-inap.edit', $row->id)}}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                                <form action="{{route('rawat-inap.destroy', $row->id)}}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" onclick="return(confirm('Anda yakin ingin menghapus data ini?'));"></i>
                                                        Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {!! $rawat->links() !!}
                                </div>
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
