{% block main %}

<div id="body">

	<div id="bgr" class="bgr"></div>

	<div id="artist-grid" class="grid">

		<!-- Image -->
		<section id="img-sec" class="grid just-cen">


			<div id="img-box">

				<img id="img" class="load ld-bot ld-del3" src="<?= client_url('/uploads/pics/' . $imgID . '_l.jpg'); ?>">

				<a id="arrow1" class="arrow img cont cenX" <?= background_image(APP_ICONS_DIR . 'navigation/nav1_top_blk.png'); ?> href="?id=<?= $ID . '&imgID=' . $pre; ?>"></a>
				<a id="arrow2" class="arrow img cont cenX" <?= background_image(APP_ICONS_DIR . 'navigation/nav1_bot_blk.png'); ?> href="?id=<?= $ID . '&imgID=' . $nex; ?>"></a>
			</div>


		</section>

		<!-- Artist Data -->
		<section id="artist-sec">
			<h1 id="title"><?= $name_full; ?></h1>

			<h1 id="date" class="txt-light"><?= $data; ?></h1>

			<?php if (file_exists(SERVER_ROOT . '/uploads/documents/' . $ID . '.pdf')) { ?>
				<a href="<?= '/uploads/documents/' . $ID . '.pdf'; ?>">
					<p id="desc" class="c1_txt_h">Biografia dell'artista</p>
				</a>
			<?php } else if (!empty($row_art['bio'])) { ?>
				<a href="<?= $row_art['bio']; ?>">
					<p id="desc" class="c1_txt_h">Biografia dell'artista</p>
				</a>
			<?php } ?>

			<p id="nav" class="mart2">
				<a href="?id=<?= $ID . '&imgID=' . $pre; ?>" class="txt-blk-h">Precedente</a>
				/
				<a href="?id=<?= $ID . '&imgID=' . $nex; ?>" class="txt-blk-h">Successivo</a>

				<span class="nav_numb">(<?= $pos . ' di ' . $imgN; ?>)</span>
			</p>
		</section>
	</div>

	<!-- Gallery -->
	<div id="gallery" class="grid5 grid4-768w grid3-550w grid-pad1 mart1 padb4">

		<?php while ($row_imgM = mysqli_fetch_assoc($res_imgM)) {

			$imgIDM = $row_imgM['ID'];
		?>

			<div class="imgM-box">
				<a class="imgM bgr" href="?id=<?= $ID . '&imgID=' . $imgIDM; ?>" <?= background_image('/uploads/pics/' . $imgIDM . '_m.jpg'); ?>></a>
			</div>
		<?php } ?>

	</div>
</div>

{% end main %}