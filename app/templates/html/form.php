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
	<?= favicon();?>
	<?= styles($this->name, $this->styles)?>
	<?= scripts($this->name, $this->scripts);?>
	<?= google_analytics();?>
</head>

<body class="<?php if ($this->theme_open) echo 'open';?>">
    
	<?php include_once(__ROOT__.'/app/templates/html/header.php');?>

	<main>
		<div id="bgr" class="bgr <?php if (isset($form['bgr_color'])) echo 'bgr-'.$form['bgr_color'];?>" <?= $form['bgr'] ?? img_css(__IMG__.'backgrounds/blank.png');?>></div>
		
		<div class="form-tbl">
			<div class="form-cell">
				<form class="form" method="POST">

					<div class="form-head">
						<h1 class="form-title"><?= $title ?? $this->title;?></h1>
					</div>
					
					<div class="form-body">
						<?php
							if ($this->default && file_exists($file = __ROOT__.'/app/templates/html/'.$this->name.'.php')) include_once($file);
							else if (file_exists($file = __ROOT__.'/views/html/'.$this->name.'.php')) include_once($file);
						?>
					</div>
				</form>
			</div>
		</div>
	</main>

	<?php //include_once(__ROOT__.'/app/templates/html/footer.php');?>
	
</body>
</html>