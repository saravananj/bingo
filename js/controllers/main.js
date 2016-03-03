$(document).ready(function(){
		checkstatus();
		$("#notification").addClass("alert");
		$("#notification").addClass("alert-error");
		$("#notification").text("Please wait until the opponent gets ready");
		$("#notification").show('slow');
		setTimeout(function() {
			$("#notification").hide('slow');
		}, 5000);
})

var opponent_ready=0;
var bingo_array=[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]];
var bingo_status;
var bingo_lead;
var bingo_lead_temp;
var grid_location;
var game_complete=0;

function checkstatus()
{
	$.ajax({
		type:"post",
		url:"ajax.php",
		data:{func:"checkstatus"},
		dataType: 'json',
		success:function(data){
				if(data!="no update")
				{
					make_processed(data.id);
					if(opponent_ready==0)
					{
						if(data.type=="ready1"||data.type=="ready2")
			            {
							opponent_ready=1;
							//$("#notification").addClass("alert");
							$("#notification").removeClass("alert-error");
							$("#notification").addClass("alert-success");
							$("#notification").text("Opponent is ready");
							$("#notification").show('slow');
							setTimeout(function() {
								$("#notification").hide('slow');
							}, 5000);
							if(data.type=="ready1")
							{
								current_turn=opponent;
								$("#turn_status").html(opponent+"'s turn");
							}
							else if(data.type=="ready2")
							{
								current_turn=username;
								$("#turn_status").html("your turn");
							}
				        }
					}
					else if(opponent_ready==1&&data.type=="game")
					{
						current_turn=username;
						for(var k=0;k<5;k++)
						{
							for(var l=0;l<5;l++) //k and l(small L)
							{
								if($.trim($("#element_"+k+"_"+l).html())==data.message)
								{
									grid_location="#element_"+k+"_"+l;
									bingo_array[k][l]=1;
									bingo_status=checkbingo();
									if(bingo_status==5)
									{
										makewin(k,l,data.message);
									}
									else
									{
										bingostatus(bingo_status);
									}
								}
							}
						}
						$(grid_location).removeAttr("onclick");
						$(grid_location).removeClass("clickable");
						$(grid_location).addClass("unclickable");
						$("#last_entered_opponent").html(data.message);
						$("#turn_status").html("your turn");
					}
					else if(opponent_ready==1&&data.type=="game_win")
					{
						$("#last_entered_opponent").html(data.message);
						$("#turn_status").html("Game Over, you lost");
						$("#bingo").html(opponent+" hit the BINGO!!!");
				  		game_complete=1;
					}
					
		        }
				setTimeout(function() {
					checkstatus();
				}, 5000);
			}
	});
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

function doselect(i,j,data_element)
{
	if(opponent_ready==1&&current_turn==username&&game_complete==0)
	{
		bingo_array[i][j]=1;
		bingo_status=checkbingo();
		if(bingo_status==5)
		{
			makewin(i,j,data_element);
		}
		else
		{
			$.ajax({
				type:"post",
				url:"ajax.php",
				data:{func:"makeselect",element:data_element},
				dataType: 'json',
				success:function(data){
						if(data=="confirm")
						{
							current_turn=opponent;
							//alert(i+" "+j+" "+data_element);
							$("#element_"+i+"_"+j).removeAttr("onclick");
							$("#element_"+i+"_"+j).removeClass("clickable");
							$("#element_"+i+"_"+j).addClass("unclickable");
							$("#last_entered_you").html(data_element);
							$("#turn_status").html(opponent+"'s turn");
							bingostatus(bingo_status);
						}
						else
						{
							$("#notification").addClass("alert");
							$("#notification").addClass("alert-error");
							$("#notification").text("Sending request failed, please try after some time");
							$("#notification").show('slow');
							setTimeout(function() {
								$("#notification").hide('slow');
							}, 5000);
						}
					}
			});
		}
		
	}
	else
	{
		$("#notification").addClass("alert");
		$("#notification").addClass("alert-error");
		if(opponent_ready==0)
		{
			$("#notification").text("Please wait until the opponent gets ready");
			$("#notification").show('slow');
			setTimeout(function() {
				$("#notification").hide('slow');
			}, 5000);
		}
		else
		{
			$("#notification").text("Now its opponent turn. Please wait");
			$("#notification").show('slow');
			setTimeout(function() {
				$("#notification").hide('slow');
			}, 5000);
		}
	}
}

function checkbingo()
{
	bingo_lead=0;
	var x,y;
	for(x=0;x<5;x++)
	{
		bingo_lead_temp=0;
		for(y=0;y<5;y++)
		{
			if(bingo_array[x][y]==1)
			{
				bingo_lead_temp++;
			}
		}
		if(bingo_lead_temp==5)
		{
			bingo_lead++;
		}
	}
	for(y=0;y<5;y++)
	{
		bingo_lead_temp=0;
		for(x=0;x<5;x++)
		{
			if(bingo_array[x][y]==1)
			{
				bingo_lead_temp++;
			}
		}
		if(bingo_lead_temp==5)
		{
			bingo_lead++;
		}
	}
	return bingo_lead
}

function makewin(i,j,data_element)
{
	$.ajax({
		type:"post",
		url:"ajax.php",
		data:{func:"makewin",element:data_element},
		dataType: 'json',
		success:function(data){
				if(data=="confirm")
				{
					current_turn=opponent;
					//alert(i+" "+j+" "+data_element);
					$("#element_"+i+"_"+j).removeAttr("onclick");
					$("#element_"+i+"_"+j).removeClass("clickable");
					$("#element_"+i+"_"+j).addClass("unclickable");
					$("#last_entered_you").html(data_element);
					$("#turn_status").html("Game Over, you won");
					bingostatus(bingo_status);
				}
				else
				{
					$("#notification").addClass("alert");
					$("#notification").addClass("alert-error");
					$("#notification").text("Sending request failed, please try after some time");
					$("#notification").show('slow');
					setTimeout(function() {
						$("#notification").hide('slow');
					}, 5000);
				}
			}
	});
}

function bingostatus(bingo_status)
{
	switch (bingo_status)
	{
	  case 1: $("#bingo").html("B");
	          break;
	  case 2: $("#bingo").html("BI");
	          break;
	  case 3: $("#bingo").html("BIN");
	          break;
	  case 4: $("#bingo").html("BING");
	          break;
	  case 5: $("#bingo").html("You hit the BINGO!!!");
	  		  game_complete=1;
	          break;
	  default:  $("#bingo").html("");
	}
}