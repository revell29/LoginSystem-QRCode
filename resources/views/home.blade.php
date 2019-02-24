@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-5">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($data->qr_code))!!} ">
                        </div>
                        <div class="col-md-4">
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                    <td>{{$data->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$data->email}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
