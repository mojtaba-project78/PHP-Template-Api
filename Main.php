<?php
	// TODO: include class and headeres
	include_once 'HeaderManagement.php';

	// TODO: make object of initialization class here...
	$_network = new XNetworkManager();
	$_function = new XFunctionManagement($_network, $_version, true);

	// TODO: start anonymous function for initialization data
	$_function->__initialization(
		function() use ($_version, $_function) {
			// TODO: here for api version managemenet
			$_version->add_log(XFunctionManagement::className(), "");
		}
	);

	//=====================================================================================
	//=====================================================================================

	// TODO: make object of class here...
	$_database = new XDatabaseManagement($_version);

	// TODO: run debugging mode
	$_function->__debugging(
		function() use ($_version, $_function, $_database, $_network, $_calender) {
			// TODO: enter code here for debugging...

			// TODO: Test and debugging code
			$_function->get();

			die();
		}
	);

	// TODO: get header value from request header
	$hdrOperation = getHeaderValue('X-Operation');

	// TODO: excute function get
	if ( strcmp($hdrOperation, XOperationManagement::$_get) == 0 )
		$_function->get();

	// TODO: excute function add
	if ( strcmp($hdrOperation, XOperationManagement::$_add) == 0 )
		$_function->add();

	XLog::log(
		array(
			"version" => $_version->get_version(),
			"status" => false,
			"code" => XErrorManagemenet::code_array("MAIN_OPERATION", 5)
		)
	);
?>
		