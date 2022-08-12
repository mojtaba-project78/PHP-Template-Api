<?php

	class XVersionManagement
	{
		private $_log = array();
		private $_version = 0.0;

		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		public function add_log($title, $message) {
			if(empty($message) == true)
				return;

			$this->_version = sprintf("%.1f", $this->_version += 0.1);
			array_push(
				$this->_log,
				array(
					sprintf("[ %s ]", $title) => $message
				)
			);
		}

		public function get_log() {
			return $this->_log;
		}

		public function get_version() {
			return $this->_version;
		}
	}

?>