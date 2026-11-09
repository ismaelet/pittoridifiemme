<div class="grid">
	<div class="bgr-c1 txt-cen padv1">

		<div id="logo" class="inlb img cont" <?= img_css('/app/resources/logo/logo_wht.png');?>></div>

		<h1 id="title" class="txt-blk mart1 padb5px txt-bold">Sito offline</h1>

		<p class="txt-wht pado2">Il sito è attualmente offline per un aggiornamento, saremo di nuovo online a breve.</p>
	</div>
</div>

<form id="login" class="wid100 txt-cen" method="POST">
	<button type="submit" name="submit" id="login-txt" class="clickable">
		<span class="btn-icon small" <?= icon_css('security/key');?>></span>
		<span class="btn-txt txt-c1 br-c1">Login con account amministrativo</span>
	</button>
</form>