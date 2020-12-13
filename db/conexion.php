<?php

class Database
{   
    protected static $host = "localhost";
    protected static $db = "libreria";
    protected static $username = "root";
    protected static $password = "";
    protected static $instance;

    protected function __construct() { }

    public function getInstance()
    {
        if(empty(self::$instance)) {

			$db_info = array(
				"db_host" => self::$host,
				"db_port" => "3306",
				"db_user" => self::$username,
				"db_pass" => self::$password,
				"db_name" => self::$db,
				"db_charset" => "UTF-8");

			try {
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); 
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');
			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

		return self::$instance;
    }
}


?>