<?php


namespace SBVideo\Video;

use SBWebApplication\Application as App;
use SBWebApplication\View\Helper\Helper;
use abeautifulsite\SimpleImage;

class VideoImageHelper extends Helper {

	/**
	 * @var App
	 */
	protected $app;

	/**
	 * @param App $app
	 */
	public function __construct (App $app) {
		$this->app = $app;
	}

	/**
	 * Set shortcuts.
	 * @param string $name
	 * @param array $args
	 * @return bool|mixed
	 */
	public function __invoke ($name, $args = []) {

		if (is_callable([$this, $name])) {
			return call_user_func_array([$this, $name], (array)$args);
		}
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName () {
		return 'videoimage';
	}

	/**
	 * @param array $resource
	 * @param array $options
	 * @return mixed
	 */
	public function url ($resource, $options = []) {
		$resource = $this->validResource($resource);
		if (!empty($options['width']) || !empty($options['height'])) {

			if ($resized = $this->resizeImage($resource['src'], $options)) {
				return $resized;
			}

		}
		return $resource['src'];
	}

	/**
	 * @param array $resource
	 * @return array
	 */
	protected function validResource ($resource) {
		$resource = array_replace(['src' => ''], $resource);
		if (!file_exists($resource['src'])) {

			$resource['src'] = 'packages/sbvideo/video/assets/noimage.jpg';
			$resource['filename'] = 'noimage.jpg';
			$resource['title'] = 'No image found';

		}
		return $resource;
	}

	/**
	 * @param string $source
	 * @param array $options
	 * @return bool|mixed
	 */
	protected function resizeImage ($source, $options) {
		try {

			$cachepath = $this->getCachePath($source, $options);

			if (!file_exists($cachepath)) {

				$image = new SimpleImage(App::path() . '/' . $source);

				if (!empty($options['width']) && empty($options['height'])) {
					$image->fit_to_width($options['width']);
				}
				if (!empty($options['height']) && empty($options['width'])) {
					$image->fit_to_height($options['height']);
				}
				if (!empty($options['height']) && !empty($options['width'])) {
					$image->thumbnail($options['width'], $options['height']);
				}

				$image->save($cachepath);
			}

			return trim(str_replace(App::path(), '', $cachepath), '/');

		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * @param string $source
	 * @param array $options
	 * @return string
	 */
	protected function getCachePath ($source, $options) {

		$folder = $this->app->module('sbvideo/video')->getCachepath();
		$cachename = md5($source . filemtime($source) . serialize($options)) . '-' . basename($source);

		return "$folder/$cachename";
	}

	/**
	 * @param array $options
	 */
	public static function clearCache ($options = []) {

		if (@$options['temp'] and $cache_path = App::module('sbvideo/video')->getCachepath()) {
			App::file()->delete($cache_path);
		}

	}
}