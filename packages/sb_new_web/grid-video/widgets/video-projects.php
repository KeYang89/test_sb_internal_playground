<?php

use SBVideo\Video\Model\Project;

return [

    'name' => 'sbvideo/video-projects',

    'label' => 'Video projects',

    'events' => [

        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('widget-video-projects', 'sbvideo/video:app/bundle/widget-video-projects.js', ['~widgets']);
        },

    ],

    'render' => function ($widget) use ($app) {

        $query = Project::query()->where(['status' => Project::STATUS_PUBLISHED]);

        switch ($widget->get('content_selection', 'random')) {
            case 'random':
                $query->orderBy('RAND()');
                break;
            case 'latest':
                $query->orderBy('date', 'desc');
                break;
            case 'pick':
                $query->whereInSet('id', $widget->get('items', []));
                $query->orderBy('title', 'asc');
                break;
            default:
                return 'No valid content select';
                break;
        }

        $query->limit($widget->get('count', 4));

        $projects = array_values($query->get());

        $config = $app->module('sbvideo/video')->config();
        $teaser_config = $widget->get('teaser');

        return $app['view']('sbvideo/video/widgets/video-projects.php',
            compact('widget', 'projects', 'config', 'teaser_config'));

    }

];
