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

<body>

	<main>
		<?php
		if ($this->default && file_exists($file = SERVER_ROOT . '/app/templates/html/' . $this->name . '.php')) include_once($file);
		else if (file_exists($file = SERVER_ROOT . '/views/html/' . $this->name . '.php')) include_once($file);
		?>
	</main>

</body>

</html>