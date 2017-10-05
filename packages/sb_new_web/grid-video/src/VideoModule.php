<?php

namespace SBVideo\Video;

use SBWebApplication\Application as App;
use SBWebApplication\Module\Module;

class VideoModule extends Module {
	/**
	 * @var array
	 */
	protected $types;

	/**
	 * {@inheritdoc}
	 */
	public function main (App $app) {
	}

	/**
	 * @return bool|string
	 */
	public function getCachepath () {
		$folder = App::path() .'/'.App::module('sbvideo/video')->config('cache_path');
		if (file_exists($folder) && is_writable($folder)) { //all fine, quick return
			return $folder;
		}
		//try to create user-folder
		App::file()->makeDir($folder, 0755);
		if (!file_exists($folder)) {
			//create default folder
			$folder = $this->app['path.cache'] . '/video';
			if (!file_exists($folder)) {
				App::file()->makeDir($folder, 0755);
			}
		}
		if (!file_exists($folder) || !is_writable($folder)) { //give up
			return false;
		}
		return $folder;
	}
}
