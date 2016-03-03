<?php
require_once("config/db_config.php");
class Game
{
    private $db;

	public function  __construct()
	{
		$db_config=new Dbcofig();
		$db_hostname=$db_config->db_hostname;
		$db_username=$db_config->db_username;
		$db_password=$db_config->db_password;
		$db_database=$db_config->db_database;
		$this->db = new mysqli($db_hostname,$db_username,$db_password,$db_database);
	    if (!$this->db)
	    {
	    	die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	    }
    }
      
	public function __destruct()
	{
		mysqli_close($this->db);
	}
	
	public function loggedusers($username)
	{
		$result=$this->db->query("SELECT * FROM users WHERE username<>'$username' AND in_game=0 AND logged=1");
		while($row=$result->fetch_array())
		{
			$users[]=$row;
		}
		if(isset($users))
		{
			return $users;
		}
		else
			return false;
	}
	public function sendrequest($username,$opponent)
	{
		$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','game_request','')");
	}
	
	public function checkstatus($username)
	{
		$result=$this->db->query("SELECT * FROM status WHERE sent_to='$username' AND processed=0");
		while($row=$result->fetch_array())
		{
			$rows[]=$row;
		}
		if(isset($rows))
		{
			return $rows;
		}
		else
			return false;
	}
	
	public function acceptrequest($username,$opponent)
	{
		$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','game_response','accept')");
	}
	
	public function rejectrequest($username,$opponent)
	{
		$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','game_response','reject')");
	}
	
	public function make_processed($message_id)
	{
		$this->db->query("UPDATE status SET processed=1 WHERE id=$message_id");
	}
	
	public function make_ingame($username)
	{
		$this->db->query("UPDATE users SET in_game=1 WHERE username='$username'");
	}
	
	public function submitboard($board_elements_string,$username,$opponent)
	{
		$result=$this->db->query("SELECT * FROM status WHERE sent_to='$username' AND type='ready1'");
		while($row=$result->fetch_array())
		{
			$rows=$row['message'];
		}
		if(isset($rows))
		{
			$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','ready2','$board_elements_string')");
		}
		else
		{
			$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','ready1','$board_elements_string')");
		}
	}
	
	public function getboard($username)
	{
		$result=$this->db->query("SELECT message FROM status WHERE sent_from='$username' AND (type='ready1' OR type='ready2') AND processed=0");
		while($row=$result->fetch_array())
		{
			$rows=$row['message'];
		}
		if(isset($rows))
		{
			return $rows;
		}
		else
			return false;
	}
	
	public function makeselect($username,$opponent,$element)
	{
		$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','game','$element')");
	}
	
	public function makewin($username,$opponent,$element)
	{
		$this->db->query("INSERT INTO status (sent_from,sent_to,type,message) VALUES ('$username','$opponent','game_win','$element')");
	}
}
?>