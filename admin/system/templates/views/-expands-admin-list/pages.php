<?php if ($pagesCount > 1) { ?>

	<form method="GET" class="admin-list_pages txt-cen mar-t-2">

		<input type="hidden" class="js-current-page" name="page">
		<input type="hidden" name="search" value="<?= $queryConfig['search'] ?>">
		<input type="hidden" name="order" value="<?= $queryConfig['order-direction'] ?>">
		<input type="hidden" name="index" value="<?= $queryConfig['order-index'] ?>">
		<input type="hidden" name="filter-status" value="<?= $_GET['filter-status'] ?? '' ?>">
		<button type="submit" class="hidden"></button>

		<?php if ($pageConfig['first-page'] > 2) { ?>
			<p class="txt-09rem maro1 inlb">...</p>
		<?php } else if ($pageConfig['first-page'] == 2) { ?>
			<p class="page txt-09rem clickable txt-c1-h inlb" data-page="1">1</p>
		<?php } ?>

		<?php for ($i = $pageConfig['first-page']; $i <= $pageConfig['last-page']; $i++) { ?>

			<p class="page txt-09rem clickable txt-c1-h inlb <?= $currentPage == $i ? 'active' : '' ?>" data-page="<?= $i ?>">
				<?= $i ?>
			</p>

		<?php } ?>

		<?php if ($pagesCount > $pageConfig['last-page'] + 1) { ?>
			<p class="txt-09rem maro1 inlb">...</p>
		<?php } else if ($currentPage == $pageConfig['last-page'] + 1) { ?>
			<p class="page txt-09rem clickable txt-c1-h inlb" data-page="<?= $currentPage ?>"><?= $currentPage ?></p>
		<?php } ?>

	</form>

<?php } ?>