<?php
//Database configurations
class Dbcofig
{
	public $db_hostname;
	public $db_username;
	public $db_password;
	public $db_database;
	public function  __construct()
	{
		$this->db_hostname="localhost";
		$this->db_username="root";
		$this->db_password="";
		$this->db_database="bingo";
	}
}