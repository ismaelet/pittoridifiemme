<footer>
	<div id="footer-wrap" class="wrap-wide">
		<div id="footer-body" class="gallery">
			<?php $i = 0; while (isset($f_col[$i])) {?>
				<div class="footer-col inlb al-top">
					<p class="footer-title txt-wht txt-bold txt-upp"><?= $f_col[$i];?></p>

					<?php $j = 0; while (isset(${'f_links'.($i + 1)}[$j])) {
						$f_link = ${'f_links'.($i + 1)}[$j];

						if (isset($f_link[1])) {?>
							<a href="<?= $f_link[1];?>"><p class="footer-link"><?= $f_link[0];?></p></a>
						<?php }else { ?>
							<p class="footer-link"><?= $f_link[0];?></p>
					<?php } $j++;}?>
				</div>
			<?php $i++;}?>

			<?php if ($f_comp['contacts']) {?>
				<div class="footer-col inlb al-top">
					<p class="footer-title txt-wht txt-bold txt-upp">Contatti</p>

					<div class="gallery">
						<?php if (in_array('inst', $f_contacts)) {?>
							<a href="<?= sysData('cont_inst_link');?>"><div class="footer-soc-icon bgr-c1-h inlb inst-icon wht"></div></a>
						<?php }?>

						<?php if (in_array('fb', $f_contacts)) {?>
							<a href="<?= sysData('cont_fb');?>"><div class="footer-soc-icon bgr-c1-h inlb fb-icon wht"></div></a>
						<?php }?>

						<?php if (in_array('mail', $f_contacts)) {?>
							<a href="<?= sysData('cont_mail_lik');?>"><div class="footer-soc-icon bgr-c1-h inlb mail-icon wht"></div></a>
						<?php }?>
					</div>
				</div>
			<?php }?>
		</div>

		<p id="footer-notes">
			Copyright © <?= getdate()['year'];?> <span class="txt-wht"><?= sysData('name_full');?></span>. Il copyright © di ogni design appartiene al rispettivo proprietario.
			<br>Sito web realizzato da <a class="txt-wht-h" href="https://www.facebook.com/ismaele462">Ismaele Tuffanelli</a>
		</p>
	</div>
</footer>