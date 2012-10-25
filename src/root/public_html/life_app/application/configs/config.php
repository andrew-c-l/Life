<?php
if(ENVIRONMENT == "Development")
{
	$dbhost = 'localhost';
	$dbuser = 'root_user';
	$dbpass = 'root_pass';
	$dbname = 'a_life_test';
}
else if(ENVIRONMENT == "Testing")
{
	$dbhost = '127.0.0.1';
	$dbuser = '';
	$dbpass = '';
	$dbname = '';
}
else if(ENVIRONMENT == "Production")
{
	$dbhost = 'localhost';
	$dbuser = '';
	$dbpass = '';
	$dbname = '';
}