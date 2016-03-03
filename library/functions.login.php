<?php
require_once("config/db_config.php");
class Login
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
	
	public function authenticate($username,$password)
	{
		$result=$this->db->query("SELECT * FROM users WHERE username='$username' AND passkey='$password'");
		if(mysqli_num_rows($result))
		{
			$result->data_seek(0);
			$session=$result->fetch_array();
			$this->db->query("UPDATE users SET logged=1 WHERE username='$username'"); 
			return $session;
		}
		else
		    return false;
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
	
	public function logout($username)
	{
		$this->db->query("UPDATE users SET in_game=0 WHERE username='$username'");
		$this->db->query("UPDATE users SET logged=0 WHERE username='$username'");
		$this->db->query("DELETE FROM status WHERE sent_from='$username' OR sent_to='$username'");
		return true;
	}
	
	public function cleargame($username)
	{
		$this->db->query("UPDATE users SET in_game=0 WHERE username='$username'");
		$this->db->query("DELETE FROM status WHERE sent_from='$username' OR sent_to='$username'");
		return true;
	}
}
?>