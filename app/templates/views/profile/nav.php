<section id="nav" class="cell">
		
	<div id="nav-box">
		<input type="checkbox" id="nav-cbx" class="hide">

		<label id="nav-title-box" for="nav-cbx">
			
			<h1 id="nav-title" class="txt-11rem txt-upp padv1 pado1 brb1 bgr-eee">
				Profilo Personale
				<span id="title-arrow" class="cenY mob1000">&#9660;</span>
			</h1>

		</label>

		<div id="nav-list">
			<a href="/profile?id=<?= $id;?>"><p class="nav-link padl1 <?php if ($loc == 'feed') echo 'active';?>">Feed</p></a>
			<a href="/profile/data?id=<?= $id;?>"><p class="nav-link padl1 <?php if ($loc == 'data') echo 'active';?>">Modifica dati</p></a>
			<a href="/profile/orders?id=<?= $id;?>"><p class="nav-link padl1 <?php if ($loc == 'orders') echo 'active';?>">Lista ordini</p></a>

			<?php if ($prof->is_seller()) {?>
				<a href="/manage?id=<?= $id;?>"><p class="nav-link padl1 <?php if ($loc == 'tools') echo 'active';?>">Il mio negozio</p></a>
			<?php }?>

			<a href="/logout"><p class="nav-link padl1 <?php if ($loc == 'logout') echo 'active';?>">Logout</p></a>
		</div>
	</div>
</section>