<?php

	class XCalenderManagement
	{
		// TODO: get class name for better handling XVersionManagement
		public static function className() {
			return get_class();
		}

		public function get_timestamp($_date/*1400/12/08*/, $_clock = null/*18:00*/)
		{
			if($_clock != null)
			{
				$splitClock = explode(':', $_clock);
				$splitDate = explode('/', $_date);
				return jmktime($splitClock[0], $splitClock[1],0, $splitDate[1], $splitDate[2], $splitDate[0]);
			}

			$splitDate = explode('/', $_date);
			return jmktime(0, 0,0, $splitDate[1], $splitDate[2], $splitDate[0]);
		}

		public function get_today()
		{
			$timeStamp = time();

			// TODO: get day name
			$_DayName = jdate("l", $timeStamp, "", '', "en");
			// TODO: get month name
			$_MonthName = jdate("F", $timeStamp, "", '', "en");
			// TODO: get current date
			$_Date = jdate("Y/m/d", $timeStamp, "", '', "en");
			// TODO: get current clock
			$_clock = jdate('H:i','','','','en');

			// TODO: get current timestamp
			$_timestamp = $this->get_timestamp($_Date, $_clock);

			$array = array(
				"m_date" => $_Date,
				"m_clock" => $_clock,
				"m_month_name" => $_MonthName,
				"m_day_name" => $_DayName,
				"m_timestamp" => $_timestamp
			);
			return $array;
		}

		public function get_calender($timestamp) {
			return jdate("Y/m/d", $timestamp, "", '', "en");
		}

		public function get_clock($timestamp) {
			return jdate('H:i', $timestamp,'','','en');
		}
	}
?>