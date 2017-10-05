<?php

namespace SBVideo\Video\Controller;

use SBWebApplication\Application as App;
use SBWebApplication\Module\Module;
use SBVideo\Video\Model\Project;

class SiteController
{
    /**
     * @var Module
     */
    protected $video;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->video = App::module('sbvideo/video');
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        if (!App::node()->hasAccess(App::user())) {
            App::abort(403, __('Insufficient User Rights.'));
        }

        if (!preg_match('/^(date|title|priority)\|(asc|desc)$/i', $this->video->config('project_ordering', 'date|DESC'), $order)) {
            $order = [1 => 'date', 2 => 'desc'];
        }

        $query = Project::where(['date < ?', 'status = 1'], [new \DateTime])->orderBy($order[1], $order[2]);

		$video_text = '';
		if ($this->video->config('video_text')) {
			$video_text = App::content()->applyPlugins($this->video->config('video_text'), ['markdown' => $this->video->config('markdown_enabled')]);;
		}

		foreach ($projects = $query->get() as $project) {
			$project->intro = App::content()->applyPlugins($project->intro, ['project' => $project, 'markdown' => $project->get('markdown')]);
			$project->content = App::content()->applyPlugins($project->content, ['project' => $project, 'markdown' => $project->get('markdown'), 'readmore' => true]);
        }

        return [
            '$view' => [
                'title' => $this->video->config('video_title') ?: App::node()->title,
                'name' => 'sbvideo/video/video.php'
            ],
			'tags' => Project::allTags(),
      		'video' => $this->video,
			'config' => $this->video->config(),
			'video_text' => $video_text,
            'projects' => $projects,
			'node' => App::node()
        ];
    }

    /**
     * @Route("/{id}", name="id")
     */
    public function projectAction($id = 0)
    {
        if (!$project = Project::where(['id = ?', 'date < ?', 'status = 1'], [$id, new \DateTime])->first()) {
            App::abort(404, __('Project not found.'));
        }

        $project->intro = App::content()->applyPlugins($project->intro, ['project' => $project, 'markdown' => $project->get('markdown')]);
        $project->content = App::content()->applyPlugins($project->content, ['project' => $project, 'markdown' => $project->get('markdown')]);

		$previous = Project::getPrevious($project);
		$next = Project::getNext($project);

        if ($breadcrumbs = App::module('sbvideo/breadcrumbs')) {
            $breadcrumbs->addUrl([
                'title' => $project->title,
                'url' => '',
            ]);
        }

        return [
            '$view' => [
                'title' => __($project->title),
                'name' => 'sbvideo/video/project.php'
            ],
            'video' => $this->video,
			'config' => $this->video->config(),
			'previous' => $previous,
			'next' => $next,
			'project' => $project,
			'node' => App::node()
        ];
    }
}
