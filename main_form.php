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
	require_once 'header.php';
	?>
	<script type="text/javascript" src="js/controllers/main_form.js"></script>
	<style>
	.board_entry
	{
		width:60px;
	}
	</style>
	<div id="notification"></div>
	<form class="form" id="request_form">
		<table class="table table-bordered">
			<tr>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
				<td>
					<input type="text" class="board_entry">
				</td>
			</tr>
		</table>
	<input type="button" value="Start!" id="submitbutton" onclick="submitboard()" class="btn btn-success" data-loading-text="Please Wait...">
	</form>
	
	<?php
	require_once 'footer.php';
}