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
	<?= favicon(); ?>
	<?= styles($this->name, $this->styles) ?>
	<?= scripts($this->name, $this->scripts); ?>
	<?= google_analytics(); ?>

</head>

<body class="<?php if ($this->theme_open) echo 'open'; ?>">

	<?php include_once(SERVER_ROOT . '/app/templates/html/header.php'); ?>

	<main class="tbl">
		<?php include_once('manage/nav.php'); ?>

		<div id="content" class="cell">
			<div id="wrap">
				<?php include_once(SERVER_ROOT . '/views/html/' . $this->name . '.php'); ?>
			</div>
		</div>
	</main>

	<?php include_once(SERVER_ROOT . '/app/templates/html/footer.php'); ?>

</body>

</html>