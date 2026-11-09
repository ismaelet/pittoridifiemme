<?php

//Add to database
function form_db_add($tbl, $inputs) {

	global $con;

	$fields = $pholders = '';
	$values = [];

	foreach ($inputs as $input) {

		$type = $input['type'] ?? 'text';

		if ($type != 'file') {
			
			if (isset($input['name'])) {

				$field = $input['name'];
				$val = $_POST[$field] ?? 0;
				
				$fields .= $field.', ';
				$pholders .= '?, ';
				$values[] = $val;
			}
		}
	}

	$fields = rtrim($fields, ', ');
	$pholders = rtrim($pholders, ', ');

	$query = $tbl.' ('.$fields.') VALUES ('.$pholders.')';

	return DB::add($query, $values);
}

//Edit database
function form_db_update($tbl, $inputs, $index, $index_val) {

	$query = '';
	$values = [];

	foreach($inputs as $input) {

		$type = $input['type'] ?? 'text';
		$type = $input['type_parse'] ?? $type;

		if (!in_array($type, ['file', 'error', 'done'])) {
			$field = $input['name'];
			
			$values[] = $type == 'direct' ? $input['value'] : $_POST[$field];

			$query .= $field.'=?, ';
		}
	}

	$query = rtrim($query, ', ');

	$query = $tbl.' SET '.$query.' WHERE '.$index.'=?';
	$values[] = $index_val;

	DB::update($query, $values);
}

//Generate form
function gen_form($inputs, $error = false, $done = false) {

	foreach ($inputs as $input) {
		
		//get type
		$type = $input['type'] ?? 'text';

		//generate input
		if ($type != 'direct') {

			//get basic data
			$lbl = $input['lbl'] ?? false;
			$pholder = $input['pholder'] ?? $lbl;

			//get value
			$val = false;

			if (isset($input['name']) && isset($_POST[$input['name']])) $val = $_POST[$input['name']];
			else if (isset($input['val'])) $val = $input['val'];?>

			<?php if ($lbl) {?>

				<!-- Label -->
				<label class="lbl"><?= $lbl;?>:</label>

			<?php }?>

			<?php if ($type == 'select') {?>

				<!-- Selector -->
				<?php $res = DB::select($input['query']);?>

				<select class="sel" name="<?= $input['name'];?>">

					<?php if (isset($input['empty'])) {?>

						<option value="0" selected>-Vuoto-</option>

					<?php } while ($row = $res->fetch_assoc()) {?>

						<option
							value="<?= $row[$input['field_name']];?>"

							<?php if (isset($input['value']) && $row[$input['field_name']] == $input['value']) echo 'selected';?>>

								<?= $row[$input['field_show']];?>

						</option>

				<?php }?>
				</select>

			<?php }

			//text area
			else if ($type == 'textarea') {?>

				<textarea
					class="textarea"
					placeholder="<?= $pholder;?>"
					name="<?= $input['name'];?>"
					<?php if (isset($input['max'])) echo ' maxlength="'.$input['max'].'" ';?>><?php

						if ($val) echo $val;

				?></textarea>
			<?php

			//searcher
			} else if ($type == 'search') {

				element_search($input['search']);

			//error manager
			} else if ($type == 'error' && $error == $input['error']) {?>

				<p class="inp err"><?= $input['txt'];?></p>

			<?php

			//done manager
			} else if ($type == 'done' && $done == $input['done']) {?>

				<p class="inp ok"><?= $input['txt'];?></p>

			<?php

			//checkbox
			} else if ($type == 'cbx') {?>

				<label class="cbx-box">
					<input
						type="checkbox" class="cbx cbx-mirror"
						value="<?= $val ?? 1;?>"

						<?php 
							if (isset($input['name'])) echo ' name="'.$input['name'].'" ';
							if (isset($input['checked']) || (isset($input['name']) && isset($_POST[$input['name']]))) echo ' checked ';
							if (isset($input['required'])) echo ' required ';
						?>
					>

					<div class="cbx-icon">
						<div class="cbx-icon-dot"></div>
					</div>

					<p class="cbx-txt"><?= $input['txt'];?></p>
				</label>

			<?php } else if ($type == 'file') {?>

				<!-- Visible file -->
				<input
					type="file"
					class="inp file <?= $input['size'] ?? '';?> <?php if (isset($input['submit'])) echo 'file-inp';?>"
					name="<?= $input['name'];?>"

					<?php if (isset($input['required'])) echo ' required ';?>
				>

			<?php } else if ($type == 'file_hidden') {?>

				<!-- Hidden file -->
				<input
					type="file"
					class="hide file <?= $input['submit'] ?? 'file-inp';?>"
					name="<?= $input['name'];?>"

					<?php if (isset($input['required'])) echo ' required ';?>
				>

			<?php } else if ($type == 'btn') {?>

				<!-- Button -->
				<button
					type="<?= $input['submit'] ?? 'submit';?>"
					class="mart2 <?= $input['btn_type'] ?? 'mbtn';?> <?php if (isset($input['load'])) echo 'file-submit';?>"
					name="<?= $input['name'] ?? 'submit';?>"
				>
					<?= $input['txt'] ?? '';?>

				</button>

				<?php if (isset($input['load'])) {?>
					<div class="file-load"></div>
				<?php }?>

			<?php } else if (in_array($type, ['text', 'email', 'number', 'password'])) {?>

				<!-- Text or email or number input -->
				<input
					type="<?= $type;?>"
					class="inp <?= $input['size'] ?? '';?>"
					value="<?= $val;?>"

					<?php
						if (isset($input['name'])) echo ' name="'.$input['name'].'" ';

						if (isset($input['required'])) echo ' required ';
						
						if (isset($input['max'])) echo ' maxlength="'.$input['max'].'" ';
					
						if ($type != 'file') echo ' placeholder="'.$pholder.'" ';

						if (isset($input['submit'])) echo ' onchange="$(this).parent().find(\'.form-submit\').click();" ';
					?>
				>
			<?php }?>

			<?php if (isset($input['submit'])) {?>

				<!-- Hidden submit button is needed -->
				<button type="submit" class="hide form-submit" name="submit-file"></button>
		<?php }}
	}
}