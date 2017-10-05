<?php


namespace SB\PkFramework\Helpers;


use SBWebApplication\Application as App;

class DateHelper {

	protected static $intl2php = [
		'yyyy' => 'Y',		//A full numeric representation of a year, 4 digits
		'yy' => 'y',		//A two digit representation of a year
		'y' => 'Y',			//A full numeric representation of a year, 4 digits
		'MMMM' => 'F',		//A full textual representation of a month, such as January or March
		'MMM' => 'M',		//A short textual representation of a month, three letters
		'MM' => 'm',		//Numeric representation of a month, with leading zeros
		'M' => 'n',			//Numeric representation of a month, without leading zeros
		'dd' => 'd',		//Day of the month without leading zeros+English ordinal suffix for the day of the month, 2 characters
		'd' => 'j',			//Day of the month without leading zeros
		'HH' => 'H',		//24-hour format of an hour with leading zeros
		'H' => 'G',			//24-hour format of an hour without leading zeros
		'hh' => 'h',		//12-hour format of an hour with leading zeros
		'h' => 'g',			//12-hour format of an hour without leading zeros
		'mm' => 'i',		//Minutes with leading zeros
		'm' => 'i',			//Minutes with leading zeros
		'sss' => 'u',		//Microseconds
		'ss' => 's',		//Seconds with leading zeros
		's' => 's',			//Seconds with leading zeros
		'EEEE' => 'l',		//A full textual representation of the day of the week
		'EEE' => 'D',		//A textual representation of a day, three letters
		'E' => 'N',			//ISO-8601 numeric representation of the day of the week
		'a' => 'a',			//Lowercase Ante meridiem and Post meridiem
		'Z' => 'P',			//Difference to Greenwich time (GMT) with colon between hours and minutes
		'ww' => 'W',		//	ISO-8601 week number of year, weeks starting on Monday
		'w' => 'W'			//	ISO-8601 week number of year, weeks starting on Monday
	];

	/**
	 * @param string $date
	 * @param string $format
	 * @param string $tz
	 * @return string
	 */
	public static function format ($date, $format = 'mediumDate', $tz = 'UTC') {
		try {

			if (is_string($date)) {
				$date = new \DateTime($date, new \DateTimeZone($tz));
			}

			return $date->format(static::getFormat($format));

		} catch (\Exception $e) {

			return $date;

		}
	}

	protected static function getFormat ($format) {
		$intl = App::module('system/intl');
		$formats = $intl->getFormats($intl->getLocale());
		$moment_format = isset($formats['DATETIME_FORMATS'][$format]) ? $formats['DATETIME_FORMATS'][$format] : $format;
		return strtr($moment_format, static::$intl2php);
	}
}