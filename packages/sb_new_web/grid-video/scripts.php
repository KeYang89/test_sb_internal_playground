<?php

use Doctrine\DBAL\Schema\Comparator;

return [

    'install' => function ($app) {

		$util = $app['db']->getUtility();

		if ($util->tableExists('@video_project') === false) {
			$util->createTable('@video_project', function ($table) {
				$table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
				$table->addColumn('status', 'smallint');
				$table->addColumn('priority', 'integer', ['default' => 0]);
				$table->addColumn('title', 'string', ['length' => 255]);
				$table->addColumn('slug', 'string', ['length' => 255]);
				$table->addColumn('subtitle', 'string', ['length' => 255, 'notnull' => false]);
				$table->addColumn('intro', 'text', ['notnull' => false]);
				$table->addColumn('content', 'text', ['notnull' => false]);
				$table->addColumn('client', 'string', ['length' => 255, 'notnull' => false]);
				$table->addColumn('image', 'json_array', ['notnull' => false]);
				$table->addColumn('date', 'datetime');
				$table->addColumn('tags', 'simple_array', ['notnull' => false]);
				$table->addColumn('images', 'json_array', ['notnull' => false]);
				$table->addColumn('data', 'json_array', ['notnull' => false]);
				$table->setPrimaryKey(['id']);
				$table->addIndex(['status'], 'PORTFOLIO_PROJECT_STATUS');
			});
		}

    },

    'uninstall' => function ($app) {

        $util = $app['db']->getUtility();

        if ($util->tableExists('@video_project')) {
            $util->dropTable('@video_project');
        }
		// remove the config
		$app['config']->remove('sbvideo/video');

	},

	'updates' => [

		'1.1.0' => function ($app) {
			//convert config to new module name
			$app['config']->set('sbvideo/video', $app->config('video')->toArray());
			$app['config']->remove('video');

			$util = $app['db']->getUtility();

			if ($util->tableExists('@video_project')) {
				$table =  $util->listTableDetails('@video_project');
				if (!$table->hasColumn('status')) {
					$table->addColumn('status', 'smallint');
					$table->addIndex(['status'], 'PORTFOLIO_PROJECT_STATUS');
					$util->alterTable((new Comparator())->diffTable($util->listTableDetails('@video_project'), $table));
					$app['db']->executeQuery('UPDATE @video_project SET status = 1');

				}

			}

		}

	]

];