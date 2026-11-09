{% block filter %}

<form class="status-filter mar-t-1" id="status-filter" method="GET">

	<h3 class=""><strong>Filtra per stato:</strong></h3>

	<div class="flex-line mar-t-05">

		<label class="cbx">
			<input type="radio" name="filter-status" value="" onchange="$('#status-filter').submit()" <?= $filterStatus === false ? 'checked' : '' ?>>
			<div class="icon"></div>
			<p class="radio-lbl">Tutti</p>
		</label>

		<?php foreach ($statuses as $statusId => $status) { ?>

			<label class="cbx">
				<input type="radio" name="filter-status" value="<?= $statusId ?>" onchange="$('#status-filter').submit()" <?= $filterStatus == $statusId ? 'checked' : '' ?>>
				<div class="icon"></div>
				<p class="radio-lbl"><?= $status[1] ?></p>
			</label>

		<?php } ?>

	</div>
</form>

{% end filter %}