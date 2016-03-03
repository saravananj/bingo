<?php
session_start();
if($_POST["func"])
{
	require_once("library/functions.game.php");
	$game=new Game();
	
	$username=$_SESSION['username'];
	
	if($_POST["func"]=="getavailableusers")
	{
		$users=$game->loggedusers($username);
		if($users)
		{
			foreach ($users as $single_user)
			{
				$data[]=$single_user["username"];
			}
			echo json_encode($data);
		}
		else
		{
			echo json_encode("no users");
		}
	}
	
	else if($_POST["func"]=="sendrequest")
	{
		$opponent=$_POST["opponent"];
		$game->sendrequest($username,$opponent);
		echo json_encode("request complete");
	}
	
	else if($_POST["func"]=="checkstatus")
	{
		$status=$game->checkstatus($username);
		if($status)
		{
			foreach ($status as $single_status)
			{
				$data["id"]=$single_status["id"];
				$data["from"]=$single_status["sent_from"];
				$data["type"]=$single_status["type"];
				$data["message"]=$single_status["message"];
			}
			echo json_encode($data);
		}
		else
		{
			echo json_encode("no update");
		}
	}
	
	else if($_POST["func"]=="acceptrequest")
	{
		$opponent=$_POST["opponent"];
		$game->acceptrequest($username,$opponent);
		echo json_encode("confirm");
	}
	
	else if($_POST["func"]=="rejectrequest")
	{
		$opponent=$_POST["opponent"];
		$game->rejectrequest($username,$opponent);
		echo json_encode("confirm");
	}
	
	else if($_POST["func"]=="make_processed")
	{
		$message_id=$_POST["message_id"];
		$game->make_processed($message_id);
	}
	
	else if($_POST["func"]=="setopponent")
	{
		$_SESSION["opponent"]=$_POST["opponent"];
		$game->make_ingame($username);
	}
	
	else if($_POST["func"]=="submitboard")
	{
		$opponent=$_SESSION["opponent"];
		$board_elements=$_POST["board_elements"];
		$board_elements_string=implode("#",$board_elements);
		$game->submitboard($board_elements_string,$username,$opponent);
		echo json_encode("confirm");
	}
	
	else if($_POST["func"]=="makeselect")
	{
		$opponent=$_SESSION["opponent"];
		$element=$_POST["element"];
		$game->makeselect($username,$opponent,$element);
		echo json_encode("confirm");
	}
	
	else if($_POST["func"]=="makewin")
	{
		$opponent=$_SESSION["opponent"];
		$element=$_POST["element"];
		$game->makewin($username,$opponent,$element);
		echo json_encode("confirm");
	}
}