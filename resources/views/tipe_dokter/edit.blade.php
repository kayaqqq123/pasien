@extends('layouts.master')
​
@section('title')
    <title>Edit Tipe Dokter</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Tipe Dokter</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('tipe_dokter.index') }}">Tipe Dokter</a></li>
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
                    <div class="col-md-6">
                        @card
                            @slot('title')
                            Edit
                            @endslot

                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('tipe_dokter.update', $tipe_dokter->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="tipe_dokter">Tipe Dokter</label>
                                    <input type="text"
                                        name="tipe_dokter"
                                        value="{{ $tipe_dokter->tipe_dokter }}"
                                        class="form-control {{ $errors->has('tipe_dokter') ? 'is-invalid':'' }}" id="tipe_dokter" required>
                                </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button class="btn btn-info">Update</button>
                                </div>
                            </form>
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
