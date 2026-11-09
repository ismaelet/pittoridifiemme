<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<meta name="description" content="<?= sys_config('desc_' . sys_config('lang')); ?>">
	<meta property="og:image" content="<?= sys_config('logo'); ?>">
	<meta property="og:description" content="<?= sys_config('desc_' . sys_config('lang')); ?>">

	<title>
		<?php
		if (isset($this->title)) echo $this->title . ' | ' . sys_config('name');
		else {
			echo sys_config('name');
			if (!empty(sys_config('desc_shr_' . sys_config('lang')))) echo ' | ' . sys_config('desc_shr_' . sys_config('lang'));
		}
		?>
	</title>

	<?= preload() ?>
	<?= styles() ?>
	<?= scripts(); ?>
	<?= favicon(); ?>
	<?= google_analytics(); ?>

</head>

<body>

	<?php include_once(SERVER_ROOT . '/app/templates/html/header.php'); ?>

	<main>
		<?php include_once('profile/head.php'); ?>

		<div class="wrap-wide">

			<div id="body" class="tbl marv3">

				<?php include_once('profile/nav.php'); ?>

				<div id="content" class="cell">

					<?php include_once(SERVER_ROOT . '/views/html/' . $this->name . '.php'); ?>

				</div>
			</div>
		</div>
	</main>

	<?php include_once(SERVER_ROOT . '/app/templates/html/footer.php'); ?>

</body>

</html>