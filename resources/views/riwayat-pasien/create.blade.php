@extends('layouts.master')
​
@section('title')
    <title>Tambah Riwayat Pasien</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('riwayat-pasien.index') }}">Riwayat Pasien</a></li>
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
                            <form action="{{ route('riwayat-pasien.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Pasien</label>
                                    <select name="pasien_id" id="pasien_id"
                                        required class="form-control {{ $errors->has('pasien_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($pasien as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->nama) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('pasien_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Dokter</label>
                                    <select name="dokter_id" id="dokter_id"
                                        required class="form-control {{ $errors->has('dokter_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($dokter as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->nama) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('dokter_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Status Pengobatan</label>
                                    <select name="status_pengobatan_id" id="status_pengobatan_id"
                                        required class="form-control {{ $errors->has('status_pengobatan_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($status_pengobatan as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->status) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status_pengobatan_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Diagnosa Penyakit</label>
                                    <input type="text" name="diagnosa_penyakit" required
                                        class="form-control {{ $errors->has('diagnosa_penyakit') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('diagnosa_penyakit') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Rawat Inap</label>
                                    <select name="rawat_inap_id" id="rawat_inap_id"
                                         class="form-control {{ $errors->has('rawat_inap_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($rawat as $row)
                                            <option value="{{ $row->id }}">{{ ucfirst($row->kamar) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('rawat_inap_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">
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
@section('script')
    <script>
        $(document).ready(function(){
            $('#status_pengobatan_id').change(function(){
                var close = $(this).closest('form');
                var status_pengobatan = $(this).val();
                var _token = $(this).closest('form').find('[name="_token"]').val();
                //alert(_token);
                if(status_pengobatan == '1'){
                    $('#rawat_inap_id').show();
                    $('#rawat_inap_id').closest('.form-group').show();
                    $.ajax({
                    method: 'GET',
                    url: "{{ route('select_kamar') }}?status_pengobatan=" + status_pengobatan,
                    success: function(result){
                        console.log(result);
                        if(result){
                            $('#rawat_inap_id').empty();
                            $('#rawat_inap_id').append('<option>==Pilih==</option>');
                            $.each(result,function(key,value){
                             $('#rawat_inap_id').append('<option value="'+value+'">'+key+'</option>');
                            });
                        }
                    }
                })
                }else if(status_pengobatan == '2'){
                    $('#rawat_inap_id').hide();
                    $('#rawat_inap_id').closest('.form-group').hide();
                }
            })
        })
    </script>
@endsection
