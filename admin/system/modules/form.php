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

		$type = $input['type_parse'] ?? $input['type'];

		if ($type != 'file') {
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
function gen_form($inputs, $row_sel = false, $error = false) {

	foreach ($inputs as $input) {

		//get type
		$type = $input['type'] ?? 'text';

		//generate input
		if ($type != 'direct') {

			//get basic data
			$name = $input['name'] ?? false;
			$lbl = $input['lbl'] ?? false;
			$pholder = $input['pholder'] ?? $lbl;

			//get value
			$val = false;

			//if value is explicit
			if (isset($input['val'])) $val = $input['val'];

			//else get from POST
			else if (isset($name) && isset($_POST[$name])) $val = $_POST[$name];

			//else get from result
			else if ($row_sel) $val = $row_sel[$name];

			//start to generate
			//label
			if ($lbl) {?>

				<label class="lbl"><?= $lbl;?>:</label>

			<?php }

			//selector
			if ($type == 'select') {

				$res = DB::select($input['query']);?>

				<select class="sel" name="<?= $name;?>">

					<?php if (isset($input['empty'])) {?>

						<option value="0" selected>-Vuoto-</option>

					<?php } while ($row = $res->fetch_assoc()) {?>

						<option
							value="<?= $row[$input['field_name']];?>"

							<?php if ($row[$input['field_name']] == $val) echo 'selected';?>>

								<?= $row[$input['field_show']];?>

						</option>

				<?php }?>
				</select>

			<?php

			//text area
			} else if ($type == 'textarea') {?>

				<textarea
						class="textarea"
						placeholder="<?= $pholder;?>"
						name="<?= $name;?>"
						<?php if (isset($input['max'])) echo ' maxlength="'.$input['max'].'" ';?>><?php

							if ($val) echo $val;

				?></textarea>

			<?php

			//searcher
			} else if ($type == 'search') {

				element_search($input['search']);

			}

			//error manager
			else if ($type == 'error' && $error == $input['error']) {?>

				<!-- Error manager -->
				<p class="inp err"><?= $input['txt'];?></p>

			<?php

			//checkbox
			} else if ($type == 'cbx') {?>

				<label class="cbx-box">
					<input
						type="checkbox" class="cbx cbx-mirror"
						value="<?= $val ?? 1;?>"

						<?php 
							if (isset($name)) echo ' name="'.$name.'" ';
							if (isset($input['checked']) || (isset($name) && isset($_POST[$name]))) echo ' checked ';
							if (isset($input['required'])) echo ' required ';
						?>
					>

					<div class="cbx-icon">
						<div class="cbx-icon-dot"></div>
					</div>

					<p class="cbx-txt"><?= $input['txt'];?></p>
				</label>

			<?php

			//file visibile
			} else if ($type == 'file') {?>

				<input
					type="file"
					class="inp file <?= $input['size'] ?? '';?> <?php if (isset($input['submit'])) echo 'file-inp';?>"
					name="<?= $name;?>"

					<?php
						if (isset($input['required'])) echo ' required ';
						if (isset($input['multiple'])) echo ' multiple ';
					?>
				>

			<?php

			//file hidden
			} else if ($type == 'file_hidden') {?>

				<input
					type="file"
					class="hide file <?= $input['submit'] ?? 'file-inp';?>"
					name="<?= $name;?>"

					<?php
						if (isset($input['required'])) echo ' required ';
						if (isset($input['multiple'])) echo ' multiple ';
					?>
				>

			<?php

			//button
			} else if ($type == 'btn') {?>

				<button
					type="<?= $input['submit'] ?? 'submit';?>"
					class="mart2 <?= $input['btn_type'] ?? 'mbtn';?> <?php if (isset($input['load'])) echo 'file-submit';?>"
					name="<?= $name ?? 'submit';?>"
				>
					<?= $input['txt'] ?? '';?>

				</button>

				<?php if (isset($input['load'])) {?>
					<div class="file-load"></div>
				<?php }?>

			<?php


			//other inputs
			} else if (in_array($type, ['text', 'mail', 'number', 'date'])) {?>

				<input
					type="<?= $type;?>"
					class="inp <?= $input['size'] ?? '';?>"
					value="<?= $val;?>"

					<?php
						if (isset($name)) echo ' name="'.$input['name'].'" ';

						if (isset($input['required'])) echo ' required ';
						
						if (isset($input['max'])) echo ' maxlength="'.$input['max'].'" ';
					
						if ($type != 'file') echo ' placeholder="'.$pholder.'" ';

						if (isset($input['submit'])) echo ' onchange="$(this).parent().find(\'.form-submit\').click();" ';
					?>
				>
			<?php }

			//if it's needed a hidden submit button
			if (isset($input['submit'])) {?>

				<button type="submit" class="hide form-submit" name="submit-file"></button>
		<?php }}
	}
}