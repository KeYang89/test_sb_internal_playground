<?php

namespace SB\PkFramework;

use SB\PkFramework\Helpers\ImageHelper;
use SBWebApplication\Application as App;
use SBWebApplication\Kernel\Exception\HttpException;
use SBWebApplication\Module\Module;
use SB\PkFramework\FieldType\FieldTypeBase;

class FrameworkModule extends Module {
	/**
	 * @var FieldTypeBase[]
	 */
	protected $fieldTypes;

	protected $fieldExtensions = ['sb/formmaker', 'sb/userprofile', 'sb/customcontent'];

    protected $version_key;

    /**
     * {@inheritdoc}
	 */
	public function main (App $app) {
		$app['filter']->register('bixfilesize', 'SB\PkFramework\Filter\FileSizeFilter');


        $app->on('boot', function ($event, $app) {
            $app->extend('view', function ($view) use ($app) {
                return $view->addHelper(new ImageHelper($app));
            });

//            $app->error(function (HttpException $exception) use ($app) {
//
//                $request = $app['router']->getRequest();
//                $types   = $request->getAcceptableContentTypes();
//
//                if ('html' == $request->getFormat(array_shift($types))) {
//                    $code =  $exception->getCode();
//                    if (is_subclass_of($exception, 'SBWebApplication\Kernel\Exception\HttpException')) {
//                        $title = $exception->getMessage();
//                    } else {
//                        $title = __('Whoops, looks like something went wrong.');
//                    }
//
//                    $response = App::view('sb/pk-framework/error/error.php', compact('title', 'exception', 'code'));
//
//                    return App::response($response, $code);
//                }
//
//            }, 0);

        });
	}

    /**
     * @param string $version
     * @return mixed
     */
    public function getVersionKey ($version = '') {
        $secret = App::system()->config('secret');
        $version = $version ? : App::package('sb/pk-framework')->get('version');
        return substr(sha1(App::version() . $version . $secret), 0, 4);
    }

	/**
	 * @param  string $type
	 * @return FieldTypeBase
	 */
	public function getFieldType ($type) {
		$types = $this->getFieldTypes();

		return isset($types[$type]) ? $types[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getFieldTypes ($extension = null) {
		//todo cache this
		if (!$this->fieldTypes) {

			$this->fieldTypes = [];
			/** @noinspection PhpUnusedLocalVariableInspection */
			$app = App::getInstance(); //available for index.php files
			$paths = [];

			foreach (App::module() as $module) {
				if ($module->get('fieldtypes')) {
					$paths = array_merge($paths, glob(sprintf('%s/%s/*/index.php', $module->path, $module->get('fieldtypes')), GLOB_NOSORT) ?: []);
				}
			}

			foreach ($paths as $p) {
				$package = array_merge ([
					'id' => '',
					'path' => dirname($p),
					'main' => '',
					'extensions' => $this->fieldExtensions,
					'class' => '\SB\PkFramework\FieldType\FieldType',
					'loadScript' => false,
					'resource' => 'sb/pk-framework:app/bundle',
					'config' => [
						'hasOptions' => 0,
						'readonlyOptions' => 0,
						'required' => 0,
						'multiple' => 0,
					],
					'methods' => [],
					'dependancies' => [],
					'styles' => [],
					'getOptions' => '',
					'prepareValue' => '',
					'formatValue' => '',
				], include($p));
				$this->registerFieldType($package);
			}

		}
		if ($extension) {
			return array_filter($this->fieldTypes, function ($fieldType) use ($extension) {
				/** @var FieldTypeBase $fieldType */
			    return in_array($extension, $fieldType->getExtensions());
			});
		}

		return $this->fieldTypes;
	}

	/**
	 * Register a field type.
	 * @param array $package
	 */
	protected function registerFieldType ($package) {
		$loader = App::get('autoloader');
		if (isset($package['autoload'])) {
			foreach ($package['autoload'] as $namespace => $path) {
				$loader->addPsr4($namespace, $this->resolvePath($package, $path));
			}
		}
		$this->fieldTypes[$package['id']] = new $package['class']($package);
	}

    /**
     * @return bool|string
     */
    public function getImageCachepath () {
        if ($folder = App::locator()->get(App::module('sb/pk-framework')->config('image_cache_path'))
                and is_writable($folder)) { //all fine, quick return
            return $folder;
        }
        //try to create user-folder
        App::file()->makeDir($folder, 0755);
        if (!file_exists($folder)) {
            //create default folder
            $folder = $this->app['path.storage'] . '/SB';
            if (!file_exists($folder)) {
                App::file()->makeDir($folder, 0755);
            }
        }
        if (!file_exists($folder) || !is_writable($folder)) { //give up
            return false;
        }
        return $folder;
    }

	/**
	 * Resolves a path to a absolute module path.
	 *
	 * @param  array  $package
	 * @param  string $path
	 * @return string
	 */
	protected function resolvePath($package, $path) {

		$path = strtr($path, '\\', '/');

		if (!($path[0] == '/' || (strlen($path) > 3 && ctype_alpha($path[0]) && $path[1] == ':' && $path[2] == '/'))) {
			$path = $package['path']."/$path";
		}

		return $path;
	}

}
