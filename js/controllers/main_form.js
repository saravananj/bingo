$(document).ready(function(){
	
});
function submitboard()
{
	$("#submitbutton").button('loading');
	var board_elements=new Array();
	var current_value;
	var in_array;
	var validation_error=0;
	$(".board_entry").each(function(index,value){
		current_value=$(this).val();
		in_array=jQuery.inArray(current_value,board_elements);
		if(!isNaN(current_value)&&current_value<26&&current_value>0&&in_array==-1)
		{
			board_elements[index]=$(this).val();
		}
		else
		{
			validation_error=1;
		}
	});
	if(validation_error==1)
	{
		$("#notification").addClass("alert");
		$("#notification").addClass("alert-error");
		$("#notification").text("Only numbers between 1 to 25 are valid. Donot enter a value twice.");
	}
	else
	{
		$.ajax({
			type:"post",
			url:"ajax.php",
			data:{func:"submitboard",board_elements:board_elements},
			dataType: 'json',
			success:function(data){
					if(data=="confirm")
					{
						window.location.href="main.php";
					}
					else
					{
			        	$("#notification").addClass("alert");
						$("#notification").addClass("alert-error");
						$("#notification").text("Some issue in network, please try again later.");
				    }
				}
		});
	}
	$("#submitbutton").button('reset');
}