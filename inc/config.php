<?php

function Config()
{
	define("server", "localhost");
	define("user", "root");
	define("password", "");
	define("dbname", "loan_system");
	
	$mysqli = new mysqli(server, user, password, dbname);
	
	return $mysqli;
}