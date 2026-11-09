{% block content %}

<div class="grid-flow" data-columns="25rem" data-spacing="700">

	<?php foreach ($panels as $panel) { ?>

		<!-- Panel -->
		<section class="panel">
			<div class="panel__header">
				<div class="panel__icon">
					<?= icon_embed(APP_ICONS_DIR . 'navigation/' . $panel['slug']) ?>
				</div>
				<h3 class="panel__title"><?= $panel['title'] ?></h3>
			</div>

			<div class="panel__body">
				<p class=""><?= $panel['info'] ?></p>
			</div>

			<div class="panel__footer">
				<a href="<?= $panel['primary-button']['link'] ?>" class="button button--full-width"><?= $panel['primary-button']['label'] ?></a>
				<a href="<?= $panel['secondary-button']['link'] ?>" class="button button--secondary button--full-width"><?= $panel['secondary-button']['label'] ?></a>
			</div>
		</section>

	<?php } ?>

</div>

{% end content %}