@extends('layouts.master')
​
@section('title')
    <title>Data Riwayat Pasien</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Data Riwayat Pasien</h1>
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
                            <a href="{{ route('riwayat-pasien.create') }}"
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
                                            <th>Nama Pasien</th>
                                            <th>Nama Dokter</th>
                                            <th>Status Pengobatan</th>
                                            <th>Diagnosa Penyakit</th>
                                            <th>Rawat Inap</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($rawatPasien as $row)
                                        <tr>
                                            <td>{{ $row->pasien()->first()->nama}}</td>
                                            <td>{{ $row->dokter->nama }}</td>
                                            <td>{{ $row->statuspengobatan()->first()->status}}</td>
                                            <td>{{ $row->diagnosa_penyakit }}</td>
                                            {{-- @if( $row->status_pengobatan_id == '1') --}}
                                            <td>{{ $row->rawatinap()->first()->kamar ?? ''}}</td>
                                            {{-- @endif --}}
                                            <td></td>
                                            <td width="25%" style="text-align:center;">
                                                <a href="{{route('riwayat-pasien.edit', $row->id)}}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update</a>
                                                <form action="{{route('riwayat-pasien.destroy', $row->id)}}" method="POST" style="display:inline-block">
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
