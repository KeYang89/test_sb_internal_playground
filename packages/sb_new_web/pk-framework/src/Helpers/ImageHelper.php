<?php


namespace SB\PkFramework\Helpers;

use SBWebApplication\Application as App;
use SBWebApplication\View\Helper\Helper;
use abeautifulsite\SimpleImage;

class ImageHelper extends Helper {

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
		return 'biximage';
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
		$resource = array_replace(['src' => ''], (array)$resource);
		if (!$resource['src'] || !App::locator()->get($resource['src'])) {
		    //try to find encoded filename
            if ($resource['src'] and $path = App::locator()->get(urldecode($resource['src']))) {
                $resource['src'] = $this->basePath($path);
                return $resource;
            }
            //create default noimage
			$resource['src'] = 'packages/sb_new_web/pk-framework/assets/noimage.jpg';
			$resource['filename'] = 'noimage.jpg';
			$resource['alt'] = 'No image found';
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
            $image_path = App::locator()->get($source);
			$cachepath = $this->getCachePath($image_path, $options);

			if (!file_exists($cachepath)) {

				$image = new SimpleImage($image_path);

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

			return $this->basePath($cachepath);

		} catch (\Exception $e) {
			return false;
		}
	}

    /**
     * @param $fullpath
     * @return string
     */
    protected function basePath ($fullpath) {
        return trim(str_replace(App::path(), '', $fullpath), '/');
	}
	/**
	 * @param string $source
	 * @param array $options
	 * @return string
	 */
	protected function getCachePath ($source, $options) {

		$folder = $this->app->module('sb/pk-framework')->getImageCachepath();
		$cachename = md5($source . filemtime($source) . serialize($options)) . '-' . basename($source);

		return "$folder/$cachename";
	}

	/**
	 * @param array $options
	 */
	public static function clearCache ($options = []) {

		if (@$options['temp'] and $cache_path = App::module('sb/pk-framework')->getImageCachepath()) {
			App::file()->delete($cache_path);
		}

	}
}