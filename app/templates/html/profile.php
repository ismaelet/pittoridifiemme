<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<meta name="description" content="<?= sysData('desc_'.sysData('lang'));?>">
	<meta property="og:image" content="<?= sysData('logo');?>">
	<meta property="og:description" content="<?= sysData('desc_'.sysData('lang'));?>">

	<title>
		<?php
			if (isset($this->title)) echo $this->title.' | '.sysData('name');
			else {
				echo sysData('name');
				if (!empty(sysData('desc_shr_'.sysData('lang')))) echo ' | '.sysData('desc_shr_'.sysData('lang'));
			}
		?>
	</title>

	<?= preload()?>
	<?= styles()?>
	<?= scripts();?>
	<?= favicon();?>
	<?= google_analytics();?>

</head>

<body>
    
	<?php include_once(__ROOT__.'/app/templates/html/header.php');?>

	<main>
		<?php include_once('profile/head.php');?>

		<div class="wrap-wide">

			<div id="body" class="tbl marv3">
				
				<?php include_once('profile/nav.php');?>
				
				<div id="content" class="cell">

					<?php include_once(__ROOT__.'/views/html/'.$this->name.'.php');?>

				</div>
			</div>
		</div>
	</main>

	<?php include_once(__ROOT__.'/app/templates/html/footer.php');?>
	
</body>
</html>