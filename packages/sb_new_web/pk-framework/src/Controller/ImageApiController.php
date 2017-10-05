<?php

namespace SB\PkFramework\Controller;

use SB\PkFramework\Helpers\ImageHelper;
use SBWebApplication\Application as App;

/**
 * @Route("image", name="image")
 */
class ImageApiController
{
    /**
     * @Route("/", methods="GET")
     * @Request({"folder": "string"})
     */
    public function indexAction($folder = '')
    {

		$images = [];

		$folder = trim($folder, '/');
		$pttrn  = '/\.(jpg|jpeg|gif|png)$/i';
		$dir    = App::path();

		if (!$files = glob($dir.'/'.$folder.'/*')) {
			return [];
		}


		foreach ($files as $img) {

			// extension filter
			if (!preg_match($pttrn, $img)) {
				continue;
			}

			$data = array();

			$data['filename'] = basename($img);
			// remove extension
			$data['title'] = preg_replace('/\.[^.]+$/', '', $data['filename']);

			// remove leading number
			$data['title'] = preg_replace('/^\d+\s?+/', '', $data['title']);

			// remove trailing numbers
			$data['title'] = preg_replace('/\s?+\d+$/', '', $data['title']);

			// replace underscores with space and add capital
			$data['title'] = ucfirst(trim(str_replace(['_', '-'], ' ', $data['title'])));

            $data['image']['src'] = $folder.'/'.basename($img);
            $data['image']['alt'] = $data['title'];

            $images[] = $data;
		}

        return $images;
    }

	/**
	 * @Route("/clearcache", methods="GET")
	 * @Access("system: manage settings")
	 */
	public function clearcacheAction()
	{
		ImageHelper::clearCache(['temp' => true]);
		return ['message' => 'Cache cleared'];
	}
}
