<?php require_once('header.tpl.php'); ?>

<div class="container">

	<div class="starter-template">
		<?php foreach($users as $user){ ?>
			<?=$user->id ?>&nbsp;<?=$user->name ?>&nbsp;<?=$user->email ?>&nbsp;
			<br/>
		<?php } ?>
	</div>

</div><!-- /.container -->

<?php require_once('footer.tpl.php'); ?>