<div class="row ">
	<div class="container-fluid shadow bg-dark card col-md-4 offset-md-4 shadow-sm p-5 " style="margin-top: 100px;">
		<?php echo validation_errors('<div class="alert alert-danger mt-1">' , '</div>');?>
		<form action="<?= site_url('Login/user_login'); ?>" method="post">
			<div class="form-group text-center">	
				<img src="<?php echo base_url('assets/img/logo2.jpg') ?>" align="center" class="mt-2 mb-2" width="250px" height="60px" style="text-align: center;" alt="" srcset="">
			</div>
			<div class="form-group">
				<label for="email" style="color: #fff;">Email</label>
				<input type="text" class="form-control"  name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="password" style="color: #fff;">Password</label>
				<input type="text" class="form-control" name="password"  placeholder="Password">
			</div>
			<div class="form-group">
				<button class="btn btn-danger" style="width: 50%; margin-left: 25%;">Login</button>
			</div>
		</form>
	</div>
</div>