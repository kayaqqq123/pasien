@extends('layouts.master')
​
@section('title')
    <title>Edit Data Riwayat Psien</title>
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
                            <li class="breadcrumb-item"><a href="{{ route('riwayat-pasien.index') }}">Riwayat Psien</a></li>
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
                            <form action="{{ route('riwayat-pasien.update',$rawatPasien->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama Pasien</label>
                                    <select name="pasien_id" id="pasien_id"
                                        required class="form-control {{ $errors->has('pasien_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($pasien as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $rawatPasien->pasien_id ? 'selected':'' }}>
                                                {{ ucfirst($row->nama) }}
                                            </option>
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
                                            <option value="{{ $row->id }}" {{ $row->id == $rawatPasien->dokter_id ? 'selected':'' }}>
                                                {{ ucfirst($row->nama) }}
                                            </option>
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
                                            <option value="{{ $row->id }}" {{ $row->id == $rawatPasien->status_pengobatan_id ? 'selected':'' }}>
                                                {{ ucfirst($row->status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('status_pengobatan_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Diagnosa Penyakit</label>
                                    <input type="text" name="diagnosa_penyakit" required
                                        value="{{ $rawatPasien->diagnosa_penyakit }}"
                                        class="form-control {{ $errors->has('diagnosa_penyakit') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('diagnosa_penyakit') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Rawat Inap</label>
                                    <select name="rawat_inap_id" id="rawat_inap_id"
                                        required class="form-control {{ $errors->has('rawat_inap_id') ? 'is-invalid':'' }}">
                                        <option value="">Pilih</option>
                                        @foreach ($rawat as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $rawatPasien->rawat_inap_id ? 'selected':'' }}>
                                                {{ ucfirst($row->kamar) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('rawat_inap_id') }}</p>
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
@section('script')
    <script>
        $(document).ready(function(){
            $('#status_pengobatan_id').change(function(){
                var close = $(this).closest('form');
                var status_pengobatan = $(this).val();
                var _token = $(this).closest('form').find('[name="_token"]').val();
                //alert(_token);
                if(status_pengobatan == '1'){
                    $('#rawat_inap_id').closest('.form-group').show();
                    $.ajax({
                    method: 'GET',
                    url: "{{ route('select_kamar') }}?status_pengobatan=" + status_pengobatan,
                    success: function(result){
                        console.log(result);
                        if(result){
                            $('#rawat_inap_id').empty();
                            $('#rawat_inap_id').append('<option>==pilih==</option>');
                            $.each(result,function(key,value){
                             $('#rawat_inap_id').append('<option value="'+value+'">'+value+'</option>');
                            });
                        }
                    }
                })
                }else if(status_pengobatan == '2'){
                    $('#rawat_inap_id').closest('.form-group').hide();
                }
            })
        })
    </script>
@endsection




