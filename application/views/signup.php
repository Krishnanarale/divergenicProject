<body>
	<style type="text/css">
		.row {
			margin-top: 100px;
		}
		.panel-heading {
			font-weight: bold;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Sign Up</div>
					<div class="panel-body">
						<form id="form">
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="type" class="form-control" id="name" name="name">
							</div>
							<div class="form-group">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd" name="password">
							</div>
							<button type="button" class="btn btn-success">SignUp</button>
							<a href="<?php echo base_url('login'); ?>" class="pull-right">Log In</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script type="text/javascript">
		$(document).ready(function () {
			$('.btn-success').click(function() {
				if ($('#name').val() === '') {
					alert('Name is required.');
				} else if($('#email').val() === '') {
					alert('Email is required.');
				} else if(IsEmail($('#email').val())== false) {
					alert('Email is not correct.');
				} else if($('#pwd').val() === '') {
					alert('Password is required.');
				} else {
					let data = $("form").serialize();
					$.ajax({
						url: "<?php base_url() ?>welcome/register",
						type: "POST",
						dataType: "json",
						data : data,
						success: function(res) {
							if (res.status === 'success') {
								alert('Registration Successful.');
								window.location.href = "<?php echo base_url('login'); ?>";
							} else {
								alert(res.error);
								console.log(res);
							}
						},
						error: function(err) {
							console.log(err);
						}
					});
				}
			});
		});

		function IsEmail(email) {
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!regex.test(email)) {
				return false;
			}else{
				return true;
			}
		}
	</script>
</body>
</html>