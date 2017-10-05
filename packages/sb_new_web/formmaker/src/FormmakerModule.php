<?php

namespace SB\Formmaker;

use SB\Formmaker\Model\Submission;
use SBWebApplication\Application as App;
use SB\Formmaker\Plugin\FormmakerPlugin;
use SBWebApplication\Module\Module;
use SB\Formmaker\Model\Form;

class FormmakerModule extends Module {
    /**
     * SB Framework Module version
     */
    const REQUIRED_FRAMEWORK_VERSION = '0.1.6';
	/**
	 * @var \SB\PkFramework\FrameworkModule
	 */
	protected $framework;
	/**
	 * @var array
	 */
	protected $fieldTypes;

	/**
	 * {@inheritdoc}
	 */
	public function main (App $app) {

		$app->on('boot', function () use ($app) {
			$this->framework = $app->module('sb/pk-framework');
		});

		$app->subscribe(
			new FormmakerPlugin()
		);

	}

	/**
	 * @param  string $type
	 * @return \SB\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType ($type) {
		$types = $this->getFieldTypes();

		return isset($types[$type]) ? $types[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getFieldTypes () {
        if (!$this->framework) {
            return [];
        }
		if (!$this->fieldTypes) {
			$this->fieldTypes = $this->framework->getFieldTypes('sb/formmaker');
		}

		return $this->fieldTypes;
	}

    /**
     * @param App   $app
     * @param int   $form_id
     * @param array $options
     * @param null  $view
     * @return mixed
     */
	public function renderForm (App $app, $form_id, $options = [], $view = null) {

        if (!$this->framework) {
            throw new App\Exception('SB Framework Extension required!');
        }
		$user = $app->user();
		/** @var Form $form */
		if (!$form = Form::where(['id = ?'], [$form_id])->where(function ($query) use ($user) {
			if (!$user->isAdministrator()) $query->where('status = 1');
		})->related('fields')->first()
		) {
			throw new App\Exception('Form not found', 404) ;
		}
		foreach ($options as $key => $value) {
			$form->set($key, $value);
		}

		$form->prepareView($app, $this);

		return $app->view($view ?: 'sb/formmaker/form.php');
	}

	/**
	 * public accessable config
	 * @return array
	 */
	public function publicConfig () {
		return array_intersect_key(static::config(), array_flip(['recaptha_sitekey']));
	}

    /**
     * @return bool|string
     */
    public function checkFramework () {
        if (!$package = App::package('sb/pk-framework')) {
            return __('Please install the SB Framework.');
        }
        if (!$module = App::module('sb/pk-framework')) {
            return __('Please enable the SB Framework.');
        }
        if (version_compare(self::REQUIRED_FRAMEWORK_VERSION, $package->get('version')) == 1) {
            return __('Please update the SB Framework to version %version%.', ['%version%' => self::REQUIRED_FRAMEWORK_VERSION]);
        }
        return true;
    }
}
