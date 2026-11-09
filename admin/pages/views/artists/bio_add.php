<div id="file-sec" class="pad1" style="background-color: #<?= $exists ? 'D4E4F5' : 'eee';?>">
	<label class="lbl txt-1rem"><?= $exists ? 'Hai già caricato una biografia in PDF, ma se vuoi puoi sostituirla qui sotto' : 'Biografia in PDF';?>:</label>

	<input type="file" name="file" class="inp hide file-inp">

	<button
		type="button"
		class="mbtn file-cancel"
		<?php if (!empty($bio)) {?>onclick="return confirm('Caricare questo file rimuoverà il link alla biografia su un altro sito, sei sicuro di volerlo fare?');"<?php };?>
		onclick="$(this).prev().click();"
	>

			<?= $exists ? 'Sostituisci' : 'Carica il PDF';?>
	</button>

	<button type="submit" name="upload_pdf" class="hide file-submit" onclick="$('#url-sec').hide(); $('#or').hide();"></button>

	<div class="file-load"></div>

	<?php if ($error == 'wrong_type') {?><p class="inp err">Il file selezionato non è un PDF</p><?php }?>
</div>

<p id="or" class="txt-12rem txt-upp txt-cen txt-bold marv2">Oppure</p>

<div id="url-sec" class="pad1" style="background-color: #<?= empty($bio) ? 'eee' : 'D4E4F5';?>">
	
	<label class="lbl txt-1rem">Link alla biografia su un altro sito:</label>
	
	<input type="type" name="url" class="inp bgr-wht" placeholder="URL della biografia" value="<?= $bio;?>">
	
	<button type="submit" name="edit_url" class="mbtn" <?php if ($exists) {?>onclick="return confirm('Aggiungere questo link rimuoverà la biografia in PDF, sei sicuro di volerlo fare?');"<?php };?> onclick="$('#file-sec').hide(); $('#or').hide();" formnovalidate>

		<?= empty($bio) ? 'Aggiungi' : 'Modifica';?>
			
	</button>

	<?php if ($error == 'not_url') {?><p class="inp err">Il testo inserito non è un url valido, deve cominciare per http</p><?php }?>
</div>