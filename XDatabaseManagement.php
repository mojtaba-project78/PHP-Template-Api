<?php

	// TODO: here we define database auth
	trait __database_connection
	{
		protected $hostname = "localhost";
		protected $database = "test_db";
		protected $username = "root";
		protected $password = "";
	}

	// TODO: here we should define all table we have
	trait TB_TEST
	{
		public static $TB = 'test_tb';
		public static $INDEX = 'm_index';
		public static $MESSAGE = 'm_message';
	}

	class XDatabaseManagement
	{
		// TODO: using traits here..
		use __database_connection;

		private $_db;
		private $is_connected;
		private $_version = null;

		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		public function __construct( XVersionManagement &$_version = null)
		{
			$this->_version = $_version;
			try
			{
				$this->_db = new PDO(sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", $this->hostname, $this->database), $this->username, $this->password);
				$this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->is_connected = true;
			}
			catch (PDOException $pdo)
			{
				$this->is_connected = false;
				XLog::log(
					array(
						"version" => $this->_version->get_version(),
						"status" => false,
						"data" => sprintf("cannot connect to database [ %s ], %s", $this->database, $pdo->getMessage())
					)
				);
			}
		}

		public function db() {
			return $this->_db;
		}
	}
?>