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
   $(document).ready(function() {
	$("#scan").on('click', function() {
        console.log('test');
		$("code").html('scanning');
		$('#qr').html5_qrcode(function(data){
                 // do something when code is read
                 console.log(data);
                 $.ajax({
                    url: '{{route('login')}}',
                    data: {data:data},
                    dataType: 'JSON',
                    method: 'POST',
                    beforeSend: function(response){
                        $('#login').html('please wait..').prop('disabled',true);
                    },
                    success: function(response,xhr){
                        window.location.href = response.redirect;
                        console.log(response);
                    },error: function(response){
                       $('.feedback').html(response.responseJSON.message);
                    }             
                })
		    },
		    function(error){
		        //show read errors 
		        // console.log(error);
		    }, function(videoError){
		        //the video stream could be opened
		        $(".feedback").html('Video error');
		    }
		);

		$("#scan").addClass('disabled');
		$("#stop").removeClass('disabled');
		$("#change").removeClass('disabled');
	});

	$("#stop").on('click', function() {
		$("#qr").html5_qrcode_stop();
		$("code").html('Click "Start Scanning" to <b>start scanning QR Code</b>');

		$("#scan").removeClass('disabled');
		$("#stop").addClass('disabled');
		$("#change").addClass('disabled');
		$(".feedback").html("");
	});
	$("#change").on('click', function() {
		$("#qr").html5_qrcode_changeCamera();

		$("#scan").addClass('disabled');
		$("#stop").removeClass('disabled');
	});
});

</script>
@endpush
