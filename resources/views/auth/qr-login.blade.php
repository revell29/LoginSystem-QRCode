@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="qr" style="display: inline-block; width: 400px; height: 400px; border: 1px solid silver"></div>
        
        
    </div>
    <br>
    <div style="text-align: center;">
        <button id="scan" class="btn btn-success btn-sm">start scaning</button>
        <button id="stop" class="btn btn-warning btn-sm disabled">stop scanning</button>
    </div>
    <center>
        <span class="feedback" style="margin: 10px; display: inline-block"></span>
    </center>
</div>
@endsection
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
</script>
@endpush
