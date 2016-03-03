$(document).ready(function(){
		getavailableusers();
		checkstatus();
	});
	
	var have_request=0;
	var opponent;
	
	function getavailableusers()
	{
		$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"getavailableusers"},
				dataType: 'json',
				success:function(data){
						$("#select_user").html("");
						if(data=="no users")
						{
							$('#select_user').append('<option>No Users Found</option>');
						}
						else
						{
							$.each(data, function(index, element) {
					            $('#select_user').append('<option value="'+element+'">'+element+'</option>');
					        });
						}
						setTimeout(function() {
							getavailableusers();
						}, 5000);
					}
			});
	}

	function sendrequest()
	{
		opponent=$("#select_user").val();
		$.ajax({
			type:"post",
			url:"ajax.php",
			data:{func:"sendrequest",opponent:opponent},
			dataType: 'json',
			success:function(data){
					if(data=="request complete")
					{
						$("#notification").addClass("alert");
						$("#notification").addClass("alert-success");
						$("#notification").text("Request send successfully, please wait until the other user accepts");
						setTimeout(function() {
							checkresponse();
						}, 5000);
					}
					else
					{
						$("#notification").addClass("alert");
						$("#notification").addClass("alert-error");
						$("#notification").text("Sending request failed, please try after some time");
					}
				}
		});
	}

	function checkstatus()
	{
		$.ajax({
			type:"post",
			url:"ajax.php",
			data:{func:"checkstatus"},
			dataType: 'json',
			success:function(data){
					if(data=="no update")
					{
						setTimeout(function() {
							checkstatus();
						}, 5000);
					}
					else
					{
						make_processed(data.id);
						if(data.type=="game_request")
			            {
				            have_request=1;
							opponent=data.from;
							$('#modal').modal('show');
							$(".modal-body").html("<p>"+data.from+" has requested a game with you!</p>");
				        }
						else if(data.type=="game_response" && data.message=="accept")
			            {
							setopponent();
							window.location.href="main_form.php";
			            }
			            else if(data.type=="game_response" && data.message=="reject")
			            {
			            	$("#notification").addClass("alert");
							$("#notification").addClass("alert-error");
							$("#notification").text(data.from+" is not willing to play right now, please try again later.");
			            }
			        }
				}
		});
	}

	function accept_request()
	{
		if(have_request==1)
		{
			setopponent();
			$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"acceptrequest",opponent:opponent},
				dataType: 'json',
				success:function(data){
						if(data=="confirm")
						{
							window.location.href="main_form.php";
						}
						else
						{
				        	$("#notification").addClass("alert");
							$("#notification").addClass("alert-error");
							$("#notification").text("Some issue in network, please try again later.");
					    }
					}
			});
			$('#modal').modal('hide');
		}
	}

	function reject_request()
	{
		if(have_request==1)
		{
			$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"rejectrequest",opponent:opponent},
				dataType: 'json',
				success:function(data){
						if(data=="confirm")
						{
							$("#notification").addClass("alert");
							$("#notification").addClass("alert-success");
							$("#notification").text("Rejection sent successfully, you can choose an user.");
						}
						else
						{
				        	$("#notification").addClass("alert");
							$("#notification").addClass("alert-error");
							$("#notification").text("Some issue in network, please try again later.");
					    }
					}
			});
			$('#modal').modal('hide');
		}
	}

	function make_processed(message_id)
	{
		$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"make_processed",message_id:message_id},
				dataType: 'json',
				async:false
			});
	}
	
	function setopponent()
	{
		$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"setopponent",opponent:opponent},
				dataType: 'json',
				async:false
			});
	}