<div id="nav" class="cell">
	<div id="nav-tbl" class="tbl">
		<div id="nav-menu" class="cell">

			<input type="checkbox" id="nav-title-cbx" class="hide">
			<label id="nav-title-box" class="mob" for="nav-title-cbx">
			
				<h1 id="nav-title" class="txt-11rem txt-cen txt-bold txt-upp pado1 brb1 bgr-fff">
					Menu Gestione
					<span id="nav-title-arrow" class="cenY mob1000">&#9660;</span>
				</h1>

			</label>

			<div id="nav-list">
				<?php
					foreach ($nav_categories as $category) {

						$cat = $category['category'];

						$cat_active = $this_cat == $cat;

						$pages = ${'nav_'.$cat};

						$pagesN = count($pages);?>

						<label class="nav-link-lbl" data-num="<?= $pagesN;?>">
							<input type="checkbox" class="nav-cbx hide <?php if ($cat_active) echo 'active'?>" <?php if ($cat_active) echo 'checked'?>>
							<div class="nav-block no-trans">
								<div class="nav-title-box padl1">
									<div class="nav-title-bgr bgr bgr-c1"></div>
									<div class="nav-ico no-trans inlb al-mid" style="background-image: url(/app/resources/icons/admin/<?= $cat;?>.png);"></div>
									<p class="nav-title no-trans inlb al-mid"><?= $category['title'];?></p>
									<span class="nav-ddown-ico no-trans"></span>
								</div>

								<!-- Dropdown menu -->
								<div class="nav-ddown no-trans <?php if (!$cat_active) echo 'closed';?>" style="height: <?= $pagesN * 60;?>px;">

									<?php foreach ($pages as $page) {

											$page_active = false;

											$url_file = $page['file_show'] ?? $page['file'];

											$url_page = empty($url_file) ? '' : '/'.$url_file;

											$url = '/manage/'.$cat.$url_page.'?id='.$seller->id;

											if (isset($page['file'])) $page_active = $this_page == $page['file'];?>

											<a href="<?= $url;?>">

												<p class="nav-link <?php if ($cat_active && $page_active) echo 'active'?>"><?= $page['title'];?></p>
											</a>
									<?php }?>
								</div>
							</div>
						</label>
				<?php }?>
			</div>
		</div>
	</div>
</div>