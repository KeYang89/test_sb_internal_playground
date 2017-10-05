<?php


namespace SB\PkFramework\Filter;

use SBWebApplication\Filter\AbstractFilter;

class FileSizeFilter extends AbstractFilter {

	public function filter ($value) {
		$i = floor( log($value) / log(1024) );
		$units = ['B', 'kB', 'MB', 'GB', 'TB'];
		return number_format( $value / pow(1024, $i), 2) . ' ' . $units[$i];
	}

}
