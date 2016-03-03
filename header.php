<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="author" value="Saravanan Jayabalan">
<title>Bingo!!</title>

<!-- jQuery with jQuery UI -->
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.css">
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>

<!-- Bootstrap by Twitter -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
<script type="text/javascript" src="js/bootstrap.js"></script>
</head>
<body>

	<!-- Modal for help -->
	<div class="modal hide fade" id="help_modal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Instructions</h3>
		</div>
		<div class="modal-body">
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
		</div>
		<div class="modal-footer">
			<a href="javascript:void(0);" onclick="$('#help_modal').modal('hide');" class="btn">Close</a>
		</div>
	</div>
	
    <div class="container">
	    <div class="masthead">
		    <ul class="nav nav-pills pull-right">
		      <li class="active"><a href="dashboard.php">Dashboard</a></li>
		      <li><a href="javascript:void(0);" onclick="$('#help_modal').modal('show');">Help&nbsp;<i class="icon-question-sign"></i></a></li>
		      <li><a href="logout.php">Logout</a></li>
		    </ul>
	        <h3 class="muted">Bingo!</h3>
	        <span class="label label-info">Beta</span>
	    </div>
		<hr>
	    <div class="container">