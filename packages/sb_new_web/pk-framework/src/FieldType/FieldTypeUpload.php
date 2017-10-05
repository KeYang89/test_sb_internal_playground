<?php


namespace SB\PkFramework\FieldType;

use SBWebApplication\Application as App;
use SB\PkFramework\Field\FieldBase;
use SB\PkFramework\FieldValue\FieldValueBase;
use SBWebApplication\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FieldTypeUpload extends FieldTypeBase {

	/**
	 * @param FieldBase    $field
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function formatValue (FieldBase $field, FieldValueBase $fieldValue) {
		$valuedata = $fieldValue->getValuedata();
		if (count($valuedata)) {
			return array_map(function ($file) {
				if (!isset($file['url'])) return '';
				return sprintf('<a href="%s" download>%s</a> <small>(%s)</small>',
					App::url($file['url'], [], UrlGenerator::ABSOLUTE_URL),
					$file['name'],
					App::filter($file['size'], 'bixfilesize')
				);
			}, $valuedata);
		}
		return ['-'];
	}


	/**
	 * @param FieldValueBase $fieldValue
	 * @return array
	 */
	public function uploadAction (FieldValueBase $fieldValue) {
		try {

			if (!$path = $this->getPath($fieldValue->field->get('path'))) {
				return $this->error(__('Invalid path.'));
			}

			if (!is_dir($path) || !App::user()->hasAccess('system: manage storage | SB: upload files')) {
				return $this->error(__('Permission denied.'));
			}

			$fileInfo = [];
			$files = App::request()->files->get('files');

			if (!$files) {
				return $this->error(__('No files uploaded.'));
			}
			/** @var UploadedFile $file */
			foreach ($files as $file) {

				if (!$file->isValid()) {
					return $this->error(sprintf(__('Uploaded file invalid. (%s)'), $file->getErrorMessage()));
				}

				if (!$ext = $file->guessExtension() or !in_array($ext, $fieldValue->field->get('allowed', []))) {
					return $this->error(__('File extension not allowed.'));
				}

				if (!$size = $file->getClientSize() or $size > ($fieldValue->field->get('max_size', 0) * 1024 * 1024)) {
					return $this->error(__('File is too large.'));
				}
				//give file unique name with correct extension
				$local_name = sprintf('%d%d-%s',
					(microtime(true) * 10000), rand(), preg_replace("/[^a-zA-Z0-9\.]/", "-", $file->getClientOriginalName()));
				$local_name = rtrim($local_name, '.' . $ext) . '.' . $ext;

				$localFile = $file->move($path, $local_name);

				$fileInfo[] = [
					'name' => basename($localFile),
					'size' => $localFile->getSize(),
					'path' => str_replace(App::path(), '', $localFile->getPathname()),
					'url'  => ltrim(App::url()->getStatic($localFile->getPathname(), [], 'base'), '/')
				];
			}

			return [
				'message' => __('Upload complete.'),
				'files' => $fileInfo
			];

		} catch (\Exception $e) {

			return $this->error(__('Unable to upload.'));
		}
	}


	/**
	 * @param string $path
	 * @return string
	 */
	protected function getPath ($path = '') {
		$root = strtr(App::path(), '\\', '/');
		$path = $this->normalizePath($root . '/storage/' . $path);
		if (!is_dir($path)) {
			App::file()->makeDir($path);
		}
		return $path;
	}

	/**
	 * Normalizes the given path
	 * @param  string $path
	 * @return string
	 */
	protected function normalizePath ($path) {
		$path = str_replace(['\\', '//'], '/', $path);
		$prefix = preg_match('|^(?P<prefix>([a-zA-Z]+:)?//?)|', $path, $matches) ? $matches['prefix'] : '';
		$path = substr($path, strlen($prefix));
		$parts = array_filter(explode('/', $path), 'strlen');
		$tokens = [];

		foreach ($parts as $part) {
			if ('..' === $part) {
				array_pop($tokens);
			} elseif ('.' !== $part) {
				array_push($tokens, $part);
			}
		}

		return $prefix . implode('/', $tokens);
	}

	protected function error ($message) {
		return ['error' => true, 'message' => $message];
	}


}