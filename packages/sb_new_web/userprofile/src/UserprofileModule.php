<?php

namespace SB\Userprofile;

use SB\Userprofile\Event\RouteListener;
use SB\Userprofile\Event\UserListener;
use SBWebApplication\Application as App;
use SBWebApplication\Module\Module;
use SB\Userprofile\Model\Profilevalue;
use SB\Userprofile\Model\Field;
use SBWebApplication\User\Model\User;

class UserprofileModule extends Module {
    /**
     * SB Framework Module version
     */
    const REQUIRED_FRAMEWORK_VERSION = '0.1.6';
	/**
	 * @var \ SB\PkFramework\FrameworkModule
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
			$app->subscribe(
				new RouteListener(),
				new UserListener()
			);
		});

	}

	/**
	 * @param User|null $user
	 * @param bool      $asArray
	 * @param bool      $checkAccess
	 * @return array|bool
	 */
	public function getProfile (User $user = null, $asArray = true, $checkAccess = true) {
		$profile = [];
        if (!$this->framework) {
            return $profile;
        }
		if (($user = $user ?: App::user()) and $user->id > 0) {
			$profileValues = Profilevalue::getUserProfilevalues($user);
		}
		foreach (Field::getProfileFields($checkAccess) as $field) {
			$fieldValue = isset($profileValues[$field->id]) ? $profileValues[$field->id] : Profilevalue::create([
				'field_id' => $field->id,
				'user_id' => $user->id,
				'multiple' => $field->get('multiple') == 1 ? 1 : 0,
				'data' => $field->get('data')
			])->setField($field)->setValue($field->get('value'));
			if ($asArray) {
				$profile[$field->slug] = $fieldValue->setField($field)->toFormattedArray(['id' => $fieldValue->id]);
			} else {
				$profile[$field->slug] = $fieldValue->setField($field);
			}
		}
		return $profile;
	}

	/**
	 * @param  string $type
	 * @return \ SB\PkFramework\FieldType\FieldTypeBase
	 */
	public function getFieldType ($type) {
		$fieldTypes = $this->getFieldTypes();

		return isset($fieldTypes[$type]) ? $fieldTypes[$type] : null;
	}

	/**
	 * @return array
	 */
	public function getFieldTypes () {
        if (!$this->framework) {
            return [];
        }
		if (!$this->fieldTypes) {
			$this->fieldTypes = $this->framework->getFieldTypes('sb/userprofile');
		}

		return $this->fieldTypes;
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
