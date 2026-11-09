<div id="slider" class="">
	<div id="bgr" class="bgr bgr-c2" <?= $prof->cover_css();?>></div>
</div>

<div id="slider-data" class="wrap-wide txt-cen">

	<div id="pic" class="img inlb" <?= $prof->icon_css();?>></div>

	<h1 id="username" class="txt-25rem"><?= $prof->username;?></h1>
	<p class="">
		<?= $prof->fname;?>
		<?= empty($prof->lname) ? '' : '&middot; '.$prof->lname;?>
		<span class="txt-c1 txt-bold "><?= empty($prof->fname) && empty($prof->lname) ? $prof->rank_str : ' &middot; '.$prof->rank_str;?></span>
	</p>
</div>