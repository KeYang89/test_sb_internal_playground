<?php
/**
 * @var $view
 * @var array $tags
 * @var array $config
 * @var SBWebApplication\Module\Module $video
 * @var SBVideo\Video\Model\Project $project
 */
$view->script('video', 'sbvideo/video:app/bundle/video.js', ['uikit-grid', 'uikit-lightbox']);

// Grid
$grid  = 'uk-grid-width-1-'.$config['columns'];
$grid .= $config['columns_small'] ? ' uk-grid-width-small-1-'.$config['columns_small'] : '';
$grid .= $config['columns_medium'] ? ' uk-grid-width-medium-1-'.$config['columns_medium'] : '';
$grid .= $config['columns_large'] ? ' uk-grid-width-large-1-'.$config['columns_large'] : '';
$grid .= $config['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$config['columns_xlarge'] : '';

// Grid teaser
$config['grid_teaser']  = 'uk-grid-width-1-'.$config['teaser']['columns'];
$config['grid_teaser'] .= $config['teaser']['columns_small'] ? ' uk-grid-width-small-1-'.$config['teaser']['columns_small'] : '';
$config['grid_teaser'] .= $config['teaser']['columns_medium'] ? ' uk-grid-width-medium-1-'.$config['teaser']['columns_medium'] : '';
$config['grid_teaser'] .= $config['teaser']['columns_large'] ? ' uk-grid-width-large-1-'.$config['teaser']['columns_large'] : '';
$config['grid_teaser'] .= $config['teaser']['columns_xlarge'] ? ' uk-grid-width-xlarge-1-'.$config['teaser']['columns_xlarge'] : '';

$config['video_image_class'] = in_array($config['video_image_align'], ['right', 'left']) ? 'uk-align-' . $config['video_image_align'] : 'uk-text-center'
?>

<article id="video-projects">

	<?php if ($config['video_title']) : ?>
	    <h1 class="uk-article-title"><?= $config['video_title'] ?></h1>
	<?php endif; ?>
	<div class="uk-clearfix">

		<?php if ($config['video_image']) : ?>
			<div class="<?= $config['video_image_class'] ?>">
				<img src="<?= $config['video_image'] ?>" alt="">
			</div>

		<?php endif; ?>

		<?php if ($video_text) : ?>
			<?= $video_text ?>
		<?php endif; ?>

	</div>

	<?php if ($config['filter_tags'] && count($tags)) : ?>
	<div class="uk-tab-center uk-margin">
			<ul id="video-filter" class="uk-tab">
			<li class="uk-active" data-uk-filter=""><a href=""><?= __('All') ?></a></li>
			<?php foreach ($tags as $tag) : ?>
				<li data-uk-filter="<?= $tag ?>"><a href=""><?= __($tag) ?></a></li>
			<?php endforeach; ?>

		</ul>
	</div>
	<?php endif; ?>
	
	<div class="uk-grid <?= $grid ?>" data-uk-grid="{gutter: <?= $config['columns_gutter'] ?>, controls: '<?= $config['filter_tags'] ? '#video-filter': ''; ?>'}">

		<?php foreach ($projects as $project) : ?>

			<?= $view->render(sprintf('sbvideo/video/templates/teaser_%s.php', $config['teaser']['template']), ['config' => $config, 'project' => $project]) ?>

		<?php endforeach; ?>

	</div>
</article>