<?php require_once('header.tpl.php'); ?>

<div class="container">

	<div class="starter-template">
		<h1>Add New User</h1>
		<?php echo validation_errors(); ?>
		<form action="<?=base_url('/admin/user/new') ?>" method="post" class="form-inline" role="form">
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo set_value('name'); ?>" />
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" />
			</div>
			<div class="form-group">
				<label>Email address</label>
				<input type="email" class="form-control"placeholder="Enter email" name="email" value="<?php echo set_value('email'); ?>" />
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>

	</div>

</div><!-- /.container -->

<?php require_once('footer.tpl.php'); ?>