{% extends void %}

{% block main %}

<!-- Navigation bar -->
<?php require_once('-expands-admin/menu.php') ?>

<!-- Body -->
<section id="body">

	<div id="wrap">

		{% place content %}

	</div>

</section>

{% end main %}