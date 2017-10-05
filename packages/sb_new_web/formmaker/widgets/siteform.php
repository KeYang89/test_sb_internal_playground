<?php

return [

    'name' => 'sb/siteform',

    'label' => 'Formmaker',

    'events' => [

        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('widget-siteform', 'sb/formmaker:app/bundle/widget-siteform.js', ['~widgets']);
        }

    ],

    'render' => function ($widget) use ($app) {

		$id = $widget->get('form_id');
		$formmaker = $app->module('sb/formmaker');

		try {
			return $formmaker->renderForm($app, $id, [
				'hide_title' => $widget->get('hide_title'),
				'formStyle' => $widget->get('formStyle')
			]);
		} catch (\SBWebApplication\Application\Exception $e) {
			return $e->getMessage();
		}
    }

];
