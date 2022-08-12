<?php
	define("MAXIMUM_ELEMENT", 30);

	class XOperationManagement
	{
		public static $_get = '15737c94300e8137dd09f351c1db7a0138cd3cd4';
		public static $_add = '15737c94300e8137dd09f351c1db7a0138cd3cd4';
	}

	class XFunctionManagement
	{
		private $_version = null;
		private $_network = null;

		// TODO: debugging mode
		private $_debugging;

		public function __construct(XNetworkManager &$_network = null, XVersionManagement &$_version = null, $debugging = false) {
			// TODO: set debugging mode
			$this->_debugging = $debugging;
			$this->_version = $_version;
			$this->_network = $_network;
		}

		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		// TODO: debugging lambda function
		public function __debugging($_debugging_function) {
			// TODO: check if debugging is active
			if ( $this->_debugging )
				$_debugging_function();
		}

		// TODO: initialization lambda function for manage data
		public function __initialization($lambda_function) {
			$lambda_function();
		}

		private function _database() {
			return new XDatabaseManagement();
		}

		private function _calender() {
			return new XCalenderManagement();
		}

		//===================================================================================================
		//===================================================================================================
		// TODO: define all api function

		public function add() {
			$value = "Hello World!";
			$data = $this->_database()->db()->prepare(
				sprintf(
					"insert into %s(%s) VALUES('%s')",
					TB_TEST::$TB,
					TB_TEST::$MESSAGE,
					$value
				)
			)->execute();

			if ( !$data )
				XLog::log(
					array(
						'status' => false,
						'data' => 'error when inserting data!'
					)
				);

			XLog::log(
				array(
					'status' => true,
					'data' => 'data inserted!'
				)
			);
		}

		//===================================================================================================
		public function get() {
			$query = sprintf(
				"select * from %s",
				TB_TEST::$TB
			);

			$data = $this->_database()->db()->query($query)->fetchAll(PDO::FETCH_ASSOC);

			XLog::log(
				array(
					'status' => true,
					"data" => $data
				)
			);
		}
	}

?>