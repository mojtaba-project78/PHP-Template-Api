<?php

	class XNetworkLogManager
	{
		private $_log = array();
		protected $_version = 0;

		protected function exec_log()
		{
			$this->add_log("null");
			$this->add_log("add networklog for checking list of all update note");
			$this->add_log("using do while in sendrequest for checking request successfull or faild operation");
		}

		protected function add_log($message) {
			array_push(
				$this->_log,
				[
					$this->_version => sprintf("<[+]> %s", $message)
				]
			);
			$this->_version++;
		}

		protected function get_log() {
			return $this->_log;
		}
	}

	class XNetworkManager extends XNetworkLogManager
	{
		private $_request_header;
		private $_request_post;
		private $_request_url;
		private $_request_finished;
		private $_request_response;
		private $_request_proxy;

		public function log() {
			return $this->get_log();
		}

		public function version() {
			return $this->_version;
		}

		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		public function __construct()
		{
			// TODO: excuteing log
			$this->exec_log();

			// TODO: clear all data
			$this->request_header(array());
			$this->request_post("");
			$this->request_url("");
			$this->request_response("");
			$this->request_finished(true);
			$this->request_proxy("");
		}

		public function request_header($request_header = null) {
			if(isset($request_header))
				$this->_request_header = $request_header;
			else
				return $this->_request_header;
		}

		public function request_post($request_post = null) {
			if(isset($request_post))
				$this->_request_post = $request_post;
			else
				return $this->_request_post;
		}

		public function request_url($request_url = null) {
			if(isset($request_url))
				$this->_request_url = $request_url;
			else
				return $this->_request_url;
		}

		public function request_response($request_response = null) {
			if(isset($request_response))
				$this->_request_response = $request_response;
			else
				return $this->_request_response;
		}

		public function request_finished($request_finished = null) {
			if(isset($request_finished))
				$this->_request_finished = $request_finished;
			else
				return $this->_request_finished;
		}

		public function request_proxy($request_proxy = null) {
			if(isset($request_proxy))
				$this->_request_proxy = $request_proxy;
			else
				return $this->_request_proxy;
		}

		//--------------------------------------
		public function sendRequest($url_address = null, $request_header = null, $request_post = null, $proxyAddress = null)
		{
			do
			{
				// TODO: set all data to XNetworkManager for get better manager from values
				$this->request_finished(false);

				// TODO: update request url_address
				if(isset($url_address))
					$this->request_url($url_address);

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $this->request_url());
				curl_setopt($curl, CURLOPT_FAILONERROR, 1);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_TIMEOUT, 15);

				// TODO: update request header
				if(isset($request_header))
				{
					$this->request_header( $request_header );
					curl_setopt($curl, CURLOPT_HTTPHEADER, $request_header);
				}

				// TODO: update request post data
				if(isset($request_post))
				{
					$this->request_post( $request_post );
					curl_setopt($curl, CURLOPT_POST, 1);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $request_post);
				}

				if(isset($proxyAddress))
				{
					$proxySpliter = explode(":", $proxyAddress);
					curl_setopt($curl, CURLOPT_PROXY, $proxySpliter[0]);
					curl_setopt($curl, CURLOPT_PROXYPORT, (int)$proxySpliter[1]);
					curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
				}

				// TODO: executing curl
				$returnValue = curl_exec($curl);

				// TODO: update response value
				$this->request_response($returnValue);

				// TODO: close curl libraray
				curl_close($curl);

				// TODO: update request finished data
				$this->request_finished(true);

			} while($this->request_finished() == true && empty($this->request_response()));

			// TODO: return data in response
			return $this->request_response();
		}
	}

?>