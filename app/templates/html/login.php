<input type="hidden" name="url" value="<?php if (isset($_GET['url'])) echo $_GET['url'];?>">

<div class="load ld-lef">
	<input type="text" name="username" id="username" class="inp" placeholder="Username" required>
</div>

<div class="load ld-rig">
	<input type="password" name="password" id="password" class="inp" placeholder="Password" required>
</div>

<?php if ($error) {?><p class="inp err load ld-rig">Dati di accesso errati</p><?php }?>

<div class="form-foot">
	<button type="submit" name="submit" id="submit" class="mbtn bgr-c1 load ld-rig">Log In</button>
</div>