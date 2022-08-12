<?php

	class XErrorManagemenet
	{
		public static function code_array($section, $code, $fromService = false, $describtion = "") {
			global $m_error_array;
			foreach ($m_error_array as $sectionName => $sectionValue) {
				if ( strcmp( $sectionName, $section ) == 0 ) {
					foreach ( $m_error_array[$section] as $typeName => $typeValue ) {
						if ( $typeValue["key"] == $code ) {
							$key = $typeValue["key"];
							$message = $typeValue["message"];
							break;
						}
					}
				}
			}

			if(!empty($describtion))
				$m_array = array(
					"key" => $key,
					"message" => sprintf( "%s -> '%s'", $message, $describtion ),
					"service" => $fromService
				);
			else
				$m_array = array(
					"key" => $key,
					"message" => sprintf( "%s", $message),
					"service" => $fromService
				);

			return $m_array;
		}

		//==========================================================================================
		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		public static function POST(&$array, XVersionManagement &$_version = null)
		{
			// TODO: pass argument by reference
			foreach ($array as $paramName => $paramValue) {
				if(strcmp($array[$paramName], 'null') != 0)
					if(!isset($_POST[$paramName]))
						XLog::log(
							array(
								"version" => $_version->get_version(),
								"status" => false,
								"code" => (new self)::code_array("POST", 1, true, $paramName),
								"data" => []
							)
						);
			}

			// TODO: check data is empty or no
			foreach ($array as $paramName => $paramValue) {
				if(strcmp($array[$paramName], 'null') != 0)
					if(strlen($_POST[$paramName]) <= 0)
						XLog::log(
							array(
								"version" => $_version->get_version(),
								"status" => false,
								"code" => (new self)::code_array("POST", 2, true, $paramName),
								"data" => []
							)
						);
			}

			foreach ($array as $paramName => $paramValue) {
				if ( strcmp( $array[$paramName], 'null' ) == 0 )
					$array[$paramName] = '';
			}

			$array = array_replace($array, $_POST);
		}

		public static function GET(&$array, XVersionManagement &$_version = null)
		{
			// TODO: pass argument by reference
			foreach ($array as $paramName => $paramValue) {
				if(!isset($_GET[$paramName]))
					XLog::log(
						array(
							"version" => $_version->get_version(),
							"status" => false,
							"code" => (new self)::code_array("GET", 3, true, $paramName),
							"data" => []
						)
					);
			}

			// TODO: check data is empty or no
			foreach ($array as $paramName => $paramValue) {
				if(empty($array[$paramName]))
					XLog::log(
						array(
							"version" => $_version->get_version(),
							"status" => false,
							"code" => (new self)::code_array("GET", 4, true, $paramName),
							"data" => []
						)
					);
			}
			$array = array_replace($array, $_GET);
		}
	}

	$m_error_array = array(
		"POST" => array(
			array(
				"key" => 1,
				"message" => "POST cannot access to field"
			),
			array(
				"key" => 2,
				"message" => 'POST field is empty'
			)
		),
		"GET" => array(
			array(
				"key" => 3,
				"message" => "GET cannot access to field"
			),
			array(
				"key" => 4,
				"message" => "GET fields is empty"
			)
		),
		"MAIN_OPERATION" => array(
			array(
				"key" => 5,
				"message" => "operation key invalid"
			)
		),
		"USER_HEADER_VALID" => array(
			array(
				"key" => 6,
				"message" => "this user key is not existed"
			)
		)
	);

?>