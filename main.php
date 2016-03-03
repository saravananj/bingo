<?php
session_start();
if(!isset($_SESSION['userlogged']))
{
	header("Location:index.php");
}
else if(!isset($_SESSION['opponent']))
{
	header("Location:dashboard.php");
}
else
{
	require_once("library/functions.game.php");
	$game=new Game();
	
	$username=$_SESSION['username'];
	$opponent=$_SESSION['opponent'];
	$board=$game->getboard($username);
	
	if(!$board)
	{
		header("Location:dashboard.php");
	}
	else
	{
		$board_entry=explode("#",$board);
		
		require_once 'header.php';
		?>
		<script type="text/javascript">
		var username="<?php echo $username;?>";
		var opponent="<?php echo $opponent;?>";
		</script>
		<script type="text/javascript" src="js/controllers/main.js"></script>
		<style>
		.clickable
		{
			width:50px;
			cursor:pointer;
			text-align:center !important;
		}
		.unclickable
		{
			width:50px;
			background-color:#CCCCCC;
			text-align:center !important;
		}
		</style>
		<div id="notification"></div>
			<div class="row">
				<div class="span6">
					<table class="table table-bordered">
						<tr>
							<td id="element_0_0" class="clickable" onclick="doselect(0,0,<?php echo $board_entry[0];?>)">
								<?php echo $board_entry[0];?>
							</td>
							<td id="element_0_1" class="clickable" onclick="doselect(0,1,<?php echo $board_entry[1];?>)">
								<?php echo $board_entry[1];?>
							</td>
							<td id="element_0_2" class="clickable" onclick="doselect(0,2,<?php echo $board_entry[2];?>)">
								<?php echo $board_entry[2];?>
							</td>
							<td id="element_0_3" class="clickable" onclick="doselect(0,3,<?php echo $board_entry[3];?>)">
								<?php echo $board_entry[3];?>
							</td>
							<td id="element_0_4" class="clickable" onclick="doselect(0,4,<?php echo $board_entry[4];?>)">
								<?php echo $board_entry[4];?>
							</td>
						</tr>
						<tr>
							<td id="element_1_0" class="clickable" onclick="doselect(1,0,<?php echo $board_entry[5];?>)">
								<?php echo $board_entry[5];?>
							</td>
							<td id="element_1_1" class="clickable" onclick="doselect(1,1,<?php echo $board_entry[6];?>)">
								<?php echo $board_entry[6];?>
							</td>
							<td id="element_1_2" class="clickable" onclick="doselect(1,2,<?php echo $board_entry[7];?>)">
								<?php echo $board_entry[7];?>
							</td>
							<td id="element_1_3" class="clickable" onclick="doselect(1,3,<?php echo $board_entry[8];?>)">
								<?php echo $board_entry[8];?>
							</td>
							<td id="element_1_4" class="clickable" onclick="doselect(1,4,<?php echo $board_entry[9];?>)">
								<?php echo $board_entry[9];?>
							</td>
						</tr>
						<tr>
							<td id="element_2_0" class="clickable" onclick="doselect(2,0,<?php echo $board_entry[10];?>)">
								<?php echo $board_entry[10];?>
							</td>
							<td id="element_2_1" class="clickable" onclick="doselect(2,1,<?php echo $board_entry[11];?>)">
								<?php echo $board_entry[11];?>
							</td>
							<td id="element_2_2" class="clickable" onclick="doselect(2,2,<?php echo $board_entry[12];?>)">
								<?php echo $board_entry[12];?>
							</td>
							<td id="element_2_3" class="clickable" onclick="doselect(2,3,<?php echo $board_entry[13];?>)">
								<?php echo $board_entry[13];?>
							</td>
							<td id="element_2_4" class="clickable" onclick="doselect(2,4,<?php echo $board_entry[14];?>)">
								<?php echo $board_entry[14];?>
							</td>
						</tr>
						<tr>
							<td id="element_3_0" class="clickable" onclick="doselect(3,0,<?php echo $board_entry[15];?>)">
								<?php echo $board_entry[15];?>
							</td>
							<td id="element_3_1" class="clickable" onclick="doselect(3,1,<?php echo $board_entry[16];?>)">
								<?php echo $board_entry[16];?>
							</td>
							<td id="element_3_2" class="clickable" onclick="doselect(3,2,<?php echo $board_entry[17];?>)">
								<?php echo $board_entry[17];?>
							</td>
							<td id="element_3_3" class="clickable" onclick="doselect(3,3,<?php echo $board_entry[18];?>)">
								<?php echo $board_entry[18];?>
							</td>
							<td id="element_3_4" class="clickable" onclick="doselect(3,4,<?php echo $board_entry[19];?>)">
								<?php echo $board_entry[19];?>
							</td>
						</tr>
						<tr>
							<td id="element_4_0" class="clickable" onclick="doselect(4,0,<?php echo $board_entry[20];?>)">
								<?php echo $board_entry[20];?>
							</td>
							<td id="element_4_1" class="clickable" onclick="doselect(4,1,<?php echo $board_entry[21];?>)">
								<?php echo $board_entry[21];?>
							</td>
							<td id="element_4_2" class="clickable" onclick="doselect(4,2,<?php echo $board_entry[22];?>)">
								<?php echo $board_entry[22];?>
							</td>
							<td id="element_4_3" class="clickable" onclick="doselect(4,3,<?php echo $board_entry[23];?>)">
								<?php echo $board_entry[23];?>
							</td>
							<td id="element_4_4" class="clickable" onclick="doselect(4,4,<?php echo $board_entry[24];?>)">
								<?php echo $board_entry[24];?>
							</td>
						</tr>
					</table>
				</div>
				<div class="span6">
					<span align="center">
						LAST ENTERED
					</span>
					<hr />
					You : <span id="last_entered_you">N/A</span>
					<hr />
					<?php echo $opponent;?> : <span id="last_entered_opponent">N/A</span>
				</div>
			</div>
			<div class="row">
				<div class="span12">
					<span id="turn_status"></span>
					<hr />
					<span><h1 id="bingo"></h1></span>
				</div>
			</div>
		<?php
		require_once 'footer.php';
	}
}