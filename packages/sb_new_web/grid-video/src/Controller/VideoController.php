<?php

namespace SBVideo\Video\Controller;

use SBWebApplication\Application as App;
use SBVideo\Video\Model\Project;

/**
 * @Access(admin=true)
 */
class VideoController
{
    /**
     * @Access("video: manage video")
     * @Request({"filter": "array", "page":"int"})
     */
    public function projectAction($filter = null, $page = 0)
    {
        return [
            '$view' => [
                'title' => __('Video'),
                'name'  => 'sbvideo/video/admin/video.php'
            ],
            '$data' => [
				'statuses' => Project::getStatuses(),
				'config'   => [
                    'filter' => $filter,
                    'page'   => $page
                ]
            ]
        ];
    }

    /**
     * @Route("/project/edit", name="project/edit")
     * @Access("video: manage video")
     * @Request({"id": "int"})
     */
    public function editAction($id = 0)
    {
        try {

            if (!$project = Project::where(compact('id'))->first()) {

                if ($id) {
                    App::abort(404, __('Invalid project id.'));
                }

				$module = App::module('sbvideo/video');

				$project = Project::create([
					'data' => [],
					'image' => ['teaser' => [], 'main' => []],
					'tags' => [],
					'status' => 1,
					'date' => new \DateTime()
				]);

				$project->set('markdown', $module->config('markdown'));

			}


            return [
                '$view' => [
                    'title' => $id ? __('Edit project') : __('Add project'),
                    'name'  => 'sbvideo/video/admin/project.php'
                ],
                '$data' => [
					'statuses' => Project::getStatuses(),
					'config' => App::module('sbvideo/video')->config(),
                	'project'  => $project,
                    'tags'     => Project::allTags()
                ],
                'project' => $project
            ];

        } catch (\Exception $e) {

            App::message()->error($e->getMessage());

            return App::redirect('@video/post');
        }
    }

    /**
     * @Access("system: access settings")
     */
    public function settingsAction()
    {
		$video = App::module('sbvideo/video');
        return [
            '$view' => [
                'title' => __('Video settings'),
                'name'  => 'sbvideo/video/admin/settings.php'
            ],
            '$data' => [
				'cache_path' => $video->getCachepath(),
                'config' => $video->config()
            ]
        ];
    }

	/**
	 * @Access("system: access settings")
	 * @Request({"config": "array"}, csrf=true)
	 */
	public function configAction($config = [])
	{
		App::config('sbvideo/video')->merge($config, true)->set('datafields', $config['datafields']);

		return ['message' => 'success'];
	}

}
