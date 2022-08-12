<?php
	// TODO: include class and headeres
	include_once 'XVersionManagement.php';
	include_once 'XFunctionManagement.php';
	include_once 'XDatabaseManagement.php';
	include_once 'XCalenderManagement.php';
	include_once 'XErrorManagemenet.php';
	include_once 'XNetworkManager.php';
	include_once 'XLogManagement.php';
	include_once 'jdf.php';

	// TODO: application version management
	$_version = new XVersionManagement();
	$_calender = new XCalenderManagement();

	// TODO: function get header request value
	function getHeaderValue($headerName) {
		foreach (getallheaders() as $hdrName => $hdrValue)
			if(strcmp($headerName, $hdrName) == 0)
				return $hdrValue;
	}

	function random_string($length) {
		$keys = array_merge(range(0,9));

		$key = "";
		for($i=0; $i < $length; $i++) {
			$key .= $keys[mt_rand(0, count($keys) - 1)];
		}
		return $key;
	}

?>