<?php if (!isset($loc)) $loc = 'none';?>

<script>
	$(document).ready(function() {
		$('#navHm_inp').change(function() {
			if ($('#navHm').is(':visible')) {$('body').addClass("fixH");}
			else {$('body').removeClass("fixH");}
		});
	});
</script>

<header class="<?= $this->theme_color;?>">
	<div id="headH">
		<!--MAIN MENU-->
		<div id="navH">
			
			<!--LOGO-->
			<div id="navH_logo_cell" class="deskH">
				<a id="navH_logo" href="/">
					<h1 id="navH_titl" class="txt-ita txt-aaa"><span class="txt-reg txt-222">P</span>ittori<br> di <span class="txt-reg txt-222">F</span>iemme</h1>
				</a>
			</div>
			
			<!--Links-->
			<div class="linkH_cont deskH">
				<a href="/#art"><h1 class="linkH txt-light txt-blk-h">Pittori</h1></a>
				<a href="/#hist"><h1 class="linkH txt-light txt-blk-h">Storia</h1></a>
				
				<?php if (admin()) {?><a href="/admin">
					<h1 class="linkH txt-light txt-blk-h">Gestione</h1></a>
				<?php }?>
			</div>
			
			<?php $timeH = getdate();?>			
			<p class="txtH deskH">&copy; <?= $timeH['year'];?> <?= sysData('name_full');?>. Le foto sono soggette a diritto di autore e non possono essere usate senza il consenso dei rispettivi proprietari.
			<br>-<br>
			Chiunque voglia inserire sul sito opere di pittori fiemmesi può inviare la foto al seguente indirizzo <a href="<?= sysData('cont_mail_link');?>"><?= sysData('cont_mail');?></a>
			<br><br><?= (admin()) ? '<a href="/logout">logout</a>' : '<a href="/login">login</a>';?></p>
			
			<label id="navHm_ico" for="navHm_inp" class="mobH"></label>
		</div>

		<!--MOBILE MENU-->
		<input type="checkbox" id="navHm_inp" class="hide">
		
		<div id="navHm">
			<div id="navH_logo_cell">
				<a id="navH_logo" href="/">
					<h1 id="navH_titl">Pittori<br> di Fiemme</h1>
				</a>
			</div>
			
			<!--Links-->
			<div class="linkH_cont">
				<a href="/"><p class="linkH c1_txt_h">Home</p></a>
				<a href="/#hist"><p class="linkH c1_txt_h">Storia</p></a>
				<a href="/#art"><p class="linkH c1_txt_h">Pittori</p></a>
				<?php if (admin()) {?><a href="/admin/"><p class="linkH c1_txt_h">Gestione</p></a><?php }?>
			</div>
			
			<?php $timeH = getdate();?>			
			<p class="txtH">&copy; <?= $timeH['year'];?> <?= sysData('name_full');?>. Le foto sono soggette a diritto di autore e non possono essere usate senza il consenso dei rispettivi proprietari.
			<br>-<br>
			Chiunque voglia inserire sul sito opere di pittori fiemmesi può inviare la foto al seguente indirizzo pittoridifiemme@gmail.com
			<br><br><?= (admin()) ? '<a href="/logout">logout</a>' : '<a href="/login">login</a>';?></p>
			<div class="navHm_line"></div>
		</div>
	</div>
</header>