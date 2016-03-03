<?php
session_start();
if(!isset($_SESSION['userlogged']))
{
	header("Location:index.php");
}
else
{
	if(isset($_SESSION['opponent']))
	{
		require_once 'library/functions.login.php';
		$login=new Login();
		$login->cleargame($_SESSION["username"]);
		unset($_SESSION['opponent']);
	}
	require_once 'header.php';
	?>
	<script type="text/javascript" src="js/controllers/dashboard.js"></script>
	<div id="notification"></div>
	<form class="form-inline" id="request_form">
	Select a user:
	<select name="opponent" id="select_user">
		<option>No Users found</option>
	</select>
	<input type="button" value="Select" onclick="sendrequest()" class="btn">
	</form>
	
	<hr class="tall" />
	
	<p class="lead">
	Instructions: (You can click the 'Help' button anytime to get these instructions)
	</p>
	
	<ul>
		<li>
			<strong>Step 1:</strong> Select a player from available list, in the Dashboard.
		</li>
		<li>
			<strong>Step 2:</strong> Fillup the form from numbers 1 to 25. Do not repeat a number.
		</li>
		<li>
			<strong>Step 3:</strong> In the game board, wait until the opponent gets ready. The tagline below the board will show you the status, who has to play at that time.
		</li>
		<li>
			<strong>PLAY:</strong> In the game board, when its your turn, click a number (among white pattern), the selected number will become grey pattern both in your board and opponent board.
		</li>
		<li>
			<strong>STATUS:</strong> The last entered tag will show the number last entered by you and the opponent.
		</li>
		<li>
			<strong>WINNER:</strong> The player who has five straight lines(grey patterns) (horizontal or vertical) will be the winner. The progress will be shown at the bottom after forming first straight line.
		</li>
		<li>
			Enjoy the Game.
		</li>
	</ul>
	
	<div class="modal hide fade" id="modal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>New Request</h3>
		</div>
		<div class="modal-body">
			
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" onclick="reject_request()">Reject</a>
			<a href="#" class="btn btn-primary" onclick="accept_request()">Accept</a>
		</div>
	</div>
	<?php
	require_once 'footer.php';
}