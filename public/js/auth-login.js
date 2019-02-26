/**
 *  Ajax login QR Code
 */
$(document).ready(function() {
	$("#scan").on('click', function() {
        console.log('test');
		$("code").html('scanning');
		$('#qr').html5_qrcode(function(data){
                 // do something when code is read
                 console.log(data);
                 $.ajax({
                    url: '/login',
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

/**
 *  AJax Login Laravel
 */
$('#login').click(function(){
    $.ajax({
        url: '/login',
        data: $('#form-login').serialize(),
        dataType: 'JSON',
        method: 'POST',
        beforeSend: function(response){
            $('#login').html('please wait..').prop('disabled',true);
        },
        success: function(response,xhr){
            window.location.href = response.redirect;
            console.log(response);
        },error: function(response){
            $('.alert').show();
            $('#login').html('login').prop('disabled',false);
            console.log(response.responseJSON.message)
            $('.feedback').html(response.responseJSON.message);
        }             
    })
})